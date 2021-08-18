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
	
	<h3 class="test1">Add Product</h3>
	<form enctype="multipart/form-data" action="{{route('product.store')}}" method="POST">
		@csrf
		@method('POST')
		<div class="mb-3">
			<label class="form-label ">Product</label>
			<input type="text" class="form-control" name="name" value="">
		</div>
		<div class="mb-3">
			<label class="form-label ">Price</label>
			<input type="text" class="form-control" name="price" value="" >
		</div>
		<div class="mb-3">
			<label class="form-label ">Category</label>
			<select name="selCate">
				<option>---Please Select Category---</option>
				@foreach($category as $cate)
				<option value="{{$cate->id}}">{{$cate->category}}</option>
				@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label class="form-label ">Brand</label>
			<select name="selBra">
				<option>---Please Select Brand---</option>
				@foreach($brand as $bra)
				<option value="{{$bra->id}}">{{$bra->brand}}</option>
				@endforeach
			</select>
		</div>
		<div class="mb-3">
			<label class="form-label ">Sale</label>
			<select id="selSale" name="selSale">
				<option>---Please Select Sale Status---</option>
				<option value="0">New</option>
				<option value="1">Sale</option>
			</select>
		</div>
		<div class="mb-3" id="saleprice">
			<label class="form-label ">Sale Price</label>
			<input  type="text" class="form-control" name="saleprice" value="" >
		</div>
		<div class="input-group control-group increment" >
			<input type="file" name="filename[]" class="form-control" multiple>
			<div class="input-group-btn"> 
				<button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
			</div>
		</div>
		<div class="clone hide">
			<div class="control-group input-group" style="margin-top:10px">
				<input type="file" name="filename[]" class="form-control">
				<div class="input-group-btn"> 
					<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
				</div>
			</div>
		</div>

		<div class="mb-3">
			<label class="form-label ">Detail</label>
			<textarea class="form-control" name="detail" rows="7"></textarea>
		</div>

		<button type="submit" name="add" class="btn btn-primary">ADD PRODUCT</button>
	</form>					
</div>
@endsection



