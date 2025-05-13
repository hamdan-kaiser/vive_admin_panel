<?php
namespace App\Service;


use App\Repositories\UniversityRepository;
use DataTables;
class UniversityService
{
    protected $universityRepository;

    // Constructor to bind model to repo
    public function __construct(UniversityRepository $universityRepository)
    {
        $this->universityRepository = $universityRepository;
    }

    public function all(){
        return  $this->universityRepository->all();
    }
    public function allAssociate(array $relation=[]){
        return  $this->universityRepository->allAssociate($relation);
    }
    public function getAllData(){
        $data = $this->universityRepository->allAssociate(['location','subjects']);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                return '<a href="'.route('administrative.university.edit',$row->id).'" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                </a>
                <a href="#" onclick="deleteData('.$row->id.');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                </a>
                ';
            })
            ->editColumn('scholarship',function ($row){
                $html = '<span class="badge border border-success text-success">Yes</span>';
                if(!$row['scholarship']){
                    $html = '<span class="badge border border-danger text-danger">No</span>';
                }
                return $html;
            })
            ->editColumn('ielts',function ($row){
                $html = '<span class="badge border border-success text-success">Yes</span>';
                if(!$row['ielts']){
                    $html = '<span class="badge border border-danger text-danger">No</span>';
                }
                return $html;
            })
            ->addColumn('subjects',function ($row){
                $subjects = $row->subjects;
                $html = '';
                foreach($subjects as $subjectItem){
                    $html.= '<span class="badge border border-success text-info mr-1">'.$subjectItem->title.'</span>';
                }

                return $html;
            })
             ->addColumn('location',function ($row){
                $location = $row->location;
                if(!$row['location']){
                    return '<span class="badge border border-success text-info mr-1"> Null </span>';
                }
        
                $html= '<span class="badge border border-success text-info mr-1">'.$location->title.'</span>';
        
                return $html;
            })
            ->rawColumns(['action','scholarship','subjects','location','ielts'])
            ->blacklist(['created_at', 'updated_at','action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function findbyId($id){
        return $this->universityRepository->show($id);
    }
    public function store($request){
        return $this->universityRepository->create($request->all());
    }
    public function update($id,$request){
        return $this->universityRepository->update($request->all(),$id);
    }
    public function findAssociate($id,$relation = [])
    {
        return $this->universityRepository->findAssociate($id,$relation = []);
    }
    public function destroy($id)
    {
        return $this->universityRepository->delete($id);
    }
}
