@extends('backend/master/master')
@section('title','Lien Fashion')
@section('content')

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            @if (!@empty(session('thongbao')))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">{{session('thongbao')}}</h4>
                </div>
            @endif
            <div class="row">
                <form action="">
                    @csrf
                    {{-- <div style="display: flex">
                        <div class="col-md-2" style="margin-right: 20px">
                            <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>

                            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm"
                                value="Lọc kết quả">
                        </div>
                        <div class="col-md-2" style="margin-right: 20px">
                            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                        </div>

                        <div class="col-md-2">
                            <p>
                                Lọc theo:
                                <select class="dashboard-filter form-control">
                                    <option><--Chọn--></option>
                                    <option value="7ngayqua">7 ngày qua</option>
                                    <option value="thangtruoc">Tháng trước</option>
                                    <option value="thangnay">Tháng này</option>
                                    <option value="365ngayqua">365 ngày qua</option>
                                </select>
                            </p>
                        </div>
                    </div> --}}
                </form>
                <div class="col-xl-12" style="margin-top: 20px;">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Biểu đồ doanh thu
                        </div>
                        <div id="chart" style="height:250px">
                        </div>
                        {{-- <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div> --}}
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

       getChart30day();

       var chart =   new Morris.Area({
       // ID of the element in which to draw the chart.
       element: 'chart',

       lineColors: ['#407294'],
       pointFillColors:['#ffff'],
       pointStrokeColors: ['black'],
       fillOpacity: 0.3,
       hideHover: 'auto',
       parsetime: false,
       // Chart data records -- each entry in this array corresponds to a point on
       // the chart.

       // The name of the data record attribute that contains x-values.
       xkey: 'date',
       // A list of names of data record attributes that contain y-values.
       ykeys: ['total'],
       behaveLikeline: true,
       // Labels for the ykeys -- will be displayed when you hover over the
       // chart.
       labels: ['Tổng tiền']
       });

       

       // $("#btn-dashboard-filter").click(function(){
       //     var _token = $('input[name="_token"]').val();
       //     var from_date = $('#datepicker').val();
       //     var to_date = $('#datepicker2').val();
       //     var url = "http://127.0.0.1:8000/admin/chart"
       //     $.ajax({
       //         url: url,
       //         method: "POST",
       //         dataType: "JSON",
       //         data:{from_date:from_date,to_date:to_date,_token:_token},

       //         success:function(data){
       //             chart.setData(data);
       //         }
       //     });     
       // });

       function getChart30day(){
           var _token = $('input[name="_token"]').val();
           var url = "http://127.0.0.1:8000/admin/chart30day"
           $.ajax({
               url: url,
               method: "POST",
               dataType: "JSON",
               data:{_token:_token},
               success:function(data){
                   chart.setData((data));
               }
           });  
       }
   });
</script> 
@endsection