<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product;

class catagory extends Model
{
    use HasFactory;
    public $timestamps= false;
    public function productInfo(){
        return $this->hasMany(product::class,'catagoryId');
    }
}
