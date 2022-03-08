@extends('layouts.topNav')
@section('content')
<title>Login</title>

<form id="frm" method="post" action="{{route('loginSubmit')}}">
<h3>Login page</h3>
@if(isset($f))
<h4 class="text text-danger">{{ $f }}</h4>
@else
@endif
    <!-- Cross Site Request Forgery-->
    {{csrf_field()}}
    <style>
    #frm{
        width: 600px;
        margin: 20px 300px;
        height: 480px;
        padding:30px;
        border-radius: 5px;
        box-shadow: 0px 0px 10px green;
        background-color: transparent; 
        color: #34495e;
      }
    #txt{
	width: 250px;
	height: 35px;
	font-size:20px;
	border-radius:5px;
}
      </style>
    <div class="col-md-5 form-group">
        <br>
        <h4 align="left">Username</h4>
    <input id="txt" type="text" name="username" value="{{old('username')}}" class="form-control">
    @error('username')
    <span class="text-danger">{{$message}} </span>
    @enderror
    </div> 

    <div class="col-md-5 form-group">
        <h4 align="left">Password</h4>
        <input id="txt" type="password" name="password" value="{{old('password')}}" class="form-control">
        @error('password')
        <span class="text-danger">{{$message}} </span>
        @enderror
    </div>
    <div class="col-md-5 form-group">
        <br>
        <input style="width:250px" type="submit" class="btn btn-primary" value="Login" >
    </div>
    <br>
    <hr>
    <h5 style="color:black;">new here?</h5>
    <div class="col-md-5 form-group">
        
        <a style="width:250px" href="{{route('registration')}}" class="btn btn-info" >Register</a>
    </div>
</form>
@endsection