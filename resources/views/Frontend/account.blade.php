@extends('frontend_layout')
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
            $('.select').on('change', function(){
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
                    url:'{{url('member/acounnt/address-ajax')}}',
                    method:'POST',
                    data:{attr:attr,code:code,_token:_token},
                    success:function(data){
                        $('#'+res).html(data);
                    }
                });
            });
        });
    </script>
</head>
@section('title')
    Account - E Shopper
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
    <form enctype="multipart/form-data" action="{{route('member.update',$getUserid)}}" method="POST">
        @csrf
        @method('POST')
		<div class="mb-3">
			<label class="form-label ">Name</label>
			<input type="text" class="form-control" name="name" value="{{$getInfo->name}}" aria-describedby="emailHelp" readonly>
		</div>
		<div class="mb-3">
			<label class="form-label ">Email</label>
			<input type="email" class="form-control" name="email" value="{{$getInfo->email}}"aria-describedby="emailHelp" readonly>
		</div>
		<div class="mb-3">
			<label for="exampleInputPassword1" class="form-label">Password</label>
			<input type="password" class="form-control" name="pass" value="{{$getInfo->password}}"  readonly>
		</div>
		<div class="mb-3">
			<label class="form-label ">Phone</label>
			<input type="text"  class="form-control" name="phone" value="{{$getInfo->phone}}"  aria-describedby="emailHelp">
		</div>
		<div class="mb-3">
			<label class="form-label ">Address</label>
			<input type="text"  class="form-control" name="address" value="{{$getInfo->address}}" id="exampleInputEmail1" aria-describedby="emailHelp">
		</div>
		<div class="input-group mb-3">
			<label class="input-group-text" >Avatar</label>
			<input type="file"  class="form-control" name="avatar"><br>
			<img src="{{asset('upload/defaultavatar.jpg')}}" width="120px" height ="100px">
		</div>
		<<button type="submit" name="update" class="btn btn-primary">UPDATE</button>
    </form>
</div>
@endsection



