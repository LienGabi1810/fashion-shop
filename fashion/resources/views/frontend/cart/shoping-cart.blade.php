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
				Shoping Cart
			</span>
		</div>
	</div>
	
	@if(!empty(session('thongbao')))
	<div class="alert alert-primary" role="alert" style="text-align: center;"">
		<h3>Bạn đã đặt hàng thành công. Vui lòng kiểm tra email để biết thêm thông tin</h3>
	  </div>
	@endif
	
	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
					<div class="m-l-25 m-r--38 m-lr-0-xl">
						<div class="wrap-table-shopping-cart">
							<table class="table-shopping-cart">
								<tr class="table_head">
									<th class="column-1">Product</th>
									<th class="column-2"></th>
									<th class="column-3">Price</th>
									<th class="column-4" style="text-align:center">Quantity</th>
									{{-- <th class="column-5">Total</th> --}}
									<th class="column-6" style="text-align:right">Remove</th>
								</tr>
								@if($cart)
								@foreach ($cart as $item)
								<tr class="table_row">
									<td class="column-1">
										<div class="how-itemcart1">
											<img src="/uploads/products/{{ $item->options->img }}" alt="IMG">
										</div>
									</td>
									<td class="column-2">{{$item->name}}</td>
									<td class="column-3">{{number_format($item->price, 0,'', ',')}} VND</td>
									<td class="column-4">
										<div class="wrap-num-product flex-w m-l-auto m-r-0 update-cart">
											<div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m change-cart">
												<i class="fs-16 zmdi zmdi-minus"></i>
											</div>
											{{-- <input onChange="update_qty('{{$item->rowId}}',this.value,{{$item->id}})" min="1" type="number" id="quantity" name="quantity" class="form-control input-number text-center" value="{{$item->qty}}"> --}}
											<input min="1" rowId="{{$item->rowId}}" data-id="{{$item->id}}" id="number-product" class="mtext-104 cl3 txt-center num-product num-cart" type="number" name="num-product1" value="{{$item->qty}}">

											<div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m change-cart" id="123">
												<i class="fs-16 zmdi zmdi-plus"></i>
											</div>
										</div>
									</td>
									{{-- <td class="column-5">$ {{number_format($item->options->totalPrd, 0,'', ',')}}</td> --}}
									<td class="column-6"><a onclick="return del_cart()" href="/cart/remove/{{$item->rowId}}" class="close" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</a></td>
								</tr>
								@endforeach
								@endif
							</table>
						</div>

						<div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
							<div class="flex-w flex-m m-r-20 m-tb-5">
								<input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
									
								<div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
									Apply coupon
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
					<div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
						<h4 class="mtext-109 cl2 p-b-30">
							Cart Totals
						</h4>

						<div class="flex-w flex-t bor12 p-b-13">
							<div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
							</div>

							<div class="size-209">
								<span class="mtext-110 cl2">
									{{Cart::priceTotal()}} VND
								</span>
							</div>
						</div>
						<a style="margin-top:20px" href="/checkout" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
							Proceed to Checkout</a>
					</div>
				</div>
			</div>
		</div>
	</form>

@endsection

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script>
		$( document ).ready(function() {
			update_cart();
		});

		function del_cart(){
			return confirm("bạn có muốn xóa sản phẩm này khỏi giỏ hàng không?")
		}

		function update_cart(){
			$('.change-cart').on('click',function(){
				var rowId =  $(this).parent().find('#number-product').attr('rowid');
				var qty =  $(this).parent().find('#number-product').val();
				var id =  $(this).parent().find('#number-product').attr('data-id');
				console.log(rowId);
				console.log(qty);
				console.log(id);
				update_qty(rowId,qty,id);
			})
		}

		function update_qty(rowId,qty,id){
			$.get("/cart/update/"+rowId+"/"+qty+"/"+id,
				function(data)
				{
					if(data=='success'){
						window.location.reload();
					}
					else if(data=='error'){
						alert('vượt quá sản phẩm trong kho');
						window.location.reload();
					}
					else
					{
						alert('Cập nhật thất bại!');
					}
				}
			);
		}
    </script>