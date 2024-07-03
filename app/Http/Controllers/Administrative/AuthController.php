<?php

namespace App\Http\Controllers\Administrative;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login;
use App\Service\AuthService;
use App\Service\RoleService;
use App\Service\UserService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Validator;
class AuthController extends Controller
{
    protected $authService,$roleService,$userService;



    public function __construct(AuthService $authService,RoleService $roleService,UserService $userService)
    {
        $this->authService = $authService;
        $this->roleService = $roleService;
        $this->userService = $userService;
    }
    public function convert(){
        $squadStartId = 67718;
        $squadPlayerStartId = 627697;
        $squadLogoStartId = 48622;
        $squads = DB::table('squads')->get();
        foreach ($squads as $squad){
            $id = DB::table('squad_history')->insertGetId(
                [
                    'id' => $squadStartId,
                    'user_id' =>$squad->user_id,
                    'name' => $squad->name,
                    'formation_id' => $squad->formation_id,
                    'game_week' => 4
                ]
            );
            $squadsPlayers = DB::table('player_squad')
                ->where('squad_id',$squad->id)
                ->get();
            if($squadsPlayers){
                foreach ($squadsPlayers as $squadsPlayers){
                    DB::table('player_squad_history')->insertGetId(
                        [
                            'id' =>$squadPlayerStartId,
                            'squad_history_id' =>$squadStartId,
                            'player_id' => $squadsPlayers->player_id,
                            'type' => $squadsPlayers->type,
                            'is_captain' =>$squadsPlayers->is_captain,
                            'is_vice_captain' => $squadsPlayers->is_vice_captain,
                        ]
                    );
                    $squadPlayerStartId++;
                }

            }

            $squadsLogo = DB::table('squad_logo')
                ->where('squad_id',$squad->id)
                ->first();
            if($squadsLogo){
                DB::table('squad_logo_history')->insertGetId(
                    [
                        'id' =>$squadLogoStartId,
                        'squad_history_id' =>$squadStartId,
                        'logo_image' => $squadsLogo->logo_image,
                        'shield_id' => $squadsLogo->shield_id,
                        'shape_id' =>$squadsLogo->shape_id,
                        'shield_color' => $squadsLogo->shield_color,
                        'shape_color' => $squadsLogo->shape_color,
                    ]
                );
            }

            $squadStartId++;

            $squadLogoStartId++;
        }
    }
    public function index()
    {
        return view('administrative.login');
    }
    protected function authenticated(Request $request, $user)
    {
        return redirect()-route('administrative.dashboard');
    }
    public function authenticate(Login $request)
    {
        $result = $this->authService->authenticate($request);

        if($result){
            $user = $request->user();
            Auth::logoutOtherDevices($request->password);
            return redirect()->route('administrative.dashboard');
        }else {

            $errors = new MessageBag(['password' => ['Email and/or Password invalid.']]);
            // if Auth::attempt fails (wrong credentials) create a new message bag instance.
            return redirect()->back()->withErrors($errors);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('index');
    }
    public function showForgetPasswordForm()
    {
        return view('administrative.forget-password');
    }
    public function submitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()

        ]);

        try{

            Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->subject('Reset Password');
                $message->from('info@mail.banglaiskool.com');
            });
        }catch (\Exception $e){

        }

        return back()->with('success', 'We have e-mailed your password reset link!');

    }
    public function showResetPasswordForm($token) {
        return view('administrative.forgetPasswordLink', ['token' => $token]);
    }
    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();
        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }else{
            $user = User::where('email', $request->email)->first();
            PasswordResetApproval::create([
                'user_id' => $user->id,
                'password' => Hash::make($request->password)
            ]);

            return redirect('/login')->with('success', 'Your password change request accepted!');
        }
    }

}
