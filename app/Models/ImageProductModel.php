<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProductModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_image_product';
    protected $primaryKey = 'image_id';
    protected $fillable = [
        'image_link',
        'product_id',
    ];
    public $timestamps = false;

    public function tbl_product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
