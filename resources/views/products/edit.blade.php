@extends('layouts.master')
@section('css')
<!-- قم بتضمين أي CSS إضافي هنا إذا لزم الأمر -->
@endsection

@section('content')
<div class="container text-center">
    <h1>Edit Product</h1>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h2>Release Producer</h2>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') 
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}">
                </div>
                <div class="form-group">
                    <label for="company">Company</label>
                    <input type="text" class="form-control" id="company" name="company" value="{{ $product->company }}">
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<!-- قم بتضمين أي JavaScript إضافي هنا إذا لزم الأمر -->
@endsection