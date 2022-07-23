@extends('admin_layout')
@section('admin_content')
    <div class="container-fluid">
        @if(session('delete'))
            <div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('delete')}}
            </div>
        @endif
            @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                    {{session('success')}}
                </div>
            @endif
            <div style="width:22%" class="table-responsive-sm">
                <h3>Update Status Order</h3>
                    <table class="table table-success table-striped ">
                        <tbody>
                        <tr>
                            <td colspan="4">
                                <form action="{{route('update.order_status')}}" method="POST">
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    @csrf
                                    <select name="order_status">
                                        <option value="">Select Status</option>
                                        @foreach($order_status as $order_stt)
                                            <option value="{{$order_stt->name}}"@if(isset($order->order_status) && $order->order_status == $order_stt->name) selected @endif>{{$order_stt->name}}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
            </div>
        <div class="table-responsive-sm">
            <h3 class="text-center" >Thông tin vận chuyển</h3>
            <table class="table table-success table-striped">
                <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Shipping Address</th>
                    <th scope="col">Shipping Cost</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Payment Method</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $address = $order->shipping_address_detail.', '.$order->shipping_ward.', '.$order->shipping_district.', '.$order->shipping_city;
                @endphp
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$address}}</td>
                        <td>{{$order->shipping_charges}}$</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->payment_method}}</td>
                    </tr>
                </tbody>
            </table>
            <h3 class="text-center" >Thông tin chi tiết đơn hàng</h3>
            <table class="table table-success table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Quantity</th>
                    <th>Product Price</th>
                    <th>Total</th scope="col">
                </tr>
                </thead>
                <tbody>
                @php
                    $i = 0;
                    $total = 0;
                @endphp
                @foreach($order_products as $order_product)
                    @php
                        $i++;
                        $subtotal = $order_product->product_qty*$order_product->product_price;
                        $total += $subtotal;
                    @endphp
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$order_product->product_name}}</td>
                    <td>{{$order_product->product_qty}}</td>
                    <td>{{$order_product->product_price}}$</td>
                    <td>{{$subtotal}}$</td>
                </tr>
                @endforeach
                <th>
                    Coupon code: {{ $order->coupon_code }}
                @if($order->coupon_type == 'fixed')
                <th>
                    Coupon Amount: {{$order->coupon_amount}}$
                </th>
                <th>
                    Total: {{$total - $order->coupon_amount }}$
                </th>
                @else
                <th>
                    Coupon Amount: {{$total * $order->coupon_amount/100 }}$
                </th>
                <th>
                    Total: {{$total - $total * $order->coupon_amount/100 }}$
                </th>
                @endif


                </tbody>

            </table>
        </div>
    </div>
@endsection

































































