<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'sliders';
    protected $fillable =[
        'name',
        'thumb',
        'active',
        'product_id',
    ];
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
}
