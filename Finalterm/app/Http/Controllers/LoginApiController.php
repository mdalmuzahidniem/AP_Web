<?php

namespace App\Http\Controllers;
use App\Models\token;
use App\Models\Alluser;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoginApiController extends Controller
{
    //
    public function login(Request $request){
        $user=Alluser::where('username',$request->username)
            ->where('password',$request->password)
            ->First();
        if($user){
            $api_token= Str::random(64);
            $date=Carbon::now();

            $token=new token();
            $token->userId=$user->id;
            $token->token=$api_token;
            $token->created_at=$date->toDateTimeString();
            $token->save();
            session()->put('userId',$user->id);
            return $token;
        }
        
    }
}
