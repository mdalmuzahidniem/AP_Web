@extends('layouts.topNav')
@section('content')

<style>
    #frm{
        width:550px;
        margin: 20px 300px;
        padding:30px;
        border-radius: 10px;
        box-shadow: 0px 0px 50px blue;
        background-color: transparent; 
        color: #34495e;
      }
</style>
<form id="frm" method="post" action="{{route('regSubmit')}}">
<h1 class="text text-primary">Registration page</h1>
<hr>
{{csrf_field()}}
<table>
<tr>
    <td>Full Name</td>
    <td><input style="width:250px" type="text" name="name" value="{{old('name')}}" class="form-control">
    @error('name')
    <span class="text-danger">{{$message}} </span>
    @enderror
    
</td>
</tr>

<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>Username</td>
    <td><input style="width:250px" type="text" name="username" value="{{old('username')}}" class="form-control">
    
    @error('username')
    <span class="text-danger">{{$message}} </span>
    @enderror
    @if(isset($f))
    <h5 class="text text-danger">{{ $f }}</h5>
    @endif
</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>Password</td>
    <td><input style="width:250px" type="password" name="password" value="{{old('password')}}" class="form-control">
    @error('password')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>Email</td>
    <td><input style="width:250px" type="email" name="email" value="{{old('email')}}" class="form-control">
    @error('email')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>Phone No</td>
    <td><input style="width:250px" type="number" name="phone" value="{{old('phone')}}" class="form-control">
    @error('phone')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>address</td>
    <td><input style="width:250px" type="text" name="address" value="{{old('address')}}" class="form-control">
    @error('address')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td></td>
    <td><br><input style="width:250px" type="submit" class="btn btn-primary" value="Signup" ></td>
</tr>
</table>

</form>
@endsection