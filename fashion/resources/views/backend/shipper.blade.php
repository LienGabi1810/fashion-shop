@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content" style="padding-left: 205px; padding-top: 50px;">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Đơn hàng</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.html">Đơn hàng</a></li>
                <li class="breadcrumb-item active">Danh sách đơn hàng đang chờ ship của bạn</li>
            </ol>
            {{-- <a href="/admin/cart/add" style="margin-bottom: 20px" type="button" class="btn btn-primary">Lên đơn</a> --}}
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        @csrf
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Tên sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Ngày lên đơn</th>
                                <th>Tình trạng</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Tên sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Ngày lên đơn</th>
                                <th>Tình trạng</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($order as $item)
                            <tr data-id="{{$item->id}}">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->info}}</td>
                                <td>{{$item->total}}</td>
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <select class="change-status" @if($item->status_order==-1|| $item->status_order==2 || $item->status_order==3) disabled @endif>
                                        <option value="-1" @if($item->status_order==-1)selected  @endif>Hủy đơn</option>    
                                        <option value="0" @if($item->status_order==0)selected @endif @if($item->status_order==1) disabled @endif>Đang chờ</option>    
                                        <option value="1" @if($item->status_order==1)selected @endif>Đang giao</option>    
                                        <option value="2" @if($item->status_order==2)selected @endif>Thành công</option>    
                                        <option value="3" @if($item->status_order==3)selected @endif>Thất bại</option>    
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>
@section('js')
    <script>
        $(document).ready(function() {
            $('.change-status').on('change', function(){
                var value = $(this).find('option:selected').val();
                var id = $(this).parent().parent().attr('data-id');
                var _token = $('input[name="_token"]').val();
                    var url = "http://127.0.0.1:8000/admin/ship/changestatusship"
                    $.ajax({
                        url: url,
                        method: "POST",
                        dataType: "JSON",
                        data:{id:id,value:value,_token:_token},
                    success:function(data){
                    if(data=='success'){
                        alert('cập nhật thành công');
                        window.location.reload();
                    }else{
                        alert('Cập nhật thất bại');
                        window.location.reload();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error: ' + textStatus + ' ' + errorThrown);
                  }
                });  
            })
        });

    </script>
@endsection
