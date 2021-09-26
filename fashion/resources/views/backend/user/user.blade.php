@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tài khoản</h1>
            @if (!empty(session('thongbao')))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">{{session('thongbao')}}</h4>
                </div>
            @endif
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Tài khoản</a></li>
                <li class="breadcrumb-item active">Danh sách tài khoản</li>
            </ol>
            <a href="/admin/user/add" style="margin-bottom: 20px" type="button" class="btn btn-primary">Thêm tài khoản</a>
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Giới tính</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Tên</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Giới tính</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->address}}</td>
                                <td>@if($user->gender == 1)
                                    Nam
                                    @elseif($user->gender == 0)
                                    Nữ
                                    @endif</td>
                                <td>{{$user->email}}</td>
                                <td>@if($user->role == 1)
                                    Admin
                                    @elseif($user->role == 0)
                                    Manager
                                    @endif
                                </td>
                                <td>
                                    <a href="/admin/user/edit/{{$user->id}}"><i class="fas fa-edit"></i></a>
                                    <a href="/admin/user/delete/{{$user->id}}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Your Website 2021</div>
                <div>
                    <a href="#">Privacy Policy</a>
                    &middot;
                    <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
        </div>
    </footer>
</div>
@endsection