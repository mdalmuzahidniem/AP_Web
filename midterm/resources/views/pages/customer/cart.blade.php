@extends('layouts.topNav')
@section('content')
<title>Cart</title>
<h1>My cart</h1>
    

@if(Session::has('cart'))
<div align="right">
<a class="btn btn-success" href="{{route('emptyCart')}}">empty cart</a>
</div>

<table class="table table-bordered">

    <tr class="text text-info">
    <td>image</td>
    <td>name</td>
    <td>quantity</td>
    <td>Unit price</td>
    <td>total</td>
    </tr>
    @php
    $total=0;
    @endphp
    @foreach($cart as $item)
        <tr class="text text-success">
            <td><img src="{{$item->image}}" width="50px" height="50px"></td>
            <td>{{$item->name}}</td>
            <td>{{$item->qty}}
            <a class="btn btn-primary" href="{{route('decrease',['id'=>$item->id])}}">-</a>
            <a class="btn btn-primary" href="{{route('increase',['id'=>$item->id])}}">+</a>
            </td>
            <td>{{$item->price}}</td>
            <td>{{$item->qty*$item->price}}</td>
            
        </tr>
        @php
            $total+=$item->qty*$item->price;
        @endphp
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Grand total</td>
        <td>{{$total}}</td>
    </tr>
    
</table>
<div align="left">
    
    <a class="btn btn-primary" href="{{route('checkout',['total_price'=>$total])}}">Checkout Now!</a>
    
</div>
@else
<p class="text text-danger">cart is empty</p>
@endif

@endsection