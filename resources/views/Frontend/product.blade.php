@extends('frontend_layout')
@section('title')
    Product - E Shopper
@endsection
@section('menu-left_frontend_layout')
<div class="left-sidebar">
	<h2>ACCOUNT</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a href="{{route('member.account')}}">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						ACCOUNT
					</a>
				</h4>
			</div>
		</div>
        @hasAnyRole(['admin','author'])
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
        @endhasAnyRole
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
	@if(session('delete'))
	<div class="alert alert-danger alert-dismissible">
		<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
		{{session('delete')}}
	</div>
	@endif
	<section id="cart_items">
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr role="row" class="cart_menu">
						<td class="image">ID</td>
						<td class="image">Product</td>
						<td class="image">Image</td>
						<td class="price">Price</td>
						<td class="price">Sale Price</td>
						<td class="total">Action</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach($getProduct as $product)
					<tr role="row">
						<td class="cart_id">{{$product->id}}</td>
						<td class="cart_item">
							<h4><a href="">{{$product->product_name}}</a></h4>
						</td>
						<td class="cart_product">
							@foreach(json_decode($product->product_image) as $image)
							<a href=""><img src="./upload/product/{{$product->user_id}}/{{$image}}" width=60px height=50px ></a>
							@endforeach
						</td>
						<td class="cart_price">
							<p>{{$product->product_price}}</p>
						</td>
						<td class="cart_price">
							<p>{{$product->product_sale_price}}</p>
						</td>
						<td>
							<a href="{{route('product.edit',$product->id)}}"><i class="fa fa-edit" ></i></a><br><br>
							<form action="{{route('product.destroy',$product->id)}}" method="POST">
								@csrf
								@method('DELETE')
								<button><a><i class="fa fa-times"></i></a></button>
							</form>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<a href="{{route('product.create')}}"><button style="float:right;" class="btn btn-primary" type="submit" name="add-product">ADD PRODUCT</button></a>
		</div>
	</div>

</section> <!--/#cart_items-->
</div>
@endsection



