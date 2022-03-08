<html>
<head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>
<body>
<div class="topnav">
    <a href="{{route('logout')}}">Logout</a>
    <a href="{{route('products')}}">View Products</a>
    <a href="{{route('cart')}}">My Cart</a>
    <a href="{{route('order.status')}}">My Oder History</a>  
    <a href="{{route('myProfile')}}">My Profile</a>
      
    
</div>
<!-- 
1. add black background color to the top navigation
2. style the links inside the navegation bar
3. change the color of the link on hover
4. add a color to active hover 
-->

<style>

.topnav{
    background-color:#333;
    overflow: hidden;
}
.topnav a{
    float: left;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 17px;
}
.topnav a:hover{
    background-color: #ddd;
    color: black;
}
.topnav a.active{
    background-color: #04AA6D;
    color: white;
}
</style>

    <div align="center">
        @yield('content')
    </div>

</body>
<div>
    <footer>
        <br>
        <hr>
    <center>
            <p valign="middle" style="color: black; align:center;">Copyright@2021</p>
    </center>
    </footer>
</div>
</html>