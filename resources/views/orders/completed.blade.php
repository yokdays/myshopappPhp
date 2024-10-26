@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Completed Orders</h1>
        @if ($completedOrders->isEmpty())
            <p>No completed orders.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Product Names and Quantities</th> <!-- เพิ่มคอลัมน์สำหรับชื่อสินค้าและจำนวน -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($completedOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->total }}</td>
                            <td>Completed</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                @foreach ($order->order_details as $detail)
                                    {{ $detail->product_name }} ({{ $detail->amount }})<br> <!-- แสดงชื่อสินค้าและจำนวน -->
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
