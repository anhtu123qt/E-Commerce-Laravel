@extends('frontend_layout')
@section('title')
Checkout | E-Shopper
@endsection
<head>
	<script>
		if(screen.width <= 736){
			document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
		}
	</script>
	<link type="text/css" rel="stylesheet" href="{{asset('frontend/css/rate.css')}}">
	<script src="{{asset('frontend/js/jquery-1.9.1.min.js')}}"></script>
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$(document).ready(function(){
			$('.cart_quantity_up').click(function(e) {
				e.preventDefault();
				var qty = $(this).next().val();
				var id = $(this).prev().val();
				var price = $(this).closest('td').prev().find('p').text().slice(0,-1);
				var total = $(this).closest('td').next().find('.cart_total_price').text();
				var qtyNew = $(this).next().val(parseInt(qty) + 1);
				var totalNew = $(this).closest('td').next().find('.cart_total_price').text(parseInt(total) + parseInt(price) + '$');
				var gtotal = $(this).closest('tr').next().find('.gtotal').text().slice(0,-1);
				var gtotalNew = $(this).closest('tr').next().find('.gtotal').text(parseInt(gtotal) + parseInt(price) + '$');
				var _token = $('meta[name="csrf-token"]').attr('content');
				var flag = 1;
				$.ajax({
					url:"{{url('update-cart-up-qty')}}",
					type:"POST",
					data:{flag:flag,id:id,_token:_token},
					success:function(data) {

					}
				});
			})

			$('.cart_quantity_down').click(function(e) {
				e.preventDefault();
				var qty = $(this).prev().val();
				var id = $(this).prev().prev().prev().val();
				var price = $(this).closest('td').prev().find('p').text().slice(0,-1);
				var total = $(this).closest('td').next().find('.cart_total_price').text();
				var qtyNew = $(this).prev().val(parseInt(qty) - 1);
				var totalNew = $(this).closest('td').next().find('.cart_total_price').text(parseInt(total) - parseInt(price) + '$');
				var gtotal = $(this).closest('tr').next().find('.gtotal').text().slice(0,-1);
				var gtotalNew = $(this).closest('tr').next().find('.gtotal').text(parseInt(gtotal) - parseInt(price) + '$');
				var _token = $('meta[name="csrf-token"]').attr('content');
				var flag = 0;
				// alert(qty);
				$.ajax({
					url:"{{url('update-cart-down-qty')}}",
					type:"POST",
					data:{qty:qty-1,id:id,_token:_token},
					success:function(data) {
						if (qty - 1 == 0) {
							$('.trtable' + id).hide('2000');
						}
						$('#cart').html(data);
					}
				});
			})
			$('.cart_quantity_delete').click(function(e) {
				e.preventDefault();
				var pid = $(this).prev().val();
				var total = $(this).closest('td').prev().find('.cart_total_price').text().slice(0,-1);
				var gtotal = $(this).closest('tr').next().find('.gtotal').text().slice(0,-1);
				var gtotalNew = $(this).closest('tr').next().find('.gtotal').text(parseInt(gtotal) - parseInt(total) + '$');
				var _token = $('meta[name="csrf-token"]').attr('content');
				$.ajax({
					url:"{{url('delete-product')}}",
					type:"GET",
					data:{pid:pid,_token:_token},
					success:function(data){
						if (pid) {
							$('.trtable' + pid).hide('2000');

						}
						$('#cart').html(data);

					}
				})
			})
		});
	</script>
</head>
@section('frontend_content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Check out</li>
			</ol>
		</div><!--/breadcrums-->
		<div class="review-payment">
			<h2>Review & Payment</h2>
		</div>
		@if(session('success'))
		<div class="alert alert-success alert-dismissible">
			<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
			{{session('success')}}
		</div>
		@endif
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description"></td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@if(session()->get('cart'))
					@php
					$gtotal = 0;
					@endphp
					@foreach(session()->get('cart') as $cart)
					@php
					$total = 0;
					$total = $cart['product_price'] * $cart['product_qty'];
					$gtotal += $total;
					@endphp
					<tr class="trtable{{$cart['product_id']}}">
						<td class="cart_product">
							<a href=""><img width="120px" height="100px" src="{{$cart['product_image']}}" alt=""></a>
						</td>
						<td class="cart_description">
							<h4><a href="">{{$cart['product_name']}}</a></h4>
						</td>
						<td class="cart_price">
							<p>{{$cart['product_price']}}$</p>
						</td>
						<td class="cart_quantity">
							<div class="cart_quantity_button">
								<input type="hidden" value="{{$cart['product_id']}}">
								<a class="cart_quantity_up" href=""> + </a>
								<input class="cart_quantity_input" type="text" name="quantity" value="{{$cart['product_qty']}}" autocomplete="off" size="2">
								<a class="cart_quantity_down" href=""> - </a>
							</div>
						</td>
						<td class="cart_total">
							<p class="cart_total_price">{{$total}}$</p>
						</td>
						<td class="cart_delete">
							<input type="hidden" value="{{$cart['product_id']}}">
							<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
						</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">
							<table class="table table-condensed total-result">
								{{-- <tr>
									<td>Cart Sub Total</td>
									<td>$59</td>
								</tr>
								<tr>
									<td>Exo Tax</td>
									<td>$2</td>
								</tr> --}}
								<tr>
									<td>Total</td>
                                    @if(isset($gtotal))
                                        @if(session('coupon'))
                                            @if(session('coupon')['coupon_type'] == 'percentage')
                                                @php
                                                    // luong giam gia
                                                    $cAmount = ($gtotal * session('coupon')['coupon_amount'])/100;
                                                    // so tien can thanh toan sau giam gia
                                                    $gTotal = $gtotal - $cAmount;
                                                @endphp
                                                <td><span class="gtotal">{{$gTotal}}$</span></td>
                                            @elseif(session('coupon')['coupon_type'] == 'fixed')
                                                @php
                                                    $gTotal = $gtotal - session('coupon')['coupon_amount'];
                                                @endphp
                                                <td><span class="gtotal">{{$gTotal}}$</span></td>
                                            @endif
                                        @else
                                            <td><span class="gtotal">{{$gTotal}}$</span></td>
                                        @endif
                                    @else
                                        <td><span class="gtotal"></span></td>
                                    @endif
								</tr>
							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="payment-options">
			<span>
				<label><input type="checkbox"> Direct Bank Transfer</label>
			</span>
			<span>
				<label><input type="checkbox"> Check Payment</label>
			</span>
			<span>
				<label><input type="checkbox"> Paypal</label>
			</span>
			<form action="{{route('sendmail')}}" method="GET">
				<input type="hidden" name="total" value="@if(isset($gTotal))@php echo $gTotal @endphp @endif">
				<button type="submit" class="btn btn-default order">Order</button>
			</form>
			@endif
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection
