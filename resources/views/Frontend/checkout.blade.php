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
			});

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
			});
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
			});
            $('.select').on('change',function(){
                var attr = $(this).attr('id');
                var code = $(this).val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                var res = '';
                if (attr == 'city') {
                        res = 'district';
                }else {
                        res = 'ward';
                }
                $.ajax({
                    url:'{{url('check-out/address-ajax')}}',
                    method:'POST',
                    data:{attr:attr,code:code,_token:_token},
                    success:function(data){
                        $('#'+res).html(data);
                    }
                });
            });
            $('.btn-calc_feeship').click(function(){
                var city_id = $('.city').val();
                var district_id = $('.district').val();
                var ward_id = $('.ward').val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:'{{url('check-out/calc-feeship-ajax')}}',
                    method:'POST',
                    data:{city_id:city_id,district_id:district_id,ward_id:ward_id,_token:_token},
                    success:function(data){
                       location.reload(data);
                    }
                })
            });
            $('.delete-cp').click(function(e) {
                e.preventDefault();
                var delete_cp = true;
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:"{{url('delete-cp')}}",
                    type:"GET",
                    data:{delete_cp:delete_cp,_token:_token},
                    success:function(){
                        location.reload();
                    }
                })
            })
            $('.delete-feeship').click(function(e) {
                e.preventDefault();
                var delete_feeship = true;
                var _token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url:"{{url('delete-feeship')}}",
                    type:"GET",
                    data:{delete_feeship:delete_feeship,_token:_token},
                    success:function(){
                        location.reload();
                    }
                })
            })
            $('.check_cod').click(function(){
                $('.check_cod').prop('checked',true);
                $('.check_paypal').prop('checked',false);
            })
            $('.check_paypal').click(function(){
                $('.check_cod').prop('checked',false);
                $('.check_paypal').prop('checked',true);
            })
		})
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
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('error')}}
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
                            @if(isset($gtotal))
							<table class="table table-condensed total-result">
                                @if(session('coupon'))
                                <tr class="cp">
                                    <td><a class="delete-cp" href=""><i class="fa fa-times"></i></a>Mã giảm giá</td>
                                    <td>{{session('coupon')['coupon']}}</td>
                                </tr>
                                    <tr class="cp-amount">
                                        <td>Lượng giảm giá</td>
                                        @if(session('coupon')['coupon_type'] == 'percentage')
                                            @php
                                                // luong giam gia
                                                $amount = ($gtotal * session('coupon')[ 'coupon_amount'])/100;
                                            @endphp
                                            <td>{{session('coupon')['coupon_amount']}}% ( {{$amount}}$ )</td>
                                        @else
                                            <td>{{session('coupon')['coupon_amount']}}$</td>
                                        @endif
                                    </tr>
                                @endif
                                @if(session('feeship'))
                                <tr class="fship">
                                    <td><a class="delete-feeship" href=""><i class="fa fa-times"></i></a>Phí vận chuyển</td>
                                    <td id="fee">{{session('feeship')['fee']}}$</td>
                                </tr>
                                @endif
								<tr>
									<td>Tổng cộng</td>

                                        @if(session('coupon') && !session('feeship'))
                                            @if(session('coupon')['coupon_type'] == 'percentage')
                                                @php
                                                    // luong giam gia
                                                    $amount = ($gtotal * session('coupon')[ 'coupon_amount'])/100;
                                                    // so tien can thanh toan sau giam gia
                                                    $gtotal_after_cp = $gtotal - $amount;
                                                @endphp
                                                    <td><span class="gtotal">{{$gtotal_after_cp}}$ = ( {{$gtotal}}$ - {{$amount}}$ )</span></td>
                                            @else
                                                @php
                                                    $gtotal_after_cp = $gtotal - session('coupon')['coupon_amount'];
                                                @endphp
                                                    <td><span class="gtotal">{{$gtotal_after_cp}}$ = ( {{$gtotal}}$ - {{session('coupon')['coupon_amount']}}$ )</span></td>
                                            @endif
                                        @endif

                                        @if(!session('coupon') && session('feeship'))
                                            @php
                                                $gtotal_after_fee = $gtotal + session('feeship')['fee'];
                                            @endphp
                                            <td><span class="gtotal">{{$gtotal_after_fee}}$ = ( {{$gtotal}}$ + {{session('feeship')['fee']}}$ )</span></td>
                                        @endif

                                        @if(session('coupon') && session('feeship'))
                                            @if(session('coupon')['coupon_type'] == 'percentage')
                                                @php
                                                    // luong giam gia cp
                                                    $cp_amount = ($gtotal * session('coupon')[ 'coupon_amount'])/100;
                                                    // so tien can thanh toan sau giam gia + phi van chuuyen
                                                    $gtotal_after = $gtotal - $cp_amount + session('feeship')['fee'];
                                                @endphp
                                                <td><span class="gtotal">{{$gtotal_after}}$ = ( {{$gtotal}}$ - {{$cp_amount}}$ + {{session('feeship')['fee']}}$ )</span></td>
                                            @else
                                                @php
                                                    $gtotal_after = $gtotal - session('coupon')['coupon_amount'] + session('feeship')['fee'];
                                                @endphp
                                                <td><span class="gtotal">{{$gtotal_after}}$ = ( {{$gtotal}}$ - {{session('coupon')['coupon_amount']}}$ + {{session('feeship')['fee']}}$ )</span></td>
                                            @endif
                                        @endif
                                        @if(!session('coupon') && !session('feeship'))
                                            @php
                                                $gtotal_after = $gtotal;
                                            @endphp
                                            <td><span class="gtotal">{{$gtotal_after}}$ = ( {{$gtotal}} - 0$ - 0$ )</span></td>
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
        <div>
        <div class="row">
            <div class="col">
                <div class="review-payment">
                    <h2>Coupon</h2>
                </div>
                <form action="{{route('checkCoupon')}}" method="GET">
                    @csrf
                    @method('GET')
                    <label for="">Coupon code :</label>
                    <input autocomplete="off" type="text" name="coupon_code" placeholder="Enter the Coupon Code">&nbsp;
                    <button type="submit" class="btn btn-sm btn-success">Hoàn thành</button>
                </form>
            </div>
            <div class="col">
                <div class="review-payment">
                    <h2>Delivery</h2>
                </div>
                <div style="width:100%">
                    <div class="mb-3">
                        <label class="form-label ">City</label>
                        <select class="form-control select city" name="city_id" id="city" >
                            <option value="">Select City</option>
                            @foreach($city as $value)
                                <option value="{{$value->city_code}}">{{$value->city_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">District</label>
                        <select class="form-control select district" name="distric_id" id="district" >
                            <option value="">Select District</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ward</label>
                        <select  class="form-control ward" name="ward_id" id="ward" >
                            <option value="">Select Ward</option>
                        </select>
                    </div>
                    <br>
                    <button class="btn btn-default btn-success btn-calc_feeship">Tính phí vận chuyển</button>
                </div>
            </div>
            <div class="col">
                <div class="review-payment">
                    <h2>Payment</h2>
                </div>&nbsp;
                <div>
                    <form action="{{route('sendmail')}}" method="POST">
                        @csrf
                        <div class="payment-options">
                            <span><label><input class="check_cod" name="cod_payment" type="radio"> COD</label></span>
                            <span><label><input class="check_paypal" name="paypal_payment" type="radio"> Paypal</label></span>
                        <input type="hidden" name="total_paypal" value="@if(isset($gtotal_after))@php echo $gtotal_after @endphp @endif">
                        <button type="submit" class="btn btn-default order">Order</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
			@endif
		</div>
	</div>
</section> <!--/#cart_items-->
@endsection
