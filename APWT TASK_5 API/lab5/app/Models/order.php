<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\orderdetail;

class order extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function products(){
        return $this->hasMany(orderdetail::class,'orderId');
    }
}
