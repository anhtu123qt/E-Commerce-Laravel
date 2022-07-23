<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
<body>
<div class="container">
    <h2 class="text-center">Đơn hàng {{$orderId}}</h2>
    <div class="col-md-6">
        <p>Chào {{ $user->name }},</p>
    </div>
    <div class="col-md-12">
        <h4>THÔNG TIN ĐƠN HÀNG</h4>
        <p>Mã đơn hàng: {{$orderId}} </p>
        <p>Mã khuyến mãi: {{$coupon['coupon']}}</p>
        <p>Phí vận chuyển: {{$feeship['fee']}}</p>
        <p>Phương thức thanh toán: {{$payment}}</p>
        <p>Thành tiền: {{$total}}$</p>
    </div>
    <div class="col-md-12">
        <h3>THANKS</h3>
    </div>
</div>

</body>

</html>
