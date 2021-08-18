<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        Chào {{ $name }}, bạn vừa có 1 yêu cầu đặt lại mật khẩu từ E Shopper.
        Click vào {{ $link }} để đặt lại mật khẩu mới.
        Thân,
    </div>
</div>

</body>
