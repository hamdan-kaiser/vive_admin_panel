<?php
namespace App\Service;


use App\Repositories\ApplicationRepository;
use DataTables;
class ApplicationService
{
    protected $applicationRepository;

    // Constructor to bind model to repo
    public function __construct(ApplicationRepository $applicationRepository)
    {
        $this->applicationRepository = $applicationRepository;
    }

    public function all(){
        return  $this->applicationRepository->all();
    }
    public function allAssociate(array $relation=[]){
        return  $this->applicationRepository->allAssociate($relation);
    }
    public function getAllData(){
        $data = $this->applicationRepository->allAssociate(['university','subject','user','jobStatus']);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                return "<button class='btn btn-info btn-sm viewDetails' data-id=$row->id>View Details</button>";
            })
            ->editColumn('job_status_id',function ($row){
                $html = '';
                if($row->job_status != null){
                    $html.=ucwords($row->job_status->title);
                }

                return $html;
            })
            ->editColumn('course_type',function ($row){
                $html = '';
                $replaceString = str_replace('_',' ',$row->course_type);
                $html.=ucwords($replaceString);
                return $html;
            })
            ->rawColumns(['action','course_type','job_status_id'])
            ->blacklist(['created_at', 'updated_at','action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function findbyId($id){
        return $this->applicationRepository->show($id);
    }
    public function store($request){
        return $this->applicationRepository->create($request->all());
    }
    public function update($id,$request){
        return $this->applicationRepository->update($request->all(),$id);
    }
    public function findAssociate($id,$relation = [])
    {
        return $this->applicationRepository->findAssociate($id,$relation);
    }
    public function destroy($id)
    {
        return $this->applicationRepository->delete($id);
    }
}
