@extends('layouts.topNav')
@section('content')
<title>Profile</title>
<h1>My Profile</h1>
<style>
    #frm{
        width:600px;
        margin: 20px 300px;
        padding:30px;
        border-radius: 10px;
        box-shadow: 0px 0px 50px blue;
        background-color: transparent; 
        color: #34495e;
      }
</style>
<div align="right";> <a class="btn btn-danger" href="{{route('deleteAccount',['id'=>$user->id])}}">Delete Account</a></div>

<form id="frm" method="post" action="{{route('update')}}">
<h4 class="text text-info">Personal Information</h4>
{{csrf_field()}}
<table>
<tr>
    <td>Name</td>
    <td><input style="width:250px" type="text" name="name" value="{{$user->customers->name}}" class="form-control">
    @error('name')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>Username</td>
    <td><input style="width:250px" type="text" name="username" value="{{$user->username}}" class="form-control">
    @error('username')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>Password</td>
    <td><input style="width:250px" type="password" name="password" value="{{$user->password}}" class="form-control">
    @error('password')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>Email</td>
    <td><input style="width:250px" type="email" name="email" value="{{$user->email}}" class="form-control">
    @error('email')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>Phone No</td>
    <td><input style="width:250px" type="number" name="phone" value="{{$user->customers->phone}}" class="form-control">
    @error('phone')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td colspan=2><hr></td>
</tr>
<tr>
    <td>address</td>
    <td><input style="width:250px" type="text" name="address" value="{{$user->customers->address}}" class="form-control">
    @error('address')
    <span class="text-danger">{{$message}} </span>
    @enderror</td>
</tr>
<tr>
    <td></td>
    <td><br><input style="width:250px" type="submit" class="btn btn-primary" value="Update" ></td>
</tr>
</table>

</form>

@endsection