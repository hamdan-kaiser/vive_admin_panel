<?php
namespace App\Service;


use App\Repositories\UserRepository;
use DataTables;
class UserService
{
    protected $userRepository;

    // Constructor to bind model to repo
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function all(){
        return  $this->userRepository->all();
    }
    public function allAssociate(array $relation=[]){
        return  $this->userRepository->allAssociate($relation);
    }
    public function getAllData(array $relation=[]){
        $data = $this->userRepository->allAssociate($relation);
        return Datatables::of($data)
            ->addColumn('action', function ($row) {
                return '<a href="'.route('administrative.user.edit',$row->id).'" >
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                </a>
                <a href="#" onclick="deleteData('.$row->id.');">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg>
                </a>
                ';
            })
            ->addColumn('role',function ($row){
                return $roles = $row->getRoleNames();
            })

            ->rawColumns(['action','role'])
            ->blacklist(['created_at', 'updated_at','action'])
            ->addIndexColumn()
            ->toJson();
    }
    public function findbyId($id){
        return $this->userRepository->show($id);
    }
    public function store($request){
        return $this->userRepository->create($request->all());
    }
    public function update($id,$request){
        return $this->userRepository->update($request->all(),$id);
    }
    public function findAssociate($id)
    {
        return $this->userRepository->findAssociate($id,$relation = []);
    }
    public function destroy($id)
    {
        return $this->userRepository->delete($id);
    }
}
