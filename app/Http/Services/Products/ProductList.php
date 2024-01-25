<?php

namespace App\Http\Services\Products;

use App\Models\FavouriteModel;
use App\Models\Product;

class ProductList
{
    const LIMIT = 8;

    public function get($page = null,$id = null)
    {
        if(empty($page) && !empty($id)){
            return Product::where('menu_id',$id)
            ->orderByDesc('id')
            ->limit(self::LIMIT)
            ->get();
        }
            return Product::select('id', 'name', 'price', 'thumb')
                ->with('favourite')
                ->orderByDesc('id')
                ->when($page !== null, function ($query) use ($page) {
                    $query->offset($page * self::LIMIT);
                })
                ->limit(self::LIMIT)
                ->get();
    }
    
}