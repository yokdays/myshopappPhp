@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="">ชื่อสินค้า</label>
                    <input type="text" name="name" class="form-control">
                    <label for="">ราคา</label>
                    <input type="number" name="price" class="form-control">
                    <div class="col-md-12">
                        <div class="form-group">
                            <strong>Image</strong>
                            <input type="file" class="form-control" name="image" required>
                            @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
