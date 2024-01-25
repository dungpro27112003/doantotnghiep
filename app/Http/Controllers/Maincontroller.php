<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Slider\SliderService;
use App\Http\Services\Products\ProductList;
use  App\Http\Services\CheckAuth;
use App\Models\FavouriteModel;
use App\Models\Menu;
use App\Models\PriceDiscountModel;
use App\Models\Product;
use App\Models\User;
use App\Models\UserCustomerModel;
use Faker\Core\Number;

class MainController extends Controller
{
    protected $slider;
    protected $menu;
    protected $product;
    protected $checkAuth;

    public function __construct(SliderService $slider, MenuService $menu, ProductList $product  )
    {
        $this->slider = $slider;
        $this->menu = $menu;
        $this->product = $product;
    }
    // checkAUTH admin
    public function checkAuth(){
        if(!empty(session('user'))){
            return redirect()->route('indexAdmin');
        }else{
            return redirect()->route('loginAdmin')->send();
        }
    }
    // indexAdmin
    function indexAdmin() {
        if($this->checkAuth()){
            $admin = UserCustomerModel::where('user_customer_email',session('user')['user_customer_email'])->first();
            $title = "Admin";
            return view('admin.home',compact('title','admin'));
    
        }
    }
    // index the gioi di dong
    public function index()
    {
        return view('layout.main', [
            'title' => 'Thế giới di động',
            'sliders' => $this->slider->show(),
            'menus' => $this->menu->show(),
            'products' => $this->product->get(),
        ]);
    }
    public function loadProductFillter (Request $request){
        $productFilter = $this->product->get(null,$request->id);
        $products = $this->product->get();
        return view('products.list',compact('productFilter','products'));
    }

    public function loadProduct(Request $request)
    {
        $page = $request->input('page', 0);
        $result = $this->product->get($page);
        $favourite = FavouriteModel::where('user_customer_id',session('user_customer_id'))
        ->orderBy('product_id','DESC')
        ->get();
        $pricediscount = PriceDiscountModel::get();
        
        if(count($result)!=0){
            $html = view('products.list',['products'=>$result,'favourite'=>$favourite,'productdiscount'=>$pricediscount])->render();
            return response()->json([
                'html' => $html 
            ]);
        }
        return response()->json([
            'html' => '' 
        ]);
        
    }
}