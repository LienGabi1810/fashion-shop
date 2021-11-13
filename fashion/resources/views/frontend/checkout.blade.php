@extends('frontend/master/master')
@section('title','Cart')
@section('content')
	<!-- breadcrumb -->
	<div class="container" style="padding-top: 75px;">
		<hr>
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Checkout
			</span>
		</div>
	</div>
    <form method="POST" action="/checkout" style="margin-top:30px">
        @csrf
		<div class="container">
			<div class="row">
				<div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" placeholder="Tên" aria-label="Username" aria-describedby="basic-addon1" value=@if(Auth::guard('customer')->user()) {{Auth::guard('customer')->user()->username}} @endif>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" aria-label="Username" aria-describedby="basic-addon1" value=@if(Auth::guard('customer')->user()) {{Auth::guard('customer')->user()->phone}} @endif>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="address" placeholder="Địa chỉ" aria-label="Username" aria-describedby="basic-addon1" value=@if(Auth::guard('customer')->user()) {{Auth::guard('customer')->user()->address}} @endif>
                    </div>
                 </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1"value=@if(Auth::guard('customer')->user()) {{Auth::guard('customer')->user()->email}} @endif>
                    </div>
                 </div>
                 <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" name="description" placeholder="Ghi chú" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                 </div>
                 <button style="margin-left: 635px;margin-bottom: 30px;margin-top: 30px;width: 132px;height: 42px;" type="submit" class="btn btn-primary">Đặt hàng</button>
			</div>
		</div>
	</form>
@endsection