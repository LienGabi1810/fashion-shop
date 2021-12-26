@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Báo cáo tồn kho @if (!empty(session('thongbao')))- {{session('thongbao')}}@endif</h1>
            <ol class="breadcrumb mb-4">
                <select id="warehouse">
                    <option value="all">Tất cả sản Phẩm</option>
                    <option value="outofstock">Sản phẩm hết hàng</option>
                    <option value="new">Sản phẩm mới nhất</option>
                    <option value="selling">Sản phẩm bán chạy</option>
                    <option value="notselling">Số phẩm không bán được</option>
                </select>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Danh sách sản phẩm
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
                                <th style="text-align:center">Tổng đơn đã bán</th>
                                <th style="text-align:center">Tổng tiền thu được</th>
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
                                <th>Tổng đơn đã bán</th>
                                <th>Tổng tiền thu được</th>
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
                                <td>
                                @if (!empty($product->category->name))
                                    {{$product->category->name}}
                                @else
                                    
                                @endif
                                </td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->status}}</td>
                                <td>{{$product->price}}</td>
                                @if(!empty($product->qty_sell))
                                    <td>{{$product->qty_sell}}</td>
                                    <td>{{number_format($product->total_sell, 0,'',',') }}</td>
                                @else
                                    <td>0</td>
                                    <td>0</td>
                                @endif
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
@section('js')
<script>
    $(document).ready(function(){

        $('#warehouse').on('change',function(){
            var value = this.value;
            var url = '/admin/warehouse/' + value;
            window.location.href = url;
        })

    })

</script> 
@endsection