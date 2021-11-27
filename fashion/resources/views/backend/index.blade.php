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
<script type="text/javascript">
    
</script>
@endsection