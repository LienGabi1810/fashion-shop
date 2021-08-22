@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Product</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Product</a></li>
                <li class="breadcrumb-item active">List Product</li>
            </ol>
            <a href="/admin/product/add" style="margin-bottom: 20px" type="button" class="btn btn-primary">Thêm sản phẩm</a>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    DataTable Example
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Số lượng</th>
                                <th>Tình trạng</th>
                                <th>Giá</th>
                                <th>Sản phẩm nổi bật</th>
                                <th>Sản phẩm khuyến mãi</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Mã sản phẩm</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Số lượng</th>
                                <th>Tình trạng</th>
                                <th>Giá</th>
                                <th>Sản phẩm nổi bật</th>
                                <th>Sản phẩm khuyến mãi</th>
                                <th>Tùy chọn</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td></td>
                                <td>Áo sọc kẻ</td>
                                <td>Áo</td>
                                <td>100</td>
                                <td>Còn hàng</td>
                                <td>100000</td>
                                <td>
                                    <i class="fas fa-check"></i>
                                </td>
                                <td>
                                    <i class="fas fa-check"></i>
                                </td>
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