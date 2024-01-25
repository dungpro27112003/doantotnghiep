<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCustomerModel extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'user_customer';
    protected $primaryKey = 'user_customer_id';
    protected $fillable = [
        'user_customer_name',
        'user_customer_email',
        'user_customer_password',
    ];
    public function coupon(){
        return $this->belongsToMany(CouponModel::class,'user_coupon','user_customer_id','coupon_id');
    }
    public function role(){
        return $this->belongsToMany(RoleMode::class,'user_role','user_customer_id','role_id');
    }
    public function has_role($role){
        return null !== $this->role()->wherePivot('role_id',$role)->first();
    }
    public function has_Anyrole($role){
        return null !== $this->role()->wherePivotIn('role_id',$role)->first();
    }
}
