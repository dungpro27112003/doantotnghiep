<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PriceDiscountModel;
use App\Models\Product;
use Illuminate\Http\Request;

class PriceDicountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pricediscount = PriceDiscountModel::with('product')->get();
        $title = "Danh sách sản phẩm khuyến mãi";
        return view('admin.price_discount.all',compact('title',"pricediscount"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $title = "Thêm tiền giảm giá";
        $product = Product::all();
        return view('admin.price_discount.add',compact('title','product'));
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
        $rule=[
            'slc_product'=>'required',
            'percent_price'=>'required',
            'end_date'=>'required',
        ];
        $message=[
            'slc_product.required'=>'Sản phẩm phải chọn',
            'percent_price.required'=>'Phần trăm số tiền giảm phải chọn',
            'end_date.required'=>'Ngày kết thúc bắt buộc phải chọn',

        ];
        $request->validate($rule,$message);
        $pricediscount = new PriceDiscountModel();
        $pricediscount->product_id = $request->slc_product;
        $pricediscount->percent_price = $request->percent_price;
        $pricediscount->created_at = date('Y/m/d');
        $pricediscount->end_at = $request->end_date;
        $pricediscount->save();
        
        return back()->with('success','Thêm thành công');
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
        $title = "Cập nhật giá khuyến mãi";
        $pricediscount = PriceDiscountModel::with('product')->find($id);
        $product = Product::all();
        return view('admin.price_discount.edit',compact('title','pricediscount','product'));
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
        $rule=[
            'slc_product'=>'required',
            'percent_price'=>'required',
            'end_date'=>'required',
        ];
        $message=[
            'slc_product.required'=>'Sản phẩm phải chọn',
            'percent_price.required'=>'Phần trăm số tiền giảm phải chọn',
            'end_date.required'=>'Ngày kết thúc bắt buộc phải chọn',

        ];
        $request->validate($rule,$message);
        $pricediscount = PriceDiscountModel::find($id);
        $pricediscount->product_id = $request->slc_product;
        $pricediscount->percent_price = $request->percent_price;
        $pricediscount->created_at = date('Y/m/d');
        $pricediscount->end_at = $request->end_date;
        $pricediscount->save();
        
        return back()->with('success','Cập nhật thành công');
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
        $pricediscount = PriceDiscountModel::find($id)->delete();
        return back()->with('success','Xóa thành công');
    }
}
