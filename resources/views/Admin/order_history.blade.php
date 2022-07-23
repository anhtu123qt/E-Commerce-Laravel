@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
	@if(session('success'))
	<div class="alert alert-success alert-dismissible">
		<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
		{{session('success')}}
	</div>
	@endif
	@if(session('delete'))
	<div class="alert alert-danger alert-dismissible">
		<h4><i class="icon fa fa-check"></i> Thông báo!</h4>
		{{session('delete')}}
	</div>
	@endif
        <div class="table-responsive-sm">
            <h3 class="text-center" >Lịch sử đơn hàng</h3>
            <table class="table table-success table-striped">
                <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Payment Method</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Total</th>
                    <th scope="col">Created at</th>
                    <th scope="col">View Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order )
                    <tr>
                        <td scope="row">{{$order->id}}</td>
                        <th scope="row">{{$order->payment_method}}</th>
                        <th scope="row">{{$order->order_status}}</th>
                        <th scope="row">{{$order->grand_total}}$</th>
                        <th scope="row">{{$order->created_at}}</th>
                        <th scope="row">
                            <a href="{{url('order-detail/'.$order->id)}}"><i class="mdi mdi-eye "></i></a>
                        </th>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
</div>
@endsection

































































