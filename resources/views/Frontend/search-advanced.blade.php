@extends('frontend_layout')
@section('title')
Search Advanced | E-Shopper
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
	@if($errors->any())
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	</div>
	@endif
	<div class="container">
		<h2 style="color:#fe980f;"class="text-center">Search Advanced</h2>
		<div class="row">
			<form action="{{route('search_adv')}}" method="POST">
				@csrf
				@method('POST')
				<div class="col-sm-2">
					<input type="text" name="name" class="form-control" placeholder="Tên sản phẩm">
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="price">
						<option value="">Select Price</option>
						<option value="0">0-500$</option>
						<option value="1">500-1000$</option>
						<option value="2">1000-1500$</option>
						<option value="3">Trên 1500$</option>
					</select>
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="cate">
						<option value="" >Select Category</option>
						@foreach($category as $value)
						<option value="{{$value->id}}">{{$value->category}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="brand">
						<option value="">Select Brand</option>
						@foreach($brand as $value)
						<option value="{{$value->id}}">{{$value->brand}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-sm-2">
					<select class="form-control" name="status">
						<option value="" >Select Status</option>
						<option value="0">New</option>
						<option value="1">Sale</option>
					</select>
				</div>
				<div class="col-sm-2">
					<button type="submit" class="form-control btn btn-success">Search</button>
				</div>
			</form>
			<div class="features_items"><!--features_items-->
				{{-- @foreach($product as $value) --}}
				{{-- <div class="product-image-wrapper">
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
				</div> --}}
			</div>
		</div>
		{{-- @endforeach --}}
	</div>
</div>
</section> <!--/#cart_items-->
@endsection