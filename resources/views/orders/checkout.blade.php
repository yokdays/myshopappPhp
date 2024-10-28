@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    <form action="{{ route('orders.processCheckout', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">ที่อยู่</label>
            <textarea class="form-control" id="address" name="address" required></textarea>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <strong>ใบเสร็จ</strong>
                <input type="file" class="form-control" name="image" required>
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">ยืนยันการสั่งซื้อ</button>
    </form>
    <div class="d-block justify-content-center align-items-center text-center mt-4">
        <h2>ราคารวมทั้งสิ้น {{ $order->total }} บาท</h2>
        <div>
            <img src="{{ asset('storage/webimage/qrcode.png') }}" alt="" style="width: 400px">
        </div>
    </div>
</div>
@endsection
