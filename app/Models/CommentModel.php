<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentModel extends Model
{
    use HasFactory;
    protected $table = 'tbl_comment';
    protected $priamryKey = 'comment_id';
    protected $fillable = [
        'product_id',  
        'user_customer_id',  
        'comment_content',  
        'created_at',  
    ];
    public $timestamps = false;
    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }
    public function UserCustomer(){
        return $this->belongsTo(UserCustomerModel::class,'user_customer_id');
    }
}
