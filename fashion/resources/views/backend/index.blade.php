@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Liên Fashion</h1>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Tổng doanh thu</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <p>756,142,000</p>
                            <div class="small text-white"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Tổng đơn hàng</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <p>156</p>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Tổng khách hàng</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <p>15,000</p>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-danger text-white mb-4">
                        <div class="card-body">Tổng số lượng sản phẩm</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <p>1050 </p>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            @if (!@empty(session('thongbao')))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">{{session('thongbao')}}</h4>
                </div>
            @endif
            <div class="row">
                @csrf
                <div class="col-xl-12" style="margin-top: 20px;">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                           Tổng quan đơn hàng
                        </div>
                        <div id="donut-example"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</div>

@endsection

@section('js')
<script>
    $(document).ready(function(){

       getChartDonut();

        var donut = Morris.Donut({
            element: 'donut-example',
            data: [
                {label: "Download Sales", value: 12},
                {label: "In-Store Sales", value: 30},
                {label: "Mail-Order Sales", value: 20}
            ]
        });

       function getChartDonut(){
           var _token = $('input[name="_token"]').val();
           var url = "http://127.0.0.1:8000/admin/chartdonut";
           var data = [
                {label: "Download Sales", value: 12},
                {label: "In-Store Sales", value: 30},
                {label: "Mail-Order Sales", value: 20}
            ];
           $.ajax({
               url: url,
               method: "POST",
               dataType: "JSON",
               data:{_token:_token},
               success:function(data){
                   console.log(data);
                   donut.setData((data));
               }
           });  
       }


   });
</script> 
@endsection