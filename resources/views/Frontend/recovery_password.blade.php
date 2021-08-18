<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Recovery Password - E Shopper</title>
    <link href="{{asset('/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->
<body>
<div class="container">
    <div class="row">
        <div class="col-2">
            <div class="logo pull-left">
                <a href="{{URL::asset('index')}}"><img src="{{asset('frontend/images/home/logo.png')}}" alt="" /></a>
            </div>
        </div>
        <div style="margin: 13px" class="col-sm-3"><span style="font-size:20px">ĐẶT LẠI MẬT KHẨU</span></div>
    </div>
    <hr>
    <div class="col-md-4 col-md-offset-4">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="text-center">
                    <div class="panel-body">
                        <form action="{{route('update_password')}}" id="register-form" class="form" method="GET">
                            <?php
                            $email = $_GET['email'];
                            ?>
                            @csrf
                            <div class="form-group">
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-send color-blue"></i></span>
                                    <input id="email" name="pass" placeholder="Nhập mật khẩu mới" class="form-control"  type="password">
                                </div>
                                <br>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-send color-blue"></i></span>
                                    <input id="email" name="confirm_pass" placeholder="Nhập lại mật khẩu" class="form-control"  type="password">
                                </div>
                                <br>
                                @if(session('error'))
                                    <div class="alert alert-danger">{{session('error')}}</div>
                                @endif
                                @if(session('success'))
                                    <div class="alert alert-success">{{session('success')}}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="email" value="{{$email}}">
                                <button type="submit" class="btn btn-success btn-block" >Reset Password
                                @if(session('success'))
                                <br>
                               <button class="btn btn-success btn-block"><a  style="text-decoration: none"href="{{route('member')}}">Back To Login</a></button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
