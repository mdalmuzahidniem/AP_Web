<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\customer;
class Alluser extends Model
{
    use HasFactory;
    public $timestamps=false;
    public function customers(){
        return $this->hasOne(customer::class,'userId');
    }
}
