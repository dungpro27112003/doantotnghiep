<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Products\ProductService;


class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    

    public function index($id = '',$slug = ''){
        $product = $this->productService->show($id);
        $products = $this->productService->getSimilarProducts($product);
        return view('products.content',[
            'title' => $product->name,
            'product'=> $product,
            'products'=> $products
        ]);
    }
}
