<h1>login</h1>
<div>
<form method="get" action="">
    <!-- Cross Site Request Forgery-->
    {{csrf_field()}}
    <div class="col-md-4 form-group">
    <input type="text" name="name" class="form-control">
    @error('name')
                <span class="text-danger">{{$message}}></span>
    @enderror
    </div> 


    <div><input type="text" name="pass" class="form-control"></div>
    <input type="submit" class="btn btn-success" value="Login" >
</form>
<div>