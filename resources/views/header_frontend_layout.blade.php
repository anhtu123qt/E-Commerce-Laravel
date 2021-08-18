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
			$('#search_ajax').keyup(function() {
				var keywords = $(this).val();
				var _token = $('meta[name="csrf-token"]').attr('content');
				if (keywords !== '') {
					$.ajax({
						url:"{{url('search-ajax')}}",
						type:"POST",
						data:{keywords:keywords,_token:_token},
						success:function(data){
							$('#keywords').fadeIn();
							$('#keywords').html(data);
						}
					});
				}else {
					$('#keywords').fadeOut();
				}

			});
			$(document).on('click','.li_search',function(){
				var key = $(this).text();
				// alert(key);
				$('#search_ajax').val(key);
				$('#keywords').fadeOut();
			});
		});
	</script>
</head>
<header id="header"><!--header-->
	<div class="header_top"><!--header_top-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<div class="contactinfo">
						<ul class="nav nav-pills">
							<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
							<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="social-icons pull-right">
						<ul class="nav navbar-nav">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header_top-->

	<div class="header-middle"><!--header-middle-->
		<div class="container">
			<div class="row">
				<div class="col-md-4 clearfix">
					<div class="logo pull-left">
						<a href="{{URL::asset('index')}}"><img src="{{asset('frontend/images/home/logo.png')}}" alt="" /></a>
					</div>
					<div class="btn-group pull-right clearfix">
						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								USA
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="">Canada</a></li>
								<li><a href="">UK</a></li>
							</ul>
						</div>

						<div class="btn-group">
							<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
								DOLLAR
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="">Canadian Dollar</a></li>
								<li><a href="">Pound</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-8 clearfix">
					<div class="shop-menu clearfix pull-right">
						<ul class="nav navbar-nav">
							@auth
							<li><a href="{{URL::asset('member/account')}}"><i class="fa fa-user"></i> Account</a></li>
							@endauth
                            <li><a href="{{URL::asset('login')}}"> Kênh người bán</a></li>
							<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
							<li><a href="{{URL::asset('check-out')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
							@if(session('cart'))
							<li><a id="cart" href="{{URL::asset('show-cart')}}"><i  class="fa fa-shopping-cart"></i> Cart(<?php echo count(session('cart'));?>)</a></li>
							@else
							<li><a id="cart" href="{{URL::asset('show-cart')}}"><i class="fa fa-shopping-cart"></i> Cart(0)</a></li>
							@endif
							@if(Route::has('member.login'))
							<li>
								@auth
								<a href="{{ route('logout') }}"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								<i class="fas fa-user-cog"></i>Logout({{Auth::user()->name}})
							</a>

							<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
								@csrf
							</form>
						</li>
						@else
						<li><a href="{{URL::asset('member')}}"><i class="fa fa-lock"></i> Login</a></li>
						@endauth
						@endif

					</ul>
				</div>
			</div>
		</div>
	</div>
</div><!--/header-middle-->

<div class="header-bottom"><!--header-bottom-->
	<div class="container">
		<div class="row">
			<div class="col-sm-9">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="mainmenu pull-left">
					<ul class="nav navbar-nav collapse navbar-collapse">
						<li><a href="index.html" class="">Home</a></li>
						<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
							<ul role="menu" class="sub-menu">
								<li><a href="shop.html">Products</a></li>
								<li><a href="product-details.html">Product Details</a></li>
								<li><a href="checkout.html">Checkout</a></li>
								<li><a href="cart.html">Cart</a></li>
								<li><a href="login.html">Login</a></li>
							</ul>
						</li>
						<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
							<ul role="menu" class="sub-menu">
								<li><a href="{{URL::asset('blog/list')}}">Blog List</a></li>
								<li><a href="{{URL::asset('blog/single')}}">Blog Single</a></li>
							</ul>
						</li>
						{{-- <li><a href="404.html">404</a></li>
						<li><a href="contact-us.html">Contact</a></li> --}}
						<li><a href="{{URL::asset('search-advanced')}}">Search advanced</a></li>
					</ul>
				</div>
			</div>
			<div class="col-3">
				<div class="search_box">
					<form action="{{route('search')}}">
						<input type="text" id="search_ajax" name="search" placeholder="Search"/>
						<div id="keywords"></div>
						<button class="pull-right btn btn-success" type="submit">Search</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div><!--/header-bottom-->
</header><!--/header-->
