<html>
<head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

</head>
<body>
<div>
    <a type="submit" class="btn btn-success" href="{{route('create')}}">Add New Product</a> 
    <a type="submit" class="btn btn-success" href="{{route('view')}}"> Product List</a>   
</div>

<div>
@yield('content')
</div>

</body>
</html>