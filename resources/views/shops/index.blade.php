@extends('layouts.app')

<button onclick="scrollToTop()" id="goToTopBtn" class="btn btn-danger rounded-circle shadow" title="กลับไปด้านบน">
    ^
</button>
<script>
    // เมื่อ Scroll ลงให้แสดงปุ่ม
    window.onscroll = function() {
        let button = document.getElementById("goToTopBtn");
        if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    };

    // เมื่อกดปุ่ม ให้เลื่อนขึ้นไปบนสุด
    function scrollToTop() {
        window.scrollTo({top: 0, behavior: 'smooth'});
    }
</script>

@section('content')
    <div class="container">
        <div class="shop">
            <div class="menu-list">
                <h1 style="padding: 1rem 0; font-weight:900; ">Category</h1>
                @foreach ($productsGrouped as $productType => $products)
                            <a href="#{{ $productType }}"><h3 style="text-transform: capitalize; padding-bottom: 20px; font-weight:600">{{ $productType }}</h3></a>
                @endforeach
            </div>
            <div class="menu">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="row mt-2">
                    <form action="{{ route('products.search') }}" method="GET" class="d-flex mb-3">
                        <input type="search" name="query" placeholder="ค้นหาสินค้า..." value="{{ request('query') }}" class="form-control me-2">
                        <button type="submit" class="btn btn-outline-success">ค้นหา</button>
                    </form>
                    @if (isset($productsGrouped) && $productsGrouped->isNotEmpty())
                        @foreach ($productsGrouped as $productType => $products)
                            <h3 style="text-transform: capitalize" class="mt-5" id="{{ $productType }}">{{ $productType }}</h3>
                            @foreach ($products as $item)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <!-- เพิ่ม w-100 เพื่อให้รูปภาพเต็มความกว้างของ card -->
                                        <img src="{{ asset('storage/' . $item->image) }}" alt=""
                                            class="card-img-top w-100" style="height: 300px; object-fit: cover;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->name }}</h5>
                                            <p class="card-text">Price: {{ $item->Price }}</p>
                                            <p class="card-text">Stock: {{ $item->stock }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <form action="{{ route('orders.store', $item->id) }}" method="POST">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-danger">เพิ่มไปยังตระกร้า</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @else
                        <p>ไม่พบสินค้าที่ค้นหา</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

