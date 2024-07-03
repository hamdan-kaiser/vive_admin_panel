<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\UserStoreRequest;
use App\Service\UserService;
use App\Models\User;
use Illuminate\Http\Request;
use App\Service\RoleService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    protected $userService,$roleService;

    public function __construct(UserService $userService,RoleService $roleService)
    {
        $this->userService = $userService;
        $this->roleService = $roleService;
    }


    public function index(){
        return view('administrative.user.index');
    }
    public function data(){
        return  $this->userService->getAllData([]);
    }
    public function create(){
        $roles = $this->roleService->all();
        return view('administrative.user.create',compact('roles'));
    }
    public function store(UserStoreRequest $request){
        $input = $request->except('_token','role_id');
        $roleId = $request->role_id;
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'user' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/user', $file_name);
                        $contentFile = 'user/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        if($request->user_type == 'depot_manager'){
            $input['depot_id'] = $request->depot_id;
        }
        if($request->user_type == 'dealer'){
            $input['dealer_id'] = $request->dealer_id;
        }
        $input['password'] = Hash::make($request->password);
        $input['type'] = $request->user_type;
        $request = new Request($input);
        $result = $this->userService->store($request);
        if($result){

            $result->assignRole($roleId);
            // $result->sendEmailVerificationNotification();
            return redirect()->route('administrative.user')->with('success', 'User Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->userService->findAssociate($id,['roles']);
        $roles = $this->roleService->all();
        return view('administrative.user.edit',compact('data','roles'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token','role_id');
        $roleId = $request->role_id;
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'user' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/user', $file_name);
                        $contentFile = 'user/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $input['type'] = $request->user_type;
        if($request->user_type == 'depot_manager'){
            $input['depot_id'] = $request->depot_id;
        }
        if($request->user_type == 'dealer'){
            $input['dealer_id'] = $request->dealer_id;

        }
        if($request->user_type == 'factory_manager'){
            $input['factory_id'] = $request->factory_id;

        }
        $request = new Request($input);
        $result = $this->userService->update($id,$request);

        if($result){
            $data =  $this->userService->findbyId($id);
            $data->assignRole($roleId);
            return redirect()->route('administrative.user')->with('success', 'User Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }

    public function destroy($id)
    {
        $result = $this->userService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }
    public function template($type,$id = 0)
    {
        if( $type == 'depot_manager' || $type == 'dealer' || $type == 'factory_manager'){
            return view('administrative.user.template.'.$type,['id' => $id]);
        }

    }

}
