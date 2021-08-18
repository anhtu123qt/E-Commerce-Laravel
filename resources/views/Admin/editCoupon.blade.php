@extends('admin_layout')
@section('admin_content')
    <div class="row">
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible">
                <h4><i class="icon fa fa-check"></i>Thông báo!</h4>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-12">
            <div class="card card-body">
                <h2 class="card-title">Edit Coupon Code</h2>
                <form class="form-horizontal m-t-30" action="{{route('coupon.update',$getCoupon->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label>Code <span class="help"></span></label>
                        <input autocomplete="off" type="text" class="form-control" name="code" value="{{$getCoupon->code}}">
                    </div>
                    <div class="form-group">
                        <label>Coupon Type</label>&nbsp;
                        <select name="coupon_type">
                            <option value="percentage">{{$getCoupon->coupon_type}}</option>
                            <option value="percentage">Percentage</option>
                            <option value="fixed">Fixed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Coupon Amount</label>
                        <input type="text" value="{{$getCoupon->coupon_amount}}" name="coupon_amount" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Desription</label>
                        <input autocomplete="off" value="{{$getCoupon->description}}" type="text" name="description" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Expiry Date</label>
                        <input  autocomplete="off" type="date" name="expiry" value="{{$getCoupon->expiry}}" class="form-control">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" name="add">Update Coupon Code</button>
                        <a href="{{route('coupon.index')}}"><button type="button" class="btn btn-success">Cancel</button></a>
                    </div>
                </form>

            </div>

        </div>
@endsection
