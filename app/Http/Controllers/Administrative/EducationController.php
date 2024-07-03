<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\EducationStoreRequest;
use App\Service\EducationService;
use App\Education;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EducationController extends Controller
{

    protected $educationService;

    public function __construct(EducationService $educationService)
    {
        $this->educationService = $educationService;
    }


    public function index(){
        return view('administrative.education.index');
    }
    public function data(){
        return  $this->educationService->getAllData();
    }
    public function create(){
        return view('administrative.education.create');
    }
    public function store(EducationStoreRequest $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'education' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/education', $file_name);
                        $contentFile = 'education/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->educationService->store($request);
        if($result){
            return redirect()->route('administrative.education')->with('success', 'Education Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->educationService->findbyId($id);
        return view('administrative.education.edit',compact('data'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'education' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/education', $file_name);
                        $contentFile = 'education/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->educationService->update($id,$request);
        if($result){
            return redirect()->route('administrative.education')->with('success', 'Education Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }

    public function destroy($id)
    {
        $result = $this->educationService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }


}
