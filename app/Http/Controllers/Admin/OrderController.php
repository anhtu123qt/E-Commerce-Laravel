<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\OrderStatus;
use Illuminate\Http\Request;
use App\District;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Order;
use App\Coupon;
use App\Ward;
use App\City;
use App\FeeShip;
use App\OrderDetail;
use App\Product;

class OrderController extends Controller
{
    public function orderHistory(){
        $orders = Order::all();
        return view('admin.order_history',compact('orders'));
    }
    public function orderDetail($id){
        $order = Order::where('id',$id)->first();
        $order_products = OrderDetail::with('product')->where('order_id',$id)->get();
        $order_status = OrderStatus::all();
        return view('admin.order_detail',compact('order','order_products','order_status'));
    }
    public function update_orderStatus(Request $request){
        $data = $request->all();
        $order_status = Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
        return redirect()->back()->with('success','Update Order Status Successfully');

    }
}
