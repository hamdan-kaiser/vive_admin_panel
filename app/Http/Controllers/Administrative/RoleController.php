<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\RoleStoreRequest;
use App\Service\PermissionService;
use App\Service\RoleService;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class RoleController extends Controller
{

    protected $RoleService;
    protected $permissionService;

    public function __construct(RoleService $roleService,PermissionService $permissionService)
    {
        $this->RoleService = $roleService;
        $this->permissionService = $permissionService;
    }


    public function index(){
        return view('administrative.role.index');
    }
    public function data(){
        return  $this->RoleService->getAllData();
    }
    public function create(){
        $permission = $this->permissionService->all();
        return view('administrative.role.create',compact('permission'));
    }
    public function store(RoleStoreRequest $request){
        $permissions = $request->permission_id;
        $input = $request->except('_token','permission_id');

        $request = new Request($input);
        $result = $this->RoleService->store($request);
        if($result){

            $result->givePermissionTo($permissions);
            return redirect()->route('administrative.role')->with('success', 'Role Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $permissions = $this->permissionService->all();
        $data =  $this->RoleService->findbyId($id);
        return view('administrative.role.edit',compact('data','permissions'));
    }
    public function update($id,Request $request){
        $permissions = $request->permission_id;
        $input = $request->except('_token','permission_id');

        $request = new Request($input);
        $result = $this->RoleService->update($id,$request);
        if($result){
            $this->RoleService->findbyId($id)->givePermissionTo($permissions);
            return redirect()->route('administrative.role')->with('success', 'Role Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }

    public function destroy($id)
    {
        $result = $this->RoleService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }


}
