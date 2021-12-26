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
                @csrf
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
                                <td> 
                                    <button class="order-detail" data-value = {{$item->id}}>Xem chi tiết</button>
                                </td>
                                <td>{{number_format($item->total, 0,'', ',')}}</td> 
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
                    <div align='right'>
                        {{$order->links("pagination::bootstrap-4")}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="dialog" title="Chi tiết đơn hàng" hidden>
        <div style="display: flex; text-align: center">
            <div>
                <i class="fab fa-shopify"></i>
            </div>
            <div>
                <h5>Liên Fashion </h5>
            </div>
            
        </div>
       <div style="text-align: center">
            <label for=""><b>Hóa đơn bán hàng</b></label>
       </div>
        
       <div>
        <label for="">Địa chỉ: .... Cầu giấy - Hà nội</label>
        <br>
        <label for="">Số điện thoại: 0981998598</label>
        <br>
        <label for="">Ngày lên đơn: 05/12/2021</label>
        <br>
        <label for="">Ngày xuất hóa đơn: 05/12/2021</label>
        <br>
        <label for="">Mã hóa đơn: 12165465465</label>
       </div>
        <div class="container">
			<table class="table" id="order-detail">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã sản phẩm</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Đơn giá</th>
                    <th scope="col">Thành tiền</th>
                    
                  </tr>
                </thead>
                <tbody>
                 
                </tbody>
              </table>
		</div>
        <div>
            <label for="">Giảm giá: ... (%)</label>
        </div>
       <div>
        <label for="">Tổng tiền: <span id="total">1000</span> VND</label>
       </div>
       <input type='button' id='btn' value='In ra'>


    </div>
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

            $(".order-detail").click(function(){
                $("#dialog").dialog();
                var _token = $('input[name="_token"]').val();
                var value = $(this).attr('data-value');
                var url = "http://127.0.0.1:8000/admin/cart/order-detail";
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "JSON",
                    data:{_token:_token,value:value},

                    success:function(data){
                        $('#dialog').attr('hidden', false);
                        $("#dialog").dialog();
                        $("#order-detail > tbody").append(data.html);
                        $('#total').text(data.total);
                        
                        $('#btn').on('click', function(){
                            var divToPrint=document.getElementById('dialog');

                            var newWin=window.open('','Print-Window');

                            newWin.document.open();

                            newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

                            newWin.document.close();

                            setTimeout(function(){newWin.close();},10);

                        })
                    }
                });     
            });

           

        });

    </script>
@endsection


    