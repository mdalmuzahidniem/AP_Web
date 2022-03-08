@extends('layouts.topNav')
@section('content')
<h1 class="text text-primary">Ordered product's details</h1>
<table class="table table-bordered">
        <tr class="text text-info">
            <td>Picture</td>
            <td>Product Name</td>
            <td>Quantity</td>
            <td>Unit Price</td>
            <td>Details</td>
            
        </tr>
@foreach($detail as $p)
    <tr class="text text-success">
        <td><img src="{{$p->products->image}}"  width="130px" height="150px"></td>
        <td>{{$p->products->name}}</td>
        <td>{{$p->productQuantity}}</td>
        <td>{{$p->unitPrice}}</td>
        <td>{{$p->products->details}}</td>
    </tr>
    
@endforeach
</table>
@endsection