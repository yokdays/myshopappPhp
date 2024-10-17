@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12">
            <h2>Edit product</h2>
        </div>
        <div>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
        </div>
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
            </div>
        @endif
        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>product Name</strong>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="productName">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>price</strong>
                        <input type="price" name="price" value="{{ $product->Price }}" class="form-control" placeholder="price">
                        @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Image</strong>
                        <input type="file" class="form-control" name="image">
                        <img src="{{ asset('storage/'.$product->image) }}" alt="" class="w-50">
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
               <div class="col-md-12">
                <button type="submit" class="btn-primary mt-3">Submit</button>
               </div>
            </div>
        </form>
    </div>
</div>
@endsection
