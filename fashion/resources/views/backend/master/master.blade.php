<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>@yield('title')</title>
        <base href="/backend/">
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        {{-- ChartScript --}}
        
    </head>
    <body class="sb-nav-fixed">
        <!--header-->
         @include('backend/master/header')
        <!--endheader-->
        <div id="layoutSidenav">
            <!-- side bar -->
            @include('backend/master/sidebar')
            <!-- end side bar -->
            <!-- Content -->
            @yield('content')
            <!-- endContent -->
        </div>

            <!-- javascript -->
    @section('script')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
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
        <script>
            $( function() {
              $( "#datepicker" ).datepicker();
              
              $( "#datepicker2" ).datepicker();
            });
        </script>
        <script type="text/javascript">
                
        </script>
        @yield('js')
    </body>
    @show
</html>




