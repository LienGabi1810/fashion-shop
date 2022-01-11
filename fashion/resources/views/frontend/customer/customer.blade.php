<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <base href="/backend/">
        <title>Thông tin của bạn</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>
            p {
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                width: 200px;
}
        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3 hidden" href="/">Lien Fashion</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4" style="display:none">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Thông tin của bạn
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="/customer" active>Danh sách đơn hàng</a>
                                    <a class="nav-link" href="/customer/info">Thông tin</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                   
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Chào mừng: {{ Auth::guard('customer')->user()->username}}</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Danh sách đơn hàng của bạn
                            </div>
                            @csrf
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    @csrf
                                    <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Thông tin </th>
                                            <th>Xem chi tiết</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Thông tin </th>
                                            <th>Xem chi tiết</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($order as $item)
                                        <tr data-id={{$item->id}}>
                                            <td>{{$item->id}}</td>
                                            <td style="display: flex"><p>{{$item->info}}</p></td>
                                            <td><button class="order-detail" data-value = {{$item->id}}>Xem chi tiết</button></td>
                                            <td>
                                                <select @if($item->status_order==-1|| $item->status_order==1|| $item->status_order==2 || $item->status_order==3) disabled @endif class="destroy-order">
                                                    <option value="-1" @if($item->status_order==-1)selected  @endif>Hủy đơn</option>    
                                                    <option value="0" @if($item->status_order==0)selected  @endif @if($item->status_order==-1)disabled  @endif>Đang chờ</option>    
                                                    <option value="1" @if($item->status_order==1)selected @endif @if($item->status_order==0 || $item->status_order==-1)disabled  @endif>Đang giao</option>    
                                                    <option value="2" @if($item->status_order==2)selected @endif @if($item->status_order==0 ||$item->status_order==-1)disabled  @endif>Thành công</option>    
                                                    <option value="3" @if($item->status_order==3)selected @endif @if($item->status_order==0 ||$item->status_order==-1)disabled  @endif>Thất bại</option>    
                                                </select>
                                            </td>
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
            </div>
        </div>
        <div id="dialog" title="Chi tiết đơn hàng" hidden>
            <div style="display: flex; text-align: center">
                <div>
                    <i class="fab fa-shopify"></i>
                </div>
                <div>
                    <h5>Liên Fashion </h5>
                </div>
                
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

    </body>
</html> 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $('.destroy-order').on('change', function(){
            var value = $(this).find('option:selected').val();
            var id = $(this).parent().parent().attr('data-id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
               url: 'http://127.0.0.1:8000/customer/destroy',
               method: "POST",
               dataType: "JSON",
               data:{_token:_token,id:id},
               success:function(response){
                if(response == 'success'){
						alert('cập nhật thành công');
                        window.location.reload();
					}
					else
					{
						alert('Cập nhật thất bại!');
                        window.location.reload();
					}
               }
           });  
        })

        $(".order-detail").click(function(){
                $("#dialog").dialog();
                var _token = $('input[name="_token"]').val();
                var value = $(this).attr('data-value');
                console.log(value);
                var url = "http://127.0.0.1:8000/customer/order-detail1";
                $.ajax({
                    url: url,
                    method: "POST",
                    dataType: "JSON",
                    data:{_token:_token,value:value},

                    success:function(data){
                        console.log(data);
                        $('#dialog').attr('hidden', false);
                        $("#dialog").dialog();
                        $("#order-detail > tbody").append(data.html);
                        $('#total').text(data.total);
                    }
                });     
            });

    });

</script>
