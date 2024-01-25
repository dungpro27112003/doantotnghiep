<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ImageProductModel;
use App\Models\Product;
use Illuminate\Http\Request;

class ImageProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $title = "Danh sách hình ảnh sản phẩm";
        $image = ImageProductModel::with('tbl_product')->paginate(10);
        return view('admin.imageProduct.all',compact('image','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $product = Product::all();
        $title = "Thêm hình ảnh sản phẩm";
        return view('admin.imageProduct.add',compact('product','title'));
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
        $rule =[
            'image_link'=>['required','image','max:5024'],
            'slc_product'=>['required'],
        ];
        $message=[
            'image_link.required'=>'Hình ảnh bắt buộc phải chọn',
            'image_link.image'=>'Lỗi file',
            'image_link.max'=>'File vượt quá kích thước cho phép',

            'slc_product.required'=>'Sản phẩm bắt buộc phải chọn',
        ];
        $request->validate($rule,$message);

        $image = ImageProductModel::create([
            'image_link'=>$request->thumb,
            'product_id'=>$request->slc_product,
        ]);
        return back()->with('success','Thêm hình ảnh sản phẩm thành công');

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
        $title = "Chỉnh sửa hình ảnh sản phẩm";
        $image = ImageProductModel::find($id);
        $product = Product::all();
        return view('admin.imageProduct.edit',compact('title','image','product'));
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
        $rule =[
            'image_link'=>['required','image','max:5024'],
            'slc_product'=>['required'],
        ];
        $message=[
            'image_link.required'=>'Hình ảnh bắt buộc phải chọn',
            'image_link.image'=>'Lỗi file',
            'image_link.max'=>'File vượt quá kích thước cho phép',

            'slc_product.required'=>'Sản phẩm bắt buộc phải chọn',
        ];
        $request->validate($rule,$message);

        $image  = ImageProductModel::find($id);
        $image->image_link = $request->thumb;
        $image->product_id = $request->slc_product;
        $image->save();
        return back()->with('success','Cập nhật hình ảnh sản phẩm thành công');

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
    }
}
