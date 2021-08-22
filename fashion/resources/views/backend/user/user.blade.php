@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Tài khoản</h1>
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
                            <tr>
                                <td>Phan văn tuấn</td>
                                <td>0942379525</td>
                                <td>trâu quỳ, gia lâm</td>
                                <td>nam</td>
                                <td>tuanphan7396@gmail.com</td>
                                <td>admin</td>
                                <td>
                                    <a href=""><i class="fas fa-edit"></i></a>
                                    <a href=""><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Phan văn tuấn</td>
                                <td>0942379525</td>
                                <td>trâu quỳ, gia lâm</td>
                                <td>nam</td>
                                <td>tuanphan7396@gmail.com</td>
                                <td>admin</td>
                                <td>
                                    <a href=""><i class="fas fa-edit"></i></a>
                                    <a href=""><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Phan văn tuấn</td>
                                <td>0942379525</td>
                                <td>trâu quỳ, gia lâm</td>
                                <td>nam</td>
                                <td>tuanphan7396@gmail.com</td>
                                <td>admin</td>
                                <td>
                                    <a href=""><i class="fas fa-edit"></i></a>
                                    <a href=""><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
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