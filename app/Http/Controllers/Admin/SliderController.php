<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Product;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $slider;

    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }

    public function create(){
        $product = Product::all();
        return view('admin.slider.add',[
            'title'=>'Thêm Silder mới',
            'product'=>$product,
        ]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'thumb'=>'required',
        ]);

        $this->slider->insert($request);

        return redirect()->back();
    }

    public function index(){
        return view('admin.slider.list',[
            'title'=>'Danh sách Slider mới nhất',
            'sliders'=>$this->slider->get(),
        ]);
    }

    public function show(Slider $slider){
        return view('admin.slider.edit',[
            'title'=>'Chỉnh sửa Slider',
            'sliders'=>$slider,
        ]);
    }

    public function update(Request $request, Slider $slider){
        $this->validate($request,[
            'name'=>'required',
            'thumb'=>'required',
        ]);
        $result = $this->slider->update($request,$slider);

        if($result){
            return redirect('admin/sliders/list');
        }
        return redirect()->back();
    }

    public function destroy(Request $request){
        $result = $this->slider->destroy($request);
        if($result){
            return response()->json([
                'error'=>false,
                'message' =>'Xoá thành công Silder'
            ]);
        }
        return response()->json([
            'error'=>true,
        ]);
    }
}
