<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;
class orderdetail extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function products(){
        return $this->hasOne(product::class,'Id','productId');
    }
}
