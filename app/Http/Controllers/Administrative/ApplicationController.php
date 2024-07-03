<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\ApplicationStoreRequest;
use App\Models\JobStatus;
use App\Service\ApplicationService;
use App\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApplicationController extends Controller
{

    protected $applicationService;

    public function __construct(ApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }


    public function index(){
        return view('administrative.application.index');
    }
    public function data(){
        return  $this->applicationService->getAllData();
    }
    public function create(){
        return view('administrative.application.create');
    }
    public function store(ApplicationStoreRequest $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'application' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/application', $file_name);
                        $contentFile = 'application/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->applicationService->store($request);
        if($result){
            return redirect()->route('administrative.application')->with('success', 'Application Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->applicationService->findbyId($id);
        return view('administrative.application.edit',compact('data'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'application' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/application', $file_name);
                        $contentFile = 'application/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->applicationService->update($id,$request);
        if($result){
            return redirect()->route('administrative.application')->with('success', 'Application Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }
    public function statusUpdate(Request $request){
        $applicationId = $request->applicationId;
        $request = new Request([
            'job_status_id'   => $request->statusId
        ]);

        $result = $this->applicationService->update($applicationId,$request);

        if($result){
            echo 'success';
        }else{
            echo 'error';
        }

    }

    public function destroy($id)
    {
        $result = $this->applicationService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }

    public function details($id){
        $statuses = JobStatus::all();
        $data =  $this->applicationService->findAssociate($id,['university','subject','user.basicProfile','user.passportProfile','user.educationProfile','user.professionalProfile','user.otherProfile']);
        return view('administrative.application.details',compact('data','statuses'))->render();
    }


}
