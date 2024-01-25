<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $fillable = [
        'name',
        'content',
        'menu_id',
        'hang_id',
        'price',
        'price_sale',
        'active',
        'thumb',
        'product_quantity',
    ];

    public function menu(){
        return $this->belongsTo(Menu::class,'menu_id');
    }
    public function hang(){
        return $this->hasOne(Hang::class,'id','hang_id');
    }
    public function favourite() {
        return $this->hasMany(FavouriteModel::class,'product_id');
    }
    public function tbl_image_product(){
        return $this->hasMany(ImageProductModel::class,'product_id');
    }
    public function tbl_price_dicount(){
        return $this->hasOne(PriceDiscountModel::class,'product_id');
    }
}
