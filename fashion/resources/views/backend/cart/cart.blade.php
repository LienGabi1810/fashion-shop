@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')
<div id="layoutSidenav_content" style="padding-left: 205px; padding-top: 50px;">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Đơn hàng</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Danh sách đơn hàng</li>
            </ol>
            {{-- <a href="/admin/cart/add" style="margin-bottom: 20px" type="button" class="btn btn-primary">Lên đơn</a> --}}
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Tên khách hàng</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Tên sản phẩm</th>
                                <th>Tổng tiền</th>
                                <th>Tình trạng</th>
                                <th>Ngày lên đơn</th>
                                <th>Vận chuyển</th>
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
                                <th>Tình trạng</th>
                                <th>Ngày lên đơn</th>
                                <th>Vận chuyển</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($order as $item)
                            <tr data-id={{$item->id}} class="data-id">
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{$item->address}}</td>
                                <td>{{$item->info}}</td>
                                <td>{{$item->total}}</td>
                                <td>
                                    <select>
                                        <option value="0" @if($item->status_order==0)selected @endif>Đang chờ</option>    
                                        <option value="1" @if($item->status_order==1)selected @endif>Đang giao</option>    
                                        <option value="2" @if($item->status_order==2)selected @endif>Thành công</option>    
                                        <option value="3" @if($item->status_order==3)selected @endif>Thất bại</option>    
                                    </select>
                                </td>
                                <td>{{$item->created_at}}</td>
                                <th>
                                    <select class="change-to-ship">
                                        <option value="-1">Chọn</option>      
                                        <option class="change-to-post-office" value="0" @if($item->ship==0)selected @endif>Bưu Điện</option>        
                                        <option class="change-to-ship" value="1" @if($item->ship==1)selected @endif>Ship</option>        
                                    </select>
                                </th>
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
            $('.change-to-ship').on('change', function(){
                var value = $(this).find('option:selected').val();
                var id = $(this).parent().parent().attr('data-id');
                $.get("/admin/cart/changetoship/"+value+"/"+id,
				function(data)
				{
					if(data=='success'){
						alert('cập nhật thành công');
                        window.location.reload();
					}
					else
					{
						alert('Cập nhật thất bại!');
                        window.location.reload();
					}
				}
			);
            })
        });

    </script>
@endsection


    