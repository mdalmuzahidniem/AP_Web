<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alluser;
use App\Models\product;
use App\Models\order;
use App\Models\orderdetail;
use App\Models\customer;
use App\Models\catagory;
use Carbon\Carbon;

class CustomerController extends Controller
{
    //login page
    public function login(){

        return view('pages.customer.login');
    }
    //login needed
    public function needLogin(){
        $f="You must login first";
        return view('pages.customer.login')->with('f',$f);
    }
    //login authentication check
    public function loginSubmit(Request $request){
        $validate=$request->validate([
            'username'=>'required',
            'password'=>'required|min:5',
        ]);
        //return "Ok";
        //$username=$request->username;
        $user=Alluser::where('username',$request->username)
            ->where('password',$request->password)
            ->First();
        if($user){
            session()->put('userId',$user->id);
            if($user->type=='customer'){
                //user layout
                return redirect()->route('products');
            }
        }
        $f="log in failed! Wrong Username or Password";
        
        return view('pages.customer.login')->with('f',$f);
    }
    public function registration(){
        return view('pages.customer.registration');
    }
    public function regSubmit(Request $req){
        $validate=$req->validate([
            'name'=>'required',
            'username'=>'required|min:5|max:10|regex:/^[A-Za-z]+$/',
            'password'=>'required|min:5',
            'email'=>'required|email',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address'=>'required',
            
        ]);
        //
        $info=alluser::where('username',$req->username)
        ->First();
        if($info){
            $f="Username is already exists";
            return view('pages.customer.registration')->with('f',$f);
        }
        //
        //return ok;
        $user=new Alluser();
        $user->username=$req->username;
        $user->password=$req->password;
        $user->email=$req->email;
        $user->type="customer";
        $user->save();

        $customer=new customer();
        $customer->userId=$user->id;
        $customer->name=$req->name;
        $customer->address=$req->address;
        $customer->phone=$req->phone;
        $customer->save();

        session()->put('userId',$user->id);
        return redirect()->route('products');

    }
    //view product
    public function products(){
        
        $products= product::all();
        return view('pages.customer.products')->with('products',$products);
    }
    //search function of products
    public function search(Request $req){
        $catagory=catagory::where('name',$req->catagory)
        ->First();
        //return $catagory->productInfo;
        return view('pages.customer.searchProduct')->with('catagory',$catagory);

    }

    //view cart
    public function cart(){
            
            if(!session()->has('cart')){
                return view('pages.customer.cart');
            }
            $cart=json_decode(session()->get('cart'));
            return view('pages.customer.cart')->with('cart',$cart);
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
                    return redirect()->route('cart');
                }
            }
            
        }
       
        $product=array('id'=>$id,'qty'=>1,'name'=>$p->name,'price'=>$p->unitPrice,'image'=>$p->image);
        $cart[]=(object)($product);
        
        $jsonCart=json_encode($cart);
        session()->put('cart',$jsonCart);
        
        //return session()->get('cart');
        return redirect()->route('cart');
    }
    //check order history
    public function orderHistory(){
        
            $order=order::where('userId',session()->get('userId'))
            ->get();
            
            if($order){
                return view('pages.customer.orderHistory')->with('order',$order); 
            }
            return view('pages.customer.orderHistory');

    }
    //view product details
    public function viewDetails(request $req){
        //return $req->id;
        $detail=orderdetail::where('orderId',$req->id)
        ->get();
        
        return view('pages.customer.viewDetails')->with('detail',$detail);
    }
    //view profile
    public function profile(){
        $user=Alluser::where('id',session()->get('userId'))
        ->First();
        //return $user->customers;
        return view('pages.customer.profile')->with('user',$user);
        
    }
    //update profile info
    public function updateProfile(Request $req){
        $validate=$req->validate([
            'name'=>'required',
            'username'=>'required|min:5|max:10|regex:/^[A-Za-z]+$/',
            'password'=>'required|min:5',
            'email'=>'required|email',
            'phone'=>'required|regex:/^([0-9\s\-\+\(\)]*)$/',
            'address'=>'required',
            
        ]);
        $user=Alluser::where('id',session()->get('userId'))
        ->First();
        $user->username=$req->username;
        $user->password=$req->password;
        $user->email=$req->email;
        $user->customers->name=$req->name;
        $user->customers->address=$req->address;
        $user->customers->phone=$req->phone;
        $user->save();
        $user->customers->save();

        return view('pages.customer.profile')->with('user',$user);

    }
    //empty cart
    public function emptyCart(){
        session()->forget('cart');
        return redirect()->route('cart');
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
            return redirect()->route('cart');
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
            return redirect()->route('cart');
    }

    //add order to database by checkout
    public function checkout(Request $req){
        if(session()->has('cart')){
        $products=json_decode(session()->get('cart'));
        $customerId=session()->get('userId');
        $date=Carbon::now();
        //insert to orders table
        $order= new order();
        $order->userId=$customerId;
        $order->status="ordered";
        $order->orderDate=$date->toDateTimeString();
        $order->totalPrice=$req->total_price;
        $order->save();
        //insert to order details
        foreach($products as $p){
            $o_d=new orderdetail();
            $o_d->orderId=$order->id;
            $o_d->productQuantity=$p->qty;
            $o_d->productId=$p->id;
            $o_d->unitPrice=$p->price;
            $o_d->save();
        }
        echo '<script>alert("Order placed successfully!")</script>';
        session()->forget('cart');
        return view('pages.customer.cart');
    }
    return view('pages.customer.cart');
    }
    //cancel order
    public function removeOrder(Request $req){
        
        $detail=orderdetail::where('orderId',$req->id)->delete();
        $orderInfo=order::where('id',$req->id)->delete();
        echo '<script>alert("Order canceled successfully!")</script>';
        return redirect()->route('order.history');
    }

    //delete account
    public function deleteAccount(Request $req){
        $id=$req->id;
        $delete=alluser::where('id',$req->id)->delete();
        session()->flush();
        return redirect()->route('login');
    }
    //logout
    public function logout(){
        //session()->forget('name');
        session()->flush();
        return redirect()->route('login');
    }
}
