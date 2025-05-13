<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;

class AuthController extends Controller
{

    public function signup(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required|unique:users',
            "name" => "required"
        ]);
        if($validator->fails()){
            return response(
                [
                    'message' => 'Validation errors',
                    'errors' =>  $validator->errors(),
                    'status' => false
                ], 422);
        }
        //$otp = rand(1000,9999);
        $otp = 1234;
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'is_first_login' => 0,
            'otp' => $otp,
        ];
        $user = User::create($data);
        if($user){
            $user->assignRole(2);
            $payload = [
                'code'         => 200,
                'app_message'  => 'Registration Successful',
                'user_message' => 'Registration Successful.',
                'otp' => $otp,
                'data'      => new UserCollection($user)
            ];
            return response()->json($payload, 200);
        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'Registration Unsuccessful',
                'user_message' =>'Registration Unsuccessful',
            ];
            return response()->json($payload, 500);
        }
    }
    public function otpSubmit(Request $request){
        $validator = Validator::make($request->all(), [
            'otp' => 'required',
            "phone" => "required",
            'type'=> "required",
        ]);
        if($validator->fails()){
            return response(
                [
                    'message' => 'Validation errors',
                    'errors' =>  $validator->errors(),
                    'status' => false
                ], 422);
        }
        $user = User::where('phone',$request->phone)->first();
        if($user){
            $getUserOtp = $request->type == 'forget' ? $user->password_otp : $user->otp;
            if($user->otp == $getUserOtp){
                if($request->type == 'forget'){
                    $user->password_otp = null;
                }else{
                    $user->otp = null;
                    $user->is_verified = 1;
                }


                $user->save();
                $user = User::where('phone',$request->phone)->first();
                $payload = [
                    'code'         => 200,
                    'app_message'  => 'Verified Successful',
                    'user_message' => 'Verified Successful.',
                    'data'      => new UserCollection($user)
                ];
                return response()->json($payload, 200);
            }else{
                $payload = [
                    'code'         => 500,
                    'app_message'  => ' Unsuccessful',
                    'user_message' =>' Unsuccessful',
                ];
                return response()->json($payload, 500);
            }

        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => ' Unsuccessful',
                'user_message' =>' Unsuccessful',
            ];
            return response()->json($payload, 500);
        }
    }
    // public function login(Request $request){

    //     $validator = Validator::make($request->all(), [
    //         'password' => 'required',
    //         "phone" => "required"
    //     ]);
    //     if($validator->fails()){
    //         return response(
    //             [
    //                 'message' => 'Validation errors',
    //                 'errors' =>  $validator->errors(),
    //                 'status' => false
    //             ], 422);
    //     }
    //     $user = User::where('phone','=', trim($request->phone))->first();
    //     if($user)
    //     {
    //         if(Hash::check($request->password, $user->password)){
    //             $user = User::find($user->id);
    //             $token =  $user->createToken('VivaEducation')->accessToken;
    //             $payload = [
    //                 'code'         => 200,
    //                 'app_message'  => 'Login successful, credentials matched.',
    //                 'user_message' => 'Login successful.',
    //                 'access_token' => $token,
    //                 'data'      => new UserCollection($user)
    //             ];


    //             return response()->json($payload, 200);
    //         }
    //         else{
    //             $payload = [
    //                 'code'         => 401,
    //                 'app_message'  => 'login unsuccessful, password mismatch',
    //                 'user_message' => 'Credentials didn\'t validate.',
    //             ];
    //             return response()->json($payload, 401);
    //         }
    //     }
    //     else{
    //         $payload = [
    //             'code'         => 401,
    //             'app_message'  => 'login unsuccessful, credentials mismatch-match',
    //             'user_message' => 'Credentials didn\'t validate.',
    //         ];
    //         return response()->json($payload, 401);
    //     }

    // }
    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'password' => 'required',
        'phone' => 'required'
    ]);

    if ($validator->fails()) {
        return response([
            'message' => 'Validation errors',
            'errors' =>  $validator->errors(),
            'status' => false
        ], 422);
    }

    $user = User::withTrashed()->where('phone', trim($request->phone))->first();

    if ($user) {
        // Restore if soft deleted
        if ($user->trashed()) {
            $user->restore();
        }

        if (Hash::check($request->password, $user->password)) {
            $token = $user->createToken('VivaEducation')->accessToken;
            $payload = [
                'code'         => 200,
                'app_message'  => 'Login successful, credentials matched.',
                'user_message' => 'Login successful.',
                'access_token' => $token,
                'data'         => new UserCollection($user)
            ];

            return response()->json($payload, 200);
        } else {
            return response()->json([
                'code'         => 401,
                'app_message'  => 'Login unsuccessful, password mismatch',
                'user_message' => 'Credentials didn\'t validate.',
            ], 401);
        }
    } else {
        return response()->json([
            'code'         => 401,
            'app_message'  => 'Login unsuccessful, user not found',
            'user_message' => 'Credentials didn\'t validate.',
        ], 401);
    }
}



    public function resendOtp(){
        $userId = Auth::id();
        $user = User::where('id',$userId)->first();
        if($user){
            //$otp = rand(1000,9999);
            $otp = 1234;
            $user->otp = $otp;
            $user->save();
            $payload = [
                'code'         => 200,
                'app_message'  => 'Otp Resend Successful',
                'user_message' => 'Otp Resend Successful.',
                'otp' => $otp,
                'data'      => new UserCollection($user)
            ];
            return response()->json($payload, 200);
        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'User not found',
                'user_message' =>'User not found',
            ];
            return response()->json($payload, 500);
        }
    }
    public function logout(Request $request)
    {
        if(Auth::user())
        {
            $token = $request->user()->token();
            $token->revoke();
            $payload = [
                'code'         => 200,
                'app_message'  => 'You have been successfully logged out!',
                'user_message' => 'You have been successfully logged out!'
            ];
            return response()->json($payload, 200);
        }else{
            $payload = [
                'code'         => 401,
                'app_message'  => 'not found',
                'user_message' => 'Invalid user.'
            ];
            return response()->json($payload, 401);
        }

    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required',
            'old_password' => 'required',
        ]);

        if($validator->fails()){
            $payload = [
                'code'         => 422,
                'app_message'  => 'Validation errors.',
                'user_message' => 'Validation errors.',
                'errors'      => $validator->errors()
            ];
            return response()->json($payload, 200);
        }
        $user = User::where('id',$request->user()->id)->first();

        if(Hash::check($request->old_password, $user->password)){

            $user->password = Hash::make($request->new_password);
            $user->is_first_login = 0;
            $user->save();
            $payload = [
                'code'         => 200,
                'app_message'  => 'successful',
                'user_message' => 'Password information updated successfully.',
            ];
            return response()->json($payload, 200);
        }
        else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'Password mismatch',
                'user_message' => 'Password didn\'t validate.',
            ];
            return response()->json($payload, 401);
        }

    }
    public function setPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:6',
            'phone' => 'required',
        ]);

        if($validator->fails()){
            $payload = [
                'code'         => 422,
                'app_message'  => 'Validation errors.',
                'user_message' => 'Validation errors.',
                'errors'      => $validator->errors()
            ];
            return response()->json($payload, 200);
        }
        $user = User::where('phone',$request->phone)->first();
        if($user->is_first_login == 0){
            $user->password = Hash::make($request->password);
            $user->is_first_login = 1;
            $user->save();
            $payload = [
                'code'         => 200,
                'app_message'  => 'successful',
                'user_message' => 'Password information updated successfully.',
            ];
            return response()->json($payload, 200);
        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'Password information updated Unsuccessful',
                'user_message' => 'Password information updated Unsuccessful.',
            ];
            return response()->json($payload, 200);
        }

    }
    public function fcmUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fcm_token' => 'required',
            'device_type' => 'required',
        ]);

        if($validator->fails()){
            $payload = [
                'code'         => 422,
                'app_message'  => 'Validation errors.',
                'user_message' => 'Validation errors.',
                'errors'      => $validator->errors()
            ];
            return response()->json($payload, 200);
        }
        $userDevice = DeviceInformation::where('user_id',$request->user()->id)->first();
        if($userDevice){
            $userDevice->fcm_token = trim($request->fcm_token);
            $userDevice->device_type = trim($request->device_type);
            $userDevice->save();

        }else{
            DeviceInformation::create([
                'user_id'=> $request->user()->id,
                'fcm_token'=>trim($request->fcm_token),
                'device_type'=>trim($request->device_type),
            ]);
        }

        $payload = [
            'code'         => 200,
            'app_message'  => 'successful',
            'user_message' => 'Device information stored successfully.',
        ];
        return response()->json($payload, 200);
    }
    public function forgetPassword(Request $request){
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        if($validator->fails()){
            $payload = [
                'code'         => 422,
                'app_message'  => 'Validation errors.',
                'user_message' => 'Validation errors.',
                'errors'      => $validator->errors()
            ];
            return response()->json($payload, 200);
        }

        $user = User::where('phone',$request->phone)->first();
        if($user){
            //$otp = rand(1000,9999);
            $otp = 1234;
            $user->password_otp = $otp;
            $user->save();
            $payload = [
                'code'         => 200,
                'app_message'  => 'Otp Send Successful',
                'user_message' => 'Otp Send Successful.',
                'otp' => $otp,
                'data'      => new UserCollection($user)
            ];
            return response()->json($payload, 200);
        }else{
            $payload = [
                'code'         => 500,
                'app_message'  => 'User not found',
                'user_message' =>'User not found',
            ];
            return response()->json($payload, 500);
        }
    }

  public function deleteAccount(){

    $data = User::where('id',12)->first();
   
    if ($data == null){
        return response()->json([
            'message' => 'User not authenticated.',
            'status' => false
        ], 401);
    }

   $data->delete();
    return response()->json([
        'message' => 'Account temporarily deleted. It will be restored upon next login.',
        'status' => true
    ]);
}


}
