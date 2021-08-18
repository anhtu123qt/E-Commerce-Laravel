<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation;
use App\Coupon;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $getCoupon = Coupon::paginate(5);
        return view('admin.coupon',compact('getCoupon'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addCoupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required|unique:coupons|max:15',
            'coupon_type'=>'required',
            'coupon_amount'=>'required',
            'description'=>'required',
            'expiry'=>'required'
        ]);
        Coupon::create($request->all());
        return redirect()->route('coupon.index')->with('success','Add Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $getCoupon = Coupon::findOrFail($id);
        return view('admin.editCoupon',compact('getCoupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code'=>'required|unique:coupons|max:15',
            'coupon_type'=>'required',
            'coupon_amount'=>'required',
            'description'=>'required',
            'expiry'=>'required'
        ]);
        $getCoupon = Coupon::findOrFail($id);
        $getCoupon->update($request->all());
        $getCoupon->save();
        return redirect()->route('coupon.index')->with('success','Update coupon code successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $getCoupon = Coupon::findOrFail($id)->delete();
        return redirect()->route('coupon.index')->with('success','Delete coupon code successfully!');
    }
}
