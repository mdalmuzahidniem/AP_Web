@extends("layouts.topNav") 

@section('content')
<title>Products</title>
<h1>product list</h1>
<form method="post" action="{{route('search')}}">
{{csrf_field()}}
<font size="5px">choose catagory</font>
<select name="catagory" style="width: 145px; height: 45px; font-size:20px; border-radius: 6px;">
<option value="refrigerator">Refrigerator</option>
<option value="phone">Phone</option>
<option value="laptop">Laptop</option>
<option value="television">Television</option>
<option value="ac">Ac</option>
</select>

<input style="width: 80px; height: 45px; font-size:20px; border-radius: 6px;" type="submit" class="btn btn-success" value="Search" >
</form>
<hr>
@if($catagory)
@foreach($catagory->productInfo as $item)
        <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="{{$item->image}}"alt="Cart image cap">
            <div class="card-body">
            
            <p class="card-text text-center"><b class="text text-success">{{$item->name}}</b> <br>
            <span><b>Price:</b> <font class="text text-danger">BDT {{$item->unitPrice}}</font></span><br>
            <span><b>Details:</b>{{$item->details}}</span>
            <br>
            <a href="{{route('addtocart',['id'=>$item->id])}}" class="btn btn-primary">add to cart</a></p>
            
            </div>
        </div>
        <br>
@endforeach
@else
<h4 class="text text-danger"> No product is available</h4>
@endif

@endsection