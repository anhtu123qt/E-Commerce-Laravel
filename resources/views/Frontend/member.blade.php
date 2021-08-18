@extends('frontend_layout')
@section('title')
    Login - E Shopper
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
<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<h2>Login to your account</h2>
					@if(session('error'))
					<div class="alert alert-danger alert-dismissible">
						<h4><i class="icon fa fa-check"></i>Thông báo!</h4>
						{{session('error')}}
					</div>
					@endif
					<form action="{{route('member.login')}}" method="POST">
						@csrf
						@method('POST')
						<input type="text" name="namelogin" placeholder="Name" />
						@error('namelogin')
						<p class="text-warning">{{$message}}</p>
						@enderror
						<input type="password" name="passwordlogin" placeholder="Password" />
						@error('emaillogin')
						<p class="text-warning">{{$message}}</p>
						@enderror
						<span>
							<input type="checkbox" name="remember_me" class="checkbox">
							Keep me signed in
						</span>
                        <span style="float:right"><a href="{{route('forgot_password')}}">Forgot Password?</a></span>
                        <button type="submit" class="btn btn-default btn-block">Login</button>
                        <hr>
                        <div class="d-grid mb-2">
                            <a href="{{route('login.facebook')}}" style="color: white !important; background-color: #3b5998;" class="btn btn-block" type="submit">
                                <i class="fab fa-google me-2"></i> Sign in with Facebook
                            </a>
                            <a href="{{route('login.google')}}" style="color: white !important; background-color: #ea4335;" class="btn btn-block" type="submit">
                                <i class="fab fa-google me-2"></i> Sign in with Google
                            </a>
                        </div>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-4">
                @if(session('errorReg'))
                    <div class="alert alert-danger alert-dismissible">
                        <h4><i class="icon fa fa-check"></i>Thông báo!</h4>
                        {{session('errorReg')}}
                    </div>
                @endif
				<div class="signup-form"><!--sign up form-->
					<h2>New User Signup!</h2>
					@if(session('success'))
					<div class="alert alert-success alert-dismissible">
						<h4><i class="icon fa fa-check"></i>Thông báo!</h4>
						{{session('success')}}
					</div>
					@endif
					<form action="{{route('member.register')}}" method="POST">
						@csrf
						@method('POST')
						<input type="text" name="name" placeholder="Name"/>
						@error('name')
						<p class="text-warning">{{$message}}</p>
						@enderror
						<input type="email" name="email" placeholder="Email Address"/>
						@error('email')
						<p class="text-warning">{{$message}}</p>
						@enderror
						<input type="password" name="password" placeholder="Password"/>
						@error('password')
						<p class="text-warning">{{$message}}</p>
						@enderror
						<button type="submit" class="btn btn-default">Signup</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->
@endsection
