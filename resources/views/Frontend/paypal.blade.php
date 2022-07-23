@extends('frontend_layout')
@section('title')
Checkout | E-Shopper
@endsection
@section('frontend_content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb" style="margin-bottom:-6px">
                <li><a href="#">Home</a></li>
                <li><a href="#">Check out</a></li>
                <li class="active">Paypal</li>
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
                    YOUR ORDER HAS BEEN PLACED SUCCESSFULLY
                </h3>
                <input type="hidden" class="name" value="{{$user->name}}">
                <input type="hidden" class="email" value="{{$user->email}}">
                <input type="hidden" class="phone" value="{{$user->phone}}">
                <input type="hidden" class="address" value="{{$user->address}}">
                <input type="hidden" class="city" value="{{$feeship['city']}}">
                <input type="hidden" class="district" value="{{$feeship['district']}}">
                <input type="hidden" class="ward" value="{{$feeship['ward']}}">
                <input type="hidden" class="feeship" value="{{$feeship['fee']}}">
                @foreach($cart as $val)
                    <input type="hidden" class="product_name" value="{{$val['product_name']}}">
                    <input type="hidden" class="product_qty" value="{{$val['product_qty']}}">
                    <input type="hidden" class="product_price" value="{{$val['product_price']}}">
                @endforeach
                <input type="hidden" class="total" value="{{$total}}">
                <p>Please make payment by clicking on below Paypal button</p>
                    <div id="paypal-button-container" style="width:50%"></div>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection
<script
    src="https://www.paypal.com/sdk/js?client-id=AQGdXdYntOQ1XnVOo8siG2a_o9MNGTHFQaMfIL8omYdKKt2Ib6g3xuKRbzyPoYiZUIUaotFhcgQDLy1u"> // Required. Replace YOUR_CLIENT_ID with your sandbox client ID.
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // This function sets up the details of the transaction, including the amount and line item details.
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '{{$total}}'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // This function captures the funds from the transaction.
            return actions.order.capture().then(function(details) {
                // This function shows a transaction success message to your buyer.
                alert('Thanh toan thanh cong boi ' + details.payer.name.given_name);
                var name = $('.name').val();
                var email = $('.email').val();
                var phone = $('.phone').val();
                var address = $('.address').val();
                var city = $('.city').val();
                var district = $('.district').val();
                var ward = $('.ward').val();
                var feeship = $('.feeship').val();
                var product_name = $('.product_name').val();
                var product_price = $('.product_price').val();
                var product_qty = $('.product_qty').val();
                var total = $('.total').val();
                var _token = $('meta[name="csrf-token"]').attr('content');
                // console.log(_token);
                $.ajax({
                    url:'{{url('paypal')}}',
                    method:'GET',
                    data:{name:name,_token:_token},
                    success: function() {
                        window.location.href="http://tuanhlaravel.com/laravel/shopbanhanglaravel/public/paypal";
                    }
                })
            });
        }
    }).render('#paypal-button-container');
</script>

