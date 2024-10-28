@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-2">เพิ่มสินค้านะ</a>
            </div>
            @foreach ($products as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                        <!-- เพิ่ม w-100 เพื่อให้รูปภาพเต็มความกว้างของ card -->
                        <img src="{{ asset('storage/'.$item->image) }}" alt="" class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $item->name }}</h5>
                            <p class="card-text">Price: {{ $item->Price }}</p>
                            <p class="card-text">Stock: {{ $item->stock }}</p>
                        </div>
                    <div class="card-footer">
                        <form action="{{ route('products.destroy', $item->id) }}" method="POST">
                            <a href="{{ route('products.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="row">
                <div class="col-12">
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
