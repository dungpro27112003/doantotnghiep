<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';
    protected $fillable = [
        'order_name',
        'order_phone',
        'order_address',
        'order_email',
        'created_at',
        'updated_at',
        'user_customer_id',
        'coupon_id',
    ];
    public function carts(){
        return $this->hasMany(Cart::class,'order_id');
    }
    public function coupon(){
        return $this->belongsTo(CouponModel::class,'coupon_id');
    }
}
