<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;

class CustomerApiController extends Controller
{
    //
    public function products(){
        
        $products= product::all();
        return $products;
    }
}
