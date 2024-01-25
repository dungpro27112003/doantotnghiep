<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceDiscountModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_price_discount';
    protected $fillable = [
        'product_id',
        'percent_price',
        'created_at',
        'end_at',
    ];
    public $timestamps = false;
    
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
