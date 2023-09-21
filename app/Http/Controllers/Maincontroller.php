<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Products\ProductList;

class Maincontroller extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;

    public function __construct(SliderService $slider, MenuService $menu,ProductList $product)
    {
        $this->slider =$slider;
        $this->menu = $menu;
        $this->product = $product;
    }

    public function index(){
        return view('layout.main',[
            'title'=>'Thế giới di động',
            'sliders'=>$this->slider->show(),
            'menus'=>$this->menu->show(),
            'products'=>$this->product->get(),
        ]);
    }

    public function loadProduct(Request $request){
        $page = $request->input('page',0);
        $result = $this->product->get($page);
        dd($result);
    }
}
