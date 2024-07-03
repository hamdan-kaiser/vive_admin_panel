<?php
namespace App\Http\Controllers\Administrative;

use App\Http\Requests\LocationStoreRequest;
use App\Imports\LocationImport;
use App\Imports\UniversityImport;
use App\Service\LocationService;
use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class LocationController extends Controller
{

    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'excel_file' => 'required'
        ]);
        Excel::import(new LocationImport(), $request->excel_file);

        return redirect()->back()->with('success', 'All good!');
    }
    public function index(){
        return view('administrative.location.index');
    }
    public function data(){
        return  $this->locationService->getAllData();
    }
    public function create(){
        return view('administrative.location.create');
    }
    public function store(LocationStoreRequest $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'location' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/location', $file_name);
                        $contentFile = 'location/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->locationService->store($request);
        if($result){
            return redirect()->route('administrative.location')->with('success', 'Location Created Successfully');
        }else{
            return redirect()->back()->withInput()->with('error', 'Something Wrong,Please Try Again');
        }
    }
    public function edit($id){
        $data =  $this->locationService->findbyId($id);
        return view('administrative.location.edit',compact('data'));
    }
    public function update($id,Request $request){
        $input = $request->except('_token');
        foreach ($input as $name => $value){
            if(isset($_FILES[$name])){
                $makeUniqueName = 'location' . time() . '-' . uniqid();
                if ($request->hasFile($name)) {
                    $file_name = $makeUniqueName . '.' . $request->file($name)->getClientOriginalExtension();
                    //Store local storage
                    $request->$name->storeAs('public/location', $file_name);
                        $contentFile = 'location/' . $file_name;
                    $input[$name] = $contentFile;
                    $mimeType = $request->file($name)->getMimeType();
                    $input['file_type'] = substr($mimeType, 0, strrpos( $mimeType, '/'));
                }
            }
        }
        $request = new Request($input);
        $result = $this->locationService->update($id,$request);
        if($result){
            return redirect()->route('administrative.location')->with('success', 'Location Updated Successfully');
        }else{
            return redirect()->back()->with('error', 'Something Wrong,Please Try Again');
        }

    }

    public function destroy($id)
    {
        $result = $this->locationService->destroy($id);
        if($result){
            echo 'success';
        }else{
            echo 'error';
        }
    }


}
