<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMode extends Model
{
    use HasFactory;
    protected $table = "tbl_role";
    protected $primaryKey = 'role_id';
    protected $fillable = [
        'role_name',
    ];
    public $timestamps = false;
    public function user_customer() {
        return $this->belongsToMany(UserCustomerModel::class,'user_role','user_customer_id','role_id');
    }

}
