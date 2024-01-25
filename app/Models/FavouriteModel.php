<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavouriteModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_favourite';
    protected $id = 'favourite_id';
    public $timestamps = false;
    protected $fillable = [
        'user_customer_id',
        'product_id',
    ];
    public function user(){
        return $this->belongsTo(UserCustomerModel::class,'user_customer_id');
    }
    public function product() {
        return $this->belongsTo(Product::class,'product_id');
    }
}
