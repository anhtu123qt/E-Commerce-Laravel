@extends('frontend_layout')
@section('title')
Search | E-Shopper
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
	</script>
</head>
@section('frontend_content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="#">Home</a></li>
				<li class="active">Search</li>
			</ol>
		</div><!--/breadcrums-->
		{{-- <h4 style="padding:1px;color:#696763">Bạn đang tìm kiếm với từ khóa: {{$data['search']}} </h4> --}}
		@if(session('error'))
			<div class="alert alert-danger alert-dismissible">
				<h4><i class="icon fa fa-check"></i>Thông báo!</h4>
					{{session('error')}}
			</div>
		@endif
		<div class="features_items"><!--features_items-->
			@foreach($product as $value)
			<div class="col-sm-4">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<?php
							$image = json_decode($value->product_image);
						?>
						<img src="./upload/product/<?php echo $user_id;?>/<?php echo $image[0];?>" alt="" />
						<h2>{{$value->product_price}}$</h2>
						<p>{{$value->product_name}}</p>
						<a href="{{route('detail',$value->id)}}" class="btn btn-default add-to-cart">Chi tiết sản phẩm</a>
					</div>
				</div>
			</div>
			

		</div>
		@endforeach
	</div>
</section> <!--/#cart_items-->
@endsection