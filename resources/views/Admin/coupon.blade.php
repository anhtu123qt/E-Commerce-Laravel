@extends('admin_layout')
@section('admin_content')
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif
        @if(session('danger'))
            <div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('danger')}}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Coupon Managerment</h3>
                        <a class="btn btn-success" href="{{route('coupon.create')}}">Add Coupon</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-dark table-sm">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Code</th>
                                <th scope="col">Coupon Type</th>
                                <th scope="col">Coupon Amount</th>
                                <th scope="col">Description</th>
                                <th scope="col">Expiry Date</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($getCoupon as $value)
                                <form action="{{route('coupon.destroy',$value->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->code}}</td>
                                        <td>{{$value->coupon_type}}</td>
                                        <td>{{$value->coupon_amount}}</td>
                                        <td>{{$value->description}}</td>
                                        <td>{{$value->expiry}}</td>
                                        <td>
                                            <a class="btn btn-success btn-sm" href="{{route('coupon.edit',$value->id)}}">Sửa</a>
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <nav>{{$getCoupon->links()}}</nav>
                </div>
            </div>
        </div>
    </div>
@endsection


































































