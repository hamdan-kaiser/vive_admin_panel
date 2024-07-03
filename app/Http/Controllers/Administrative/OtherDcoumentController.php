<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\OtherDcoumentStoreRequest;
use App\Service\OtherDcoumentService;
use App\OtherDcoument;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OtherDcoumentController extends Controller
{

    protected $otherDcoumentService;

    public function __construct(OtherDcoumentService $otherDcoumentService)
    {
        $this->otherDcoumentService = $otherDcoumentService;
    }


    public function index(){
        return view('administrative.otherdcoument.index');
    }
    public function data(){
        return  $this->otherDcoumentService->getAllData();
    }
    public function create(){
        return view('administrative.otherdcoument.create');
    }
    public function store(OtherDcoumentStoreRequest $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'otherdcoument' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/otherdcoument', $file_name);
                        $contentFile = 'otherdcoument/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->otherDcoumentService->store($request);
        if($result){
            return redirect()->route('administrative.otherdcoument')->with('success', 'OtherDcoument Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->otherDcoumentService->findbyId($id);
        return view('administrative.otherdcoument.edit',compact('data'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'otherdcoument' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/otherdcoument', $file_name);
                        $contentFile = 'otherdcoument/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->otherDcoumentService->update($id,$request);
        if($result){
            return redirect()->route('administrative.otherdcoument')->with('success', 'OtherDcoument Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }

    public function destroy($id)
    {
        $result = $this->otherDcoumentService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }


}
