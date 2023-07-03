@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success_message'))
                <div class="alert alert-success" role="alert">
                    {{ session('success_message') }}
                </div>
            @endif

            <form action="{{ route('products.store') }}" id="formAccountSettings" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                </div>

                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Price" value="{{ old('price') }}">
                </div>

                <div class="form-group">
                    <label for="name">Product Description</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Enter Product Description" value="{{ old('description') }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('products.index') }}">
                    <button type="button" class="btn" style="background-color: #FF453A; color: #fff" ;>
                        Cancel</button></a>
            </form>
        </div>
    </div>
</div>
@endsection
