@extends('frontend_layout')
@section('title')
    Thank you | E-Shopper
@endsection
@section('frontend_content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb" style="margin-bottom:-6px">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Check out</a></li>
                    <li class="active">Thanks</li>
                </ol>
            </div><!--/breadcrums-->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                    {{session('success')}}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                    {{session('error')}}
                </div>
            @endif
            <div class="row" style="height:100%">
                <hr class="soft"/>
                <div align="center">
                    <h3>
                        YOUR ORDER HAS BEEN PAID SUCCESSFULLY!
                    </h3>
                </div>
            </div>
        </div>
    </section> <!--/#cart_items-->
@endsection


