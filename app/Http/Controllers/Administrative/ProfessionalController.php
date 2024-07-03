<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\ProfessionalStoreRequest;
use App\Service\ProfessionalService;
use App\Professional;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfessionalController extends Controller
{

    protected $professionalService;

    public function __construct(ProfessionalService $professionalService)
    {
        $this->professionalService = $professionalService;
    }


    public function index(){
        return view('administrative.professional.index');
    }
    public function data(){
        return  $this->professionalService->getAllData();
    }
    public function create(){
        return view('administrative.professional.create');
    }
    public function store(ProfessionalStoreRequest $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'professional' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/professional', $file_name);
                        $contentFile = 'professional/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->professionalService->store($request);
        if($result){
            return redirect()->route('administrative.professional')->with('success', 'Professional Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->professionalService->findbyId($id);
        return view('administrative.professional.edit',compact('data'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'professional' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/professional', $file_name);
                        $contentFile = 'professional/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->professionalService->update($id,$request);
        if($result){
            return redirect()->route('administrative.professional')->with('success', 'Professional Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }

    public function destroy($id)
    {
        $result = $this->professionalService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }


}
