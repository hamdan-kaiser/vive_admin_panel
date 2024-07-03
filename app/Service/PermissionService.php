<?php
namespace App\Service;


use App\Repositories\PermissionRepository;
use DataTables;
class PermissionService
{
    protected $PermissionRepository;

    // Constructor to bind model to repo
    public function __construct(PermissionRepository $PermissionRepository)
    {
        $this->PermissionRepository = $PermissionRepository;
    }

    public function all(){
        return  $this->PermissionRepository->all();
    }
    public function allAssociate(array $relation=[]){
        return  $this->PermissionRepository->all($relation);
    }
    public function getAllData(){
        $data = $this->PermissionRepository->all();
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                return '<a href="'.route('administrative.permission.edit',$row->id).'" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                </a>
                <a href="#" onclick="deleteData('.$row->id.');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                </a>
                ';
            })
            ->rawColumns(['action'])
            ->blacklist(['created_at', 'updated_at','action'])
            ->addIndexColumn()
            ->escapeColumns()
            ->toJson();
    }
    public function findbyId($id){
        return $this->PermissionRepository->show($id);
    }
    public function store($request){
        return $this->PermissionRepository->create($request->all());
    }
    public function update($id,$request){
        return $this->PermissionRepository->update($request->all(),$id);
    }
    public function findAssociate($id,array $relation)
    {
        return $this->PermissionRepository->findAssociate($id,$relation);
    }
    public function allAssociateFilter(array $relation=[],$filter = [],$condition='hard',$result = 'multiple'){
        return $this->PermissionRepository->allAssociateFilter($relation,$filter,$condition,$result);
    }
    public function allAssociateFilterPagignate(array $relation=[],$filter = [],$page = 1,$condition='hard'){
        return $this->PermissionRepository->allAssociateFilterPagignate($relation,$filter,$page,$condition);
    }
    public function destroy($id)
    {
        return $this->PermissionRepository->delete($id);
    }
}
