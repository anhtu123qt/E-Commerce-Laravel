@extends('frontend_layout')
<head>
	<script>
		if(screen.width <= 736){
			document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
		}
	</script>
	<script src="{{asset('frontend/js/jquery-1.9.1.min.js')}}"></script>
	<script>
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$(document).ready(function(){
			$('#selSale').change(function() {
				$sel_opt = $('#selSale').val();
				if ($sel_opt == 1 ) {
					$('#saleprice').show();
				}else {
					$('#saleprice').hide();
				}
			})
		});
	</script>
</head>
@section('menu-left_frontend_layout')
<div class="left-sidebar">
	<h2>ACCOUNT</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						ACCOUNT
					</a>
				</h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a href="{{route('product.index')}}">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						PRODUCTS
					</a>
				</h4>
			</div>
		</div>
	</div><!--/category-products-->				
</div>
@endsection
@section('frontend_content')
<div class="col-sm-9 padding-right">
	@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
		{{session('success')}}
	</div>
	@endif
	<h3 class="test1">Edit Product</h3>
	<form enctype="multipart/form-data" action="{{route('product.update',$getProduct->id)}}" method="POST">
		@csrf
		@method('PUT')
		<div class="mb-3">
			<label class="form-label ">Product</label>
			<input type="text" class="form-control" name="name" value="{{$getProduct->product_name}}">
		</div>
		<div class="mb-3">
			<label class="form-label ">Price</label>
			<input type="text" class="form-control" name="price" value="{{$getProduct->product_price}}" >
		</div>
		<div class="mb-3">
			<label class="form-label ">Category</label>
			<select name="selCate">
				@foreach($allCategory as $cate)
				<option
				<?php
				if(!empty($category->id) && $category->id == $cate['id'])
					echo "selected";
				?> value="{{$cate->id}}">{{$cate->category}}</option>
				@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label class="form-label ">Brand</label>
			<select name="selBra">
				@foreach($allBrand as $bra)
				<option <?php if (!empty($brand->id && $brand->id == $bra['id'])) echo "seleted";?> value="{{$bra->id}}">{{$bra->brand}}</option>
				@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label class="form-label ">Sale</label>
			<select id="selSale" name="selSale">
				<option>---Please Select Sale Status---</option>
				<option <?php if($getProduct->product_status == 0) echo "selected";?> value="0">New</option>
				<option <?php if($getProduct->product_status == 1) echo "selected";?> value="1">Sale</option>
			</select>
		</div>
		<div class="mb-3" id="saleprice">
			<label class="form-label ">Sale Price</label>
			<input  type="text" class="form-control" name="saleprice" value="{{$getProduct->product_sale_price}}" >
		</div><br>
		<label class="form-label ">Image Upload</label>
		<div class="input-group control-group increment" >
			<div class="input-group-btn"> 
				<input type="file" name="filename[]" class="form-control" multiple><br>
				@foreach(json_decode($getProduct->product_image) as $image)
				<img src="{{asset('/upload/product/'.$user_id.'/'.$image)}}" alt="" width="50px" height="50px">
				<input class="imageCheckDel" type="checkbox" value="{{$image}}" name="imageCheckDel[]">
				@endforeach
			</div>
		</div>
		{{-- <div class="clone hide">
			<div class="control-group input-group" style="margin-top:10px">
				<input type="file" name="filename[]" class="form-control">
				<div class="input-group-btn"> 
					<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
				</div>
			</div>
		</div> --}}

		<div class="mb-3">
			<label class="form-label ">Detail</label>
			<textarea class="form-control" name="detail" rows="7"></textarea>
		</div>

		<button type="submit" name="update" class="btn btn-primary">UPDATE PRODUCT</button>
	</form>					
</div>
@endsection



