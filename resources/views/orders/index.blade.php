@extends('layouts.app')

@section('content')
<div class="container">
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (isset($order))
        @if ($order->order_details->isEmpty())
            <p>ไม่มีข้อมูลในตะกร้า</p>
        @else
            <table class="table table-striped table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>รูปสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคาเดี่ยว</th>
                        <th>จำนวน</th>
                        <th>ราคารวม</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_details as $item)

                    <tr>
                        <td style="width: 15%;"><img src="{{ asset('storage/' . $item->image) }}" alt="" style="width: 10rem"></td>
                        <td>{{ $item->product_name }}</td>
                        <td>฿{{ number_format($item->price, 2) }}</td>
                        <td>
                            <form action="{{ route('order-details.decrease', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm">-</button>
                            </form>
                            {{ $item->amount }}
                            <form action="{{ route('order-details.increase', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm">+</button>
                            </form>
                        </td>
                        <td>฿{{ number_format($item->price * $item->amount, 2) }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <form action="{{ route('orders.checkout', $order->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="value" value="checkout">
                                <button class="btn btn-outline-primary" type="submit">ยืนยันคำสั่งซื้อ</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="order-total">
                <h1>สรุปยอดรวม</h1>
                <h2>฿ {{ number_format($order->total, 2) }}</h2>
            </div>
        @endif
    @else
        <p>{{ $message ?? 'ไม่มีคำสั่งซื้อในตระกร้า' }}</p>
    @endif
</div>
@endsection
