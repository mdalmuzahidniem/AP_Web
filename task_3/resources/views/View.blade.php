@extends('inc.topNev')
@section('content')
<h1>View product<h1>

    <table class="table table-borded mt-4">
        <tr align="center"><td>ID</td><td>Product Name</td><td>Price</td><td>Quantity</td><td>Description</td><td colspan="3">Actions</td></tr>
        @foreach($products as $p)
            <tr align="center">
                <td>{{$p->id}}</td>
                <td>{{$p->name}}</td>
                <td>{{$p->price}}</td>
                <td>{{$p->quantity}}</td>
                <td>{{$p->description}}</td>
                <td><a class="btn btn-success" href="/edit/{{$p->id}}">Edit</a></td>
                <td><a class="btn btn-danger" href="/delete/{{$p->id}}">Delete</a></td>
                <td><a class="btn btn-primary" href="/create/{{$p->id}}">Add to cart</a></td>
            </tr>
        @endforeach
    </table>

@endsection