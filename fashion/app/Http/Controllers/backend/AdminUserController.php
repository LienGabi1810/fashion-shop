<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;

class AdminUserController extends Controller
{
   /**
     * @var UserRepositoryInterface|\App\Repositories\Repository
     */
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }


    public function getUser(){
        $users = $this->userRepo->getAll();
        return view('/backend/user/user',['users' => $users]);
    }


    public function getAddUser(){
        return view('/backend/user/add-user');
    }

    public function postAddUser(AddUserRequest $r){
        $user = $this->userRepo->postUser('',$r);
        return redirect('/admin/user')->with('thongbao','Đã thêm tài khoản thành công');
    }

    public function getEditUser($id){
        $user = $this->userRepo->find($id);
        return view('/backend/user/edit-user',['user' =>$user]);
    }

    public function postEditUser(EditUserRequest $r, $id){
        $user = $this->userRepo->postUser($id,$r);
        return redirect('/admin/user')->with('thongbao','Chỉnh sửa tài khoản thành công');
    }

    public function deleteUser($id){
        $user = User::find($id);
        $user->delete();
        //$this->userRepo->deleteUser($id);
        return redirect('/admin/user')->with('thongbao','Xóa tài khoản thành công');
    }
}
