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
                    @csrf
                    <div style="display: flex">
                        {{-- <div class="col-md-2" style="margin-right: 20px">
                            <p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>

                            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm"
                                value="Lọc kết quả">
                        </div>
                        <div class="col-md-2" style="margin-right: 20px">
                            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                        </div> --}}
                        <div class="col-md-2" style="margin-right: 20px">
                            <p>Tháng: 
                                <select class="dashboard-filter form-control" id="month">
                                    <option><--Chọn--></option>
                                    @for($i=1;$i<=12;$i++) 
                                        <option value="{{$i}}">Tháng {{$i}}</option> 
                                    @endfor
                                </select>
                            </p>

                            <input type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm"
                                value="Lọc kết quả">
                        </div>
                        <div class="col-md-2" style="margin-right: 20px">
                            <p>Năm: 
                                <select class="dashboard-filter form-control" id="year">
                                    <option><--Chọn--></option>
                                    @for($i=2018;$i<=2023;$i++) 
                                        <option value="{{$i}}">Năm {{$i}}</option> 
                                    @endfor
                                </select>
                            </p>
                        </div>

                        <div class="col-md-2">
                            <p>
                                Lọc theo:
                                <select class="dashboard-filter form-control" id="chart-onchange">
                                    <option><--Chọn--></option>
                                    <option value="thangtruoc">Tháng trước</option>
                                    <option value="thangnay">Tháng này</option>
                                    <option value="365ngayqua">365 ngày qua</option>
                                </select>
                            </p>
                        </div>
                    </div>
                <div class="col-xl-12" style="margin-top: 20px;">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Biểu đồ doanh thu
                        </div>
                        <div id="chart" style="height:250px">
                        </div>
                    </div>
                </div>
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

       getChart30day();
       getChartDonut();

       var chart =   new Morris.Area({
       // ID of the element in which to draw the chart.
       element: 'chart',

       lineColors: ['#407294','#800869'],
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
       ykeys: ['sales','total'],
       behaveLikeline: true,
       // Labels for the ykeys -- will be displayed when you hover over the
       // chart.
       labels: ['Doanh thu','Tổng đơn hàng']
       });

        var donut = Morris.Donut({
            element: 'donut-example',
            data: [
                {label: "Download Sales", value: 12},
                {label: "In-Store Sales", value: 30},
                {label: "Mail-Order Sales", value: 20}
            ]
        });

       $("#btn-dashboard-filter").click(function(){
           var _token = $('input[name="_token"]').val();
           var from_date = $('#datepicker').val();
           var to_date = $('#datepicker2').val();
           var month = $('#month').val();
           var year = $('#year').val();
           var url = "http://127.0.0.1:8000/admin/chart"
           $.ajax({
               url: url,
               method: "POST",
               dataType: "JSON",
               data:{_token:_token,month:month,year:year},

               success:function(data){
                   console.log(data);
                    chart.setData(data);
               }
           });     
       });

       $("#chart-onchange").on('change',function(){
           var value = $(this).val();
           var _token = $('input[name="_token"]').val();
           if(value == 'thangtruoc'){
                var url = "http://127.0.0.1:8000/admin/lastmonth"
           } else if(value == '365ngayqua'){
                var url = "http://127.0.0.1:8000/admin/oneyear"
           }
           else if(value == 'thangnay'){
                var url = "http://127.0.0.1:8000/admin/chart30day"
           }
           $.ajax({
               url: url,
               method: "POST",
               dataType: "JSON",
               data:{value:value,_token:_token},

               success:function(data){
                console.log(data);
                   chart.setData(data);
               }
           });     
       });

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

       function getChartDonut(){
           var _token = $('input[name="_token"]').val();
           var url = "http://127.0.0.1:8000/admin/chartdonut";
           var data1 = [
                {label: "Download Sales", value: 12},
                {label: "In-Store Sales", value: 30},
                {label: "Mail-Order Sales", value: 20}
            ];
            console.log(data1);
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