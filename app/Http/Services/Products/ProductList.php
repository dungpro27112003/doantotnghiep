<?php

namespace App\Http\Services\Products;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductList
{
    const LIMIT = 16;
    public function get($page = null){
        return Product::select('id','name','price','price_sale','thumb')
        ->orderByDesc('id')
        ->when($page !=null, function($query) use ($page){
            $query->offset($page * self::LIMIT);
        })
        ->limit(self::LIMIT)
        ->get();
    }
}