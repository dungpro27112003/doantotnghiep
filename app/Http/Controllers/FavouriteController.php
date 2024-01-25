<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FavouriteModel;
use App\Models\Product;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    //
    function favourite(Request $request) {
        if(!empty($request->user) && !empty($request->id)){
            $favourite = FavouriteModel::where('product_id',$request->id)->where('user_customer_id',$request->user)->first();
            if($favourite == null){
                    FavouriteModel::create([
                        'user_customer_id'=>$request->user,
                        'product_id'=>$request->id,
                    ]);
                }else{
                    FavouriteModel::where('favourite_id',$favourite->favourite_id)->delete();
                    return 1;
                }
            return 0;
        }
        return 2;
    }
}
