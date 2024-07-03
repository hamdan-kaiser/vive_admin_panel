<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\UniversityStoreRequest;
use App\Imports\UniversityImport;
use App\Service\LocationService;
use App\Service\SubjectService;
use App\Service\UniversityService;
use App\University;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
class UniversityController extends Controller
{

    protected $universityService;
    protected $locationService;
    protected $subjectService;

    public function __construct(UniversityService $universityService,LocationService $locationService,SubjectService $subjectService)
    {
        $this->universityService = $universityService;
        $this->locationService = $locationService;
        $this->subjectService = $subjectService;
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'excel_file' => 'required'
        ]);
        Excel::import(new UniversityImport(), $request->excel_file);
        return redirect()->back()->with('success', 'All good!');
    }
    public function index(){
        return view('administrative.university.index');
    }
    public function data(){
        return  $this->universityService->getAllData();
    }
    public function create(){
        $location = $this->locationService->all();
        $subjects = $this->subjectService->all();
        return view('administrative.university.create',compact('location','subjects'));
    }
    public function store(UniversityStoreRequest $request){
        $input = $request->except('_token','subject');
        $subjects = $request->subject;
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'university' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/university', $file_name);
                        $contentFile = 'university/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->universityService->store($request);

        if($result){

            $result->subjects()->attach($subjects);
            return redirect()->route('administrative.university')->with('success', 'University Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->universityService->findAssociate($id,['subjects']);
        $location = $this->locationService->all();
        $subjects = $this->subjectService->all();
        return view('administrative.university.edit',compact('data','location','subjects'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token','subject');
        $subjects = $request->subject;
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'university' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/university', $file_name);
                        $contentFile = 'university/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->universityService->update($id,$request);
        if($result){
            $university = $this->universityService->findbyId($id);
            $university->subjects()->sync($subjects);
            return redirect()->route('administrative.university')->with('success', 'University Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }

    public function destroy($id)
    {
        $result = $this->universityService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }


}
