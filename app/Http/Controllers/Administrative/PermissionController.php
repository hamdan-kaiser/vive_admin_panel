<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\PermissionStoreRequest;
use App\Service\PermissionService;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class PermissionController extends Controller
{

    protected $PermissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->PermissionService = $permissionService;
    }


    public function index(){
        return view('administrative.permission.index');
    }
    public function data(){
        return  $this->PermissionService->getAllData();
    }
    public function create(){
        return view('administrative.permission.create');
    }
    public function store(PermissionStoreRequest $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'permission' . time() . '_' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/permission', $file_name);
                        $contentFile = 'permission/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
     
        $request = new Request($input);
        $result = $this->PermissionService->store($request);
        if($result){
            return redirect()->route('administrative.permission')->with('success', 'Permission Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->PermissionService->findbyId($id);
        return view('administrative.permission.edit',compact('data'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'permission' . time() . '_' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/permission', $file_name);
                        $contentFile = 'permission/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $input['slug'] = Str::slug($request->name, '-');
        $request = new Request($input);
        $result = $this->PermissionService->update($id,$request);
        if($result){
            return redirect()->route('administrative.permission')->with('success', 'Permission Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }

    public function destroy($id)
    {
        $result = $this->PermissionService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }


}
