@extends('inc.topNev')
@section('content')
<h1>Add new product</h1>
<form method="post" action="/create">
<!-- Cross Site Request Forgery-->
{{csrf_field()}}
<div class="col-md-2 form-group">
        <br>
        <h4>Product Name:</h4>
    <input type="text" name="name" value="{{old('name')}}" class="form-control">
    @error('name')
    <span class="text-denger">{{$message}} </span>
    @enderror
</div> 
<div class="col-md-2 form-group">
<h4>Product Price:</h4>
<input type="number" name="price" value="{{old('price')}}" class="form-control">
    @error('price')
    <span class="text-denger">{{$message}} </span>
    @enderror
</div>
<div class="col-md-2 form-group">
<h4>Quantity:</h4>
<input type="number" name="quantity" value="{{old('quantity')}}" class="form-control">
    @error('quantity')
    <span class="text-denger">{{$message}} </span>
    @enderror
</div>
<div class="col-md-2 form-group">
<h4>Description:</h4>
<input type="text" name="description" value="{{old('description')}}" class="form-control">
    @error('description')
    <span class="text-denger">{{$message}} </span>
    @enderror
</div>
<div class="col-md-2 form-group">
        <input type="submit" class="btn btn-success" value="Add" >
</div>


</form>
@endsection