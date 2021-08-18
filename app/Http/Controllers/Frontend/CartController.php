<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\History;
use Mail;
use App\Coupon;

class CartController extends Controller
{
    public function showCart() {
        return view('frontend.cart');
    }
    public function addToCart(Request $request) {
        $data = $request->all();
        $is_avaiable = 1;
        $cart = session()->get('cart');
        // session()->forget('cart');
        // dd(session('cart'));exit;
        if (isset($cart[$data['pid']])) {
            $cart[$data['pid']]['product_qty'] +=1;
        }
        else {
            $cart[$data['pid']] = array(
                'product_id' => $data['pid'],
                'product_name' => $data['pname'],
                'product_qty' => 1,
                'product_price' => $data['pprice'],
                'product_image' => $data['pimage']
            );
        }
        session()->put('cart',$cart);
        echo 'Cart('.count(session('cart')).')';
    }
    public function updateCartQtyUp(Request $request){
        $data = $request->all();
        $cart = session()->get('cart');
        if(isset($cart[$data['id']])){
            $cart[$data['id']]['product_qty']+=1;
            session()->put('cart',$cart);
        }
    }
    public function updateCartQtyDown(Request $request){
        $data = $request->all();
        $cart = session()->get('cart');
        if(isset($cart[$data['id']])){
            $cart[$data['id']]['product_qty']-=1;
            session()->put('cart',$cart);
            if($cart[$data['id']]['product_qty'] == 0) {
                unset($cart[$data['id']]);
            }
            session()->put('cart',$cart);
            // dd($cart);
        }
        echo 'Cart('.count(session('cart')).')';

    }
    public function deleteProduct(Request $request) {
        $data = $request->all();
        $cart = session()->get('cart');
        if($data['pid']){
            unset($cart[$data['pid']]);
        }
        session()->put('cart',$cart);
        echo 'Cart('.count(session('cart')).')';
    }
    public function checkout() {
        return view('frontend.checkout');
    }
    public function sendmail(Request $request) {
        if(Auth::check()) {
            $gtotal =$request->input('total');
            $order = rand();
            $user_id = Auth::id();
            $user_info= User::findOrFail($user_id);
            $cart = session('cart');
            $to_name = 'E-Shopper';
            $to_email = $user_info->email;
            // dd($gtotal);exit;
            $data = array(
                'name' => 'Trong cuộc sống có rất nhiều sự lựa chọn cám ơn ' .$user_info->name. ' đã lựa chọn E-Shopper. E-Shopper rất vui thông báo đơn hàng #'.$order.' của quý khách đã được tiếp nhận và đang trong quá trình xử lý. E-Shopper sẽ gửi email thông báo đến quý khách khi đơn hàng được đóng gói và chuyển sang đơn vị vận chuyển.',
                'order' => $order,
                'gtotal'=>$gtotal,
                'address' =>$user_info->address,
                'phone'=>$user_info->phone
            );

            Mail::send('frontend.send_mail',$data,function($message) use($to_name,$to_email){
                $message->to($to_email)->subject('Thông báo đơn hàng của quý khách đã được tiếp nhận!');
                $message->from($to_email,$to_name);
            });
            $newOrder = new History();
            $newOrder->email = $user_info['email'];
            $newOrder->phone = $user_info['phone'];
            $newOrder->name = $user_info['name'];
            $newOrder->user_id = $user_id;
            $newOrder->total = $gtotal;
            $newOrder->save();
            return redirect()->back()->with('success','Đơn hàng của bạn đã được tiếp nhận!');
        }
    }
    public function orderHistory(){
        $orders = History::all();
        return view('admin.order_history',compact('orders',$orders));
    }
    public function checkCoupon(Request $request) {
        $data = $request->all();
        $coupon = Coupon::where('code',$data['coupon_code'])->first();
        if ($coupon) {
            $couponSession = session()->get('coupon');
            if ($couponSession) {
                $is_avai = 1;
                if ($is_avai == 1) {
                    $couponInfo = array(
                        'coupon' => $coupon->code,
                        'coupon_type' => $coupon->coupon_type,
                        'coupon_amount' => $coupon->coupon_amount
                    );
                    session()->put('coupon',$couponInfo);
                }
            }else {
                $couponInfo = array(
                    'coupon' => $coupon->code,
                    'coupon_type' => $coupon->coupon_type,
                    'coupon_amount' => $coupon->coupon_amount
                );
                session()->put('coupon',$couponInfo);
            }
            session()->save();
            return redirect()->back()->with('success','Thêm mã giảm giá thành công!');
        }else {
            return redirect()->back()->with('error','Không tồn tại mã giảm giá');
        }
    }
}
