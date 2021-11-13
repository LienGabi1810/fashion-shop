@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Product</h1>
            @if (!empty(session('thongbao')))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">{{session('thongbao')}}</h4>
                </div>
            @endif
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
                                <th  style="text-align:center">Mã sản phẩm</th>
                                <th style="text-align:center">Ảnh sản phẩm</th>
                                <th style="text-align:center">Tên sản phẩm</th>
                                <th style="text-align:center">Danh mục</th>
                                <th style="text-align:center">Số lượng</th>
                                <th style="text-align:center">Tình trạng</th>
                                <th style="text-align:center">Giá</th>
                                <th style="text-align:center">Sản phẩm nổi bật</th>
                                <th style="text-align:center">Sản phẩm khuyến mãi</th>
                                <th style="text-align:center">Tùy chọn</th>
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
                            @foreach ($products as $product)
                            <tr style="height: 100px; text-align:center">
                                <td>{{$product->code}}</td>
                                <td>
                                    <img src="/uploads/products/{{$product->image}}" alt="" style="height: 80px; width:80px">
                                </td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->category}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->status}}</td>
                                <td>{{$product->price}}</td>
                                <td>
                                    <i class="fas fa-check">{{$product->is_hightlights}}</i>
                                </td>
                                <td>
                                    <i class="fas fa-check">{{$product->is_hightlights}}</i>
                                </td>
                                <td> 
                                    <a href="/admin/product/edit/{{$product->id}}"><i class="fas fa-edit"></i></a>
                                    <a onclick="return del_user()" href="/admin/product/delete/{{$product->id}}"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                                
                            @endforeach
                            
                        </tbody>
                    </table>
                    <div align='right'>
                        {{$products->links("pagination::bootstrap-4")}}
                    </div>
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
<script>
    function del_user(){
        return confirm("bạn có muốn xóa sản phẩm này không?")
    }
</script>
