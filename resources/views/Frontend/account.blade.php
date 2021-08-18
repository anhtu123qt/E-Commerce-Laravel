@extends('frontend_layout')

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
	<form enctype="multipart/form-data" action="{{route('member.update')}}" method="POST">
		@csrf
		@method('POST')
		<div class="mb-3">
			<label class="form-label ">Name</label>
			<input type="text" class="form-control" name="name" value="{{$getInfo->name}}" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
		</div>
		<div class="mb-3">
			<label class="form-label ">Email</label>
			<input type="email" class="form-control" name="email" value="{{$getInfo->email}}" id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
		</div>
		<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Password</label>
			<input type="password" class="form-control" name="pass" value="{{$getInfo->password}}" id="exampleInputPassword1" readonly>
		</div>
		<div class="mb-3">
			<label class="form-label ">Phone</label>
			<input type="text" class="form-control" name="phone" value="{{$getInfo->phone}}" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>
		<div class="mb-3">
			<label class="form-label ">Address</label>
			<input type="text" class="form-control" name="address" value="{{$getInfo->address}}" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>
		<div class="input-group mb-3">
			<label class="input-group-text" >Avatar</label>
			<input type="file" class="form-control" name="avatar"><br>
			<img src="{{asset('upload/account/'.$getInfo->avatar)}}" width="120px" height ="100px">
		</div>

		<button type="submit" name="update" class="btn btn-primary">UPDATE</button>
	</form>					
</div>
@endsection



