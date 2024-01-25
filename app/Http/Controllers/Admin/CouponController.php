<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CouponModel;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = 'Danh sách Coupon';
        $coupon = CouponModel::paginate(10);
        return view('admin.coupon.ListCoupon',compact('coupon','title'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = 'Thêm coupon';
        return view('admin.coupon.AddCoupon',compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        CouponModel::create([
            'coupon_name'=>$request->coupon_name,
            'coupon_code'=>$request->coupon_code,
            'coupon_quantity'=>$request->coupon_quantity,
            'coupon_discount'=>$request->coupon_discount,
        ]);
        return back()->with('msg','Thêm thành công');
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
        //
        $title = 'Cập nhật sản phẩm';
        $coupon = CouponModel::find($id);
        return view('admin.coupon.UpdateCoupon',compact('title','coupon'));
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
        //
        $coupon = CouponModel::find($id);
        $coupon->coupon_name=$request->coupon_name;
        $coupon->coupon_code=$request->coupon_code;
        $coupon->coupon_quantity=$request->coupon_quantity;
        $coupon->coupon_discount=$request->coupon_discount;
        $coupon->save();
        return back()->with('msg','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $coupon = CouponModel::find($id)->delete();
        return redirect()->back()->with('msg','Xóa thành công');
    }
}
