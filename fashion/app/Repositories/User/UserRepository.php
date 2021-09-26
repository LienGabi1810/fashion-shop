<?php
namespace App\Repositories\User;

use App\Repositories\BaseRepository;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getUser()
    {
        return $this->model->select('name')->take(5)->get();
    }

    public function postUser($id, $r)
    {
        $user = $this->model->find($id);
        $user = array(
            'name' => $r->name,
            'phone' => $r->phone,
            'address' => $r->address,
            'email' => $r->email,
            'password' => $r->password,
            'gender' => $r->gender,
            'role' => $r->role
        );
        
        if($id){
            return $this->model->where('id', $id)->update($user);
        }else{
            return $this->model->create($user);
        }
    }

    public function deleteUser($id)
    {
        return $this->model->delete($id);
    }
}