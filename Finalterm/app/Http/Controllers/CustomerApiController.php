<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\catagory;
use App\Models\order;
use App\Models\orderdetail;
use App\Models\customer;
use App\Models\Alluser;
use App\Models\token;
use Carbon\Carbon;
use Illuminate\Support\Str;

class CustomerApiController extends Controller
{

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


    //show all products
    public function products(){
        
        $products= product::all();
        return $products;
    }
    //search function of products
    public function search(Request $req){
        $catagory=catagory::where('name',$req->catagory)
        ->First();
        if($catagory){
            return $catagory->productInfo;
        }
        return "no product is available";
    }
    //view cart
    public function cart(){
            
        if(!session()->has('cart')){
            return "cart is empty";
        }
        $cart=json_decode(session()->get('cart'));
        return $cart;
    }
    //add item to cart
    public function addtocart(Request $req){
        
        $id=$req->id;
        $p=Product::where('id',$id)->First();
        $cart=[];
        
        if(session()->has('cart'))
        {
            $cart=json_decode(session()->get('cart'));
            foreach($cart as $item){
                if($item->id==$id){
                    
                    $qty=$item->qty;
                    $qty=$qty+1;
                    $item->qty=$qty;

                    $jsonCart=json_encode($cart);
                    session()->put('cart',$jsonCart);
                    $i= session()->get('cart');
                    return $i;
                }
            }
            
        }
       
        $product=array('id'=>$id,'qty'=>1,'name'=>$p->name,'price'=>$p->unitPrice,'image'=>$p->image);
        $cart[]=(object)($product);
        
        $jsonCart=json_encode($cart);
        session()->put('cart',$jsonCart);
        
        //$cart=json_decode(session()->get('cart'));
        //return $cart;
        $i= session()->get('cart');
        return $i;
        //return redirect()->route('cart');
        
        
    }
    //increase quantity by pressing + button
    public function increase(Request $req){
        $id=$req->id;
        $cart=json_decode(session()->get('cart'));
            foreach($cart as $item){
                if($item->id==$id){
                    
                    $qty=$item->qty;
                    if($qty<5){
                        $qty=$qty+1;
                    }
                    $item->qty=$qty;
                }
            }
            $jsonCart=json_encode($cart);
            session()->put('cart',$jsonCart);
            //return redirect()->route('cart');
            $i= session()->get('cart');
            return $i;
    }
    //decrease quantity by - button
    public function decrease(Request $req){
        $id=$req->id;
        $i=0;
        $cart=json_decode(session()->get('cart'));
            foreach($cart as $item){
                if($item->id==$id){
                    
                    $qty=$item->qty;
                    if($qty!=0){
                        $qty=$qty-1;
                    }
                    $item->qty=$qty;
                    if($qty==0){
                        unset($cart[$i]);
                    }  
                }
               $i++;
            }
            /*
            for($i=0; $i<count($cart); $i++){
                return null;
            }
            */
            $jsonCart=json_encode($cart);
            session()->put('cart',$jsonCart);
            return session()->get('cart');
    }
    //empty cart
    public function emptyCart(){
        session()->forget('cart');
        return "cart empty successful";
    }

    //add order to database by checkout
    public function checkout(Request $req){
        $total=0;
        $limit=2;
        
        //count array element
        for($i=0;$i<$req->c;$i++){
            $price=0;
            foreach($req[$i] as $p){
                $price=$p['qty']*$p['price'];
                
            }
            $total=$total+$price;
        }
        
        
        //return $total;
        
        //find userId from authorization token
        $token=$req->header("Authorization");
        $user=token::where('token',$token)
        ->First();
        
    if($req){
        //$products=json_decode(session()->get('cart'));
        $date=Carbon::now();
        //insert to orders table
        $order= new order();
        $order->userId=$user->userId;
        $order->status="ordered";
        $order->orderDate=$date->toDateTimeString();
        $order->totalPrice=$total;
        $order->save();
        //insert to order details
        //foreach($req as $p){
            for($i=0;$i<$req->c;$i++){
                foreach($req[$i] as $p){
                    $o_d=new orderdetail();
                    $o_d->orderId=$order->id;
                    $o_d->productQuantity=$p['qty'];
                    $o_d->productId=$p['id'];
                    $o_d->unitPrice=$p['price'];
                    $o_d->save();
                }
            }
            
        //}
        //echo '<script>alert("Order placed successfully!")</script>';
        //session()->forget('cart');
        return "order placed successfully";
        
    }
    //return "there is nothing in the cart to checkout";
    //return $req[0]['qty']*$req[0]['price'];
    }
    //check order history
    public function orderHistory(Request $req){
        
        $order=order::where('userId',$req->id)
        ->get();
        
        if($order){
            return $order; 
        }
        return "no order history";
    }
    //view product details
    public function viewDetails(Request $req){
        //return $req->id;
        
        $detail=orderdetail::where('orderId',$req->id)
        ->get();
        $info=[];
        
        if($detail){
            

            foreach($detail as $item){
                
                $product=array('details'=>$item->products->details,'qty'=>$item->productQuantity,'name'=>$item->products->name,'price'=>$item->unitPrice,'image'=>$item->products->image);
                $info[]=(object)($product);
            }
            $jsonInfo=json_encode($info);
        }
            
        return $jsonInfo;
    }


    //cancel order
    public function removeOrder(Request $req){
        
        //$detail=orderdetail::where('orderId',$req->id)->delete();
        $orderInfo=order::where('id',$req->id)->First();
        $orderInfo->status="Canceled";
        $orderInfo->save();
        //echo '<script>alert("Order canceled successfully!")</script>';
        return "canceled";
    }

    //view profile
    public function profile(Request $req){
        $user=Alluser::where('id',$req->id)
        ->First();
        //return $user->customers;
        if($user){
            $customer=customer::where('userId',$user->id)
            ->First();
            $pinfo=array('id'=>$user->id,'name'=>$customer->name,'username'=>$user->username,'password'=>$user->password,'email'=>$user->email,'phone'=>$customer->phone,'address'=>$customer->address);

            //$info=array($user,$customer);
            return $pinfo;
        }
        return "not found";
    }

    //update profile info
    public function updateProfile(Request $req){
        
        $user=Alluser::where('id',$req[0])
        ->First();
        
        $user->username=$req[2];
        $user->password=$req[3];
        $user->email=$req[4];
        $user->customers->name=$req[1];
        $user->customers->address=$req[6];
        $user->customers->phone=$req[5];
        $user->save();
        $user->customers->save();

        return $user;
    }

    //delete account
    public function deleteAccount(Request $req){
        $id=$req->id;
        $delete=alluser::where('id',$req->id)->delete();
        session()->flush();
        return "Account Deleted";
    }

    //logout
    public function logout(Request $request){
        //session()->forget('name');
        //session()->flush();

        $token=$request->header("Authorization");
        $check_token=token::where('token',$token)
                ->where('expired_at',NULL)
                ->first();
        if($check_token){
            $date=Carbon::now();
            $check_token->expired_at=$date->toDateTimeString();
            $check_token->save();
            return "logout successfull";
        }
        return "logout";
    }
}
