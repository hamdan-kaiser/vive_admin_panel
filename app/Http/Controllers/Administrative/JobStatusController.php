<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\JobStatusStoreRequest;
use App\Imports\JobStatusImport;
use App\Imports\UniversityImport;
use App\Service\JobStatusService;
use App\JobStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class JobStatusController extends Controller
{

    protected $jobStatusService;

    public function __construct(JobStatusService $jobStatusService)
    {
        $this->jobStatusService = $jobStatusService;
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'excel_file' => 'required'
        ]);
        Excel::import(new JobStatusImport(), $request->excel_file);

        return redirect()->back()->with('success', 'All good!');
    }
    public function index(){
        return view('administrative.jobstatus.index');
    }
    public function data(){
        return  $this->jobStatusService->getAllData();
    }
    public function create(){
        return view('administrative.jobstatus.create');
    }
    public function store(JobStatusStoreRequest $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'jobstatus' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/jobstatus', $file_name);
                        $contentFile = 'jobstatus/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->jobStatusService->store($request);
        if($result){
            return redirect()->route('administrative.jobstatus')->with('success', 'JobStatus Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->jobStatusService->findbyId($id);
        return view('administrative.jobstatus.edit',compact('data'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'jobstatus' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/jobstatus', $file_name);
                        $contentFile = 'jobstatus/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->jobStatusService->update($id,$request);
        if($result){
            return redirect()->route('administrative.jobstatus')->with('success', 'JobStatus Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }
    public function destroy($id)
    {
        $result = $this->jobStatusService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }


}
