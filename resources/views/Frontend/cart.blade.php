@extends('frontend_layout')
@section('title')
My Cart
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
				var gtotal = $(this).closest('section').next().find('.gtotal').text().slice(0,-1);
				var gtotalNew = $(this).closest('section').next().find('.gtotal').text(parseInt(gtotal) + parseInt(price) + '$');
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
				var gtotal = $(this).closest('section').next().find('.gtotal').text().slice(0,-1);
				var gtotalNew = $(this).closest('section').next().find('.gtotal').text(parseInt(gtotal) - parseInt(price) + '$');
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
				var gtotal = $(this).closest('section').next().find('.gtotal').text().slice(0,-1);
				var gtotalNew = $(this).closest('section').next().find('.gtotal').text(parseInt(gtotal) - parseInt(total) + '$');
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
            {{--$('.select').on('change',function(){--}}
            {{--    var attr = $(this).attr('id');--}}
            {{--    var code = $(this).val();--}}
            {{--    var _token = $('meta[name="csrf-token"]').attr('content');--}}
            {{--    var res = '';--}}
            {{--    if (attr == 'city') {--}}
            {{--        res = 'district';--}}
            {{--    }else {--}}
            {{--        res = 'ward';--}}
            {{--    }--}}
            {{--    $.ajax({--}}
            {{--        url:'{{url('cart/address-ajax')}}',--}}
            {{--        method:'POST',--}}
            {{--        data:{attr:attr,code:code,_token:_token},--}}
            {{--        success:function(data){--}}
            {{--            $('#'+res).html(data);--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
            {{--$('.btn-calc_feeship').click(function(){--}}
            {{--    var city_id = $('.city').val();--}}
            {{--    var district_id = $('.district').val();--}}
            {{--    var ward_id = $('.ward').val();--}}
            {{--    var _token = $('meta[name="csrf-token"]').attr('content');--}}
            {{--    $.ajax({--}}
            {{--        url:'{{url('cart/calc-feeship-ajax')}}',--}}
            {{--        method:'POST',--}}
            {{--        data:{city_id:city_id,district_id:district_id,ward_id:ward_id,_token:_token},--}}
            {{--        success:function(data){--}}
            {{--            $('#fee-value').html(data);--}}
            {{--        }--}}
            {{--    })--}}
            {{--});--}}
            {{--$('.update').click(function(e) {--}}
            {{--    e.preventDefault();--}}
            {{--    var check_cp = $('.del-cp').prop('checked');--}}
            {{--    var _token = $('meta[name="csrf-token"]').attr('content');--}}
            {{--    $.ajax({--}}
            {{--        url:"{{url('delete-cp')}}",--}}
            {{--        type:"POST",--}}
            {{--        data:{check_cp:check_cp,_token:_token},--}}
            {{--        success:function(data){--}}
            {{--            location.reload(data);--}}
            {{--        }--}}
            {{--    })--}}
            {{--})--}}
		});
	</script>
</head>
@section('frontend_content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Shopping Cart</li>
			</ol>
		</div>
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
					@endif
				</tbody>
			</table>

		</div>
	</div>
</section> <!--/#cart_items-->

<section id="do_action">
	<div class="container">
		<div class="row">
            <div class="col-sm-6"></div>
			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						{{-- <li>Cart Sub Total <span>$59</span></li>
						<li>Eco Tax <span>$2</span></li> --}}
                        @if(isset($gtotal))
                            @if(session('coupon'))
                                <li><input class="del-cp" type="checkbox">&nbsp;Coupon Code <span>{{session('coupon')['coupon']}}</span></li>
                                @if(session('coupon')['coupon_type'] == 'percentage')
                                    <li>Gi???m gi?? <span>{{session('coupon')['coupon_amount']}}%</span></li>
                                @php
                                    $gTotal = 0;
                                    // luong giam gia
                                    $cAmount = ($gtotal * session('coupon')['coupon_amount'])/100;
                                    // so tien can thanh toan sau giam gia
                                    $gTotal = $gtotal - $cAmount;
                                @endphp
                                    <li>Th??nh ti???n <span class="gtotal">{{$gTotal}}$</span></li>
                                @elseif(session('coupon')['coupon_type'] == 'fixed')
                                    <li>Gi???m gi?? <span>{{session('coupon')['coupon_amount']}}$</span></li>
                                    @php
                                        $gTotal = $gtotal - session('coupon')['coupon_amount'];
                                    @endphp
                                    <li>Th??nh ti???n <span class="gtotal">{{$gTotal}}$</span></li>
                                @endif
                            @else
                                <li>Th??nh ti???n <span class="gtotal">{{$gtotal}}$</span></li>
                            @endif
                        @else
                            <li>Th??nh ti???n <span class="gtotal"></span></li>
                        @endif
					</ul>
					<a class="btn btn-default update" href="{{URL::asset('index')}}">Back</a>
					<a class="btn btn-default check_out" href="{{URL::asset('check-out')}}">Check Out</a>
				</div>
			</div>
		</div>
	</div>
</section><!--/#do_action-->
@endsection
