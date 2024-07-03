<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\SubjectStoreRequest;
use App\Imports\SubjectImport;
use App\Imports\UniversityImport;
use App\Service\SubjectService;
use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class SubjectController extends Controller
{

    protected $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'excel_file' => 'required'
        ]);
        Excel::import(new SubjectImport(), $request->excel_file);

        return redirect()->back()->with('success', 'All good!');
    }
    public function index(){
        return view('administrative.subject.index');
    }
    public function data(){
        return  $this->subjectService->getAllData();
    }
    public function create(){
        return view('administrative.subject.create');
    }
    public function store(SubjectStoreRequest $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'subject' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/subject', $file_name);
                        $contentFile = 'subject/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->subjectService->store($request);
        if($result){
            return redirect()->route('administrative.subject')->with('success', 'Subject Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->subjectService->findbyId($id);
        return view('administrative.subject.edit',compact('data'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'subject' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/subject', $file_name);
                        $contentFile = 'subject/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->subjectService->update($id,$request);
        if($result){
            return redirect()->route('administrative.subject')->with('success', 'Subject Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }

    public function destroy($id)
    {
        $result = $this->subjectService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }


}
