<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>
	<link href="{{asset('/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/css/price-range.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('/frontend/css/sweetalert.css')}}" rel="stylesheet">
<link rel="shortcut icon" href="images/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
<link rel="apple-touch-icon-precomposed" href="{{asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->


<body>
	@include('header_frontend_layout')
	<section id="slider"><!--slider-->
		@yield('slider_frontend_content')
	</section><!--/slider-->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@yield('menu-left_frontend_layout')
				</div>
				@yield('frontend_content')
			</div>
		</div>
	</section>

	@include('footer_frontend_layout')


	<script src="{{asset('frontend/js/sweetalert.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.js')}}"></script>
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('frontend/js/price-range.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
	<script src="{{asset('frontend/js/main.js')}}"></script>
    <script>
        if(screen.width <= 736){
            document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
        }
    </script>
    <link type="text/css" rel="stylesheet" href="{{asset('frontend/css/rate.css')}}">
    <script src="{{asset('frontend/js/jquery-1.9.1.min.js')}}"></script>
</body>
</html>
