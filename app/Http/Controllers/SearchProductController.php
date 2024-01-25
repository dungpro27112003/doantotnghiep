<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchProductController extends Controller
{
    //
    public function search_product(Request $request){
        if(!empty( $request->search)){
            $title = 'Tìm kiếm sản phẩm';
            $products = Product::where('name','like','%'.$request->search.'%')->get();
            return view('searchProduct.search',compact('title','products'));
        }else{
            return back();
        }
    }
}
