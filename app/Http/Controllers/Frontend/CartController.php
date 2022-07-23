<?php

namespace App\Http\Controllers\Frontend;

use App\District;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Order;
use Mail;
use App\Coupon;
use App\Ward;
use App\City;
use App\FeeShip;
use App\OrderDetail;
use Illuminate\Support\Facades\DB;

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
        session()->forget('coupon');
        session()->forget('feeship');
        echo 'Cart('.count(session('cart')).')';
    }
    public function checkout() {
        $city = City::orderBy('city_code','ASC')->get();
        return view('frontend.checkout',compact('city'));
    }
    public function sendmail(Request $request) {
        if(Auth::check()) {
            $user = Auth::user();
            $coupon = session('coupon');
            $feeship = session('feeship');
            $carts = session('cart');
            $data = $request->all();
            $total = $data['total_paypal'];
            if (isset($data['paypal_payment'])) {
                return view('frontend.paypal', compact('total', 'user', 'feeship', 'cart'));
            }
            if (isset($data['cod_payment'])) {
                $newOrder = new Order();
                $newOrder->user_id = $user['id'];
                $newOrder->shipping_charges = $feeship['fee'];
                $newOrder->shipping_city = $feeship['city'];
                $newOrder->shipping_district = $feeship['district'] ;
                $newOrder->shipping_ward = $feeship['ward'] ;
                $newOrder->shipping_address_detail = $user['address'] ;
                $newOrder->phone = $user['phone'] ;
                $newOrder->coupon_code = $coupon['coupon'];
                $newOrder->coupon_type = $coupon['coupon_type'];
                $newOrder->coupon_amount = $coupon['coupon_amount'];
                $newOrder->order_status = 'New';
                $newOrder->payment_method = 'COD';
                $newOrder->grand_total = $total;
                $newOrder->save();

                 $orderId= DB::getPdo()->lastInsertId();
                foreach($carts as $cart){
                    $orderDetail = new OrderDetail();
                    $orderDetail->order_id = $orderId;
                    $orderDetail->product_id = $cart['product_id'];
                    $orderDetail->product_name = $cart['product_name'];
                    $orderDetail->product_qty = $cart['product_qty'];
                    $orderDetail->product_price = $cart['product_price'];
                    $orderDetail->save();
                }
                $to_name = 'E-Shopper';
                $to_email = $user->email;
                $payment = 'COD';

                Mail::send('frontend.send_mail',['coupon'=> $coupon,'feeship'=>$feeship,'user'=>$user,'total'=>$total,'orderId'=>$orderId,'payment'=>$payment], function ($message) use ($to_name, $to_email) {
                    $message->to($to_email)->subject('Thông báo đơn hàng của quý khách đã được tiếp nhận!');
                    $message->from($to_email, $to_name);
                });
                session()->forget('cart');
                session()->forget('coupon');
                session()->forget('feeship');
                return redirect()->back()->with('success', 'Đơn hàng của bạn đã được tiếp nhận!');
            }
        }
    }
    public function paypal(Request $request){
        $data= $request->all();
        dd($data);
    }
    public function thanks(){
        return view('frontend.thank');
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
    public function delete_cp(Request $request){
        $data = $request->all();
        if($data['delete_cp']){
            session()->forget('coupon');
        }
    }
    public function address_ajax(Request $request)
    {
        $data = $request->all();
        $output = '';
        if ($data['attr']) {
            if ($data['attr'] == 'city') {
                $getDistrict = District::where('city_code', $data['code'])->get();
                $output .= '<option>Select District</option>';
                foreach ($getDistrict as $district) {
                    $output .= '<option value="' . $district->district_id . '">' . $district->district_name . '</option>';
                }
            }else {
                $getWard = Ward::where('district_id', $data['code'])->get();
                $output .= '<option>Select Ward</option>';
                foreach ($getWard as $ward) {
                    $output .= '<option value="'.$ward->ward_id.'">'.$ward->ward_name.'</option>';
                }
            }
        }
        echo $output;
    }
    public function calc_feeship_ajax(Request $request){
        $data = $request->all();
        $feeship = FeeShip::where('city_id',$data['city_id'])->where('district_id',$data['district_id'])->where('ward_id',$data['ward_id'])->first();
        $fee=$feeship->feeship;
        if($feeship){
            session()->get('feeship');
            $is_avai = 1;
            if (session('feeship')) {
                if($is_avai == 1) {
                    $feeInfo = array(
                        'fee' => $fee,
                        'city' => $feeship->city->city_name,
                        'district' => $feeship->district->district_name,
                        'ward' => $feeship->ward->ward_name
                    );
                    session()->put('feeship',$feeInfo);
                }
            }else {
                $feeInfo = array(
                    'fee' => $fee,
                    'city' => $feeship->city->city_name,
                    'district' => $feeship->district->district_name,
                    'ward' => $feeship->ward->ward_name
                );
                session()->put('feeship',$feeInfo);
            }
            session()->save();
        }
        $output = $fee.'$';
        echo $output;
    }
    public function delete_feeship(Request $request){
        $data = $request->all();
        if($data['delete_feeship']){
            session()->forget('feeship');
        }
    }
}
