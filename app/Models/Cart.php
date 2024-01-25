<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'product_id',
        'pty',
        'price',
        'coupon_code'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function tbl_order() {
        return $this->belongsTo('App\Models\OrderModel','order_id');
    }
}
