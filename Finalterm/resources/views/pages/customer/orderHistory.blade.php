@extends('layouts.topNav')
@section('content')
<title>Order Details</title>
<h1>Order History</h1>
@if($order)
<table class="table table-bordered">
    <tr class="text text-info">
        <td>Order Date & Time</td>
        <td>Status</td>
        <td>Delivery Date</td>
        <td>total price</td>
        <td>Order Details</td>
        <td>Cancel Order?</td>
    </tr>
   
    @php
    $total=0;
    @endphp
    @foreach($order as $item)
        <tr class="text text-success">
            <td>{{$item->orderDate}}</td>
            <td>{{$item->status}}</td>
            <td>{{$item->deliveryDate}} </td>
            <td>{{$item->totalPrice}}</td>
            <td><a class="btn btn-primary" href="{{route('viewDetails',['id'=>$item->id])}}">View Details</a></td>
            <td> 
                
                @if ($item->status=="ordered")
                     <a class="btn btn-danger" href="{{route('removeOrder',['id'=>$item->id])}}">Cancel</a>
                @endif
            </td>
        </tr>
        @php
            $total+=$item->totalPrice;
        @endphp
    @endforeach
    <tr>
        <td></td>
        <td></td>
        <td>Total ammount</td>
        <td>{{$total}}</td>
        <td></td>
    </tr>
    
</table>
@else
    You have no order history
@endif
@endsection