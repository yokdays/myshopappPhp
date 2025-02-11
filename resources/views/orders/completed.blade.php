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
                        <th>รหัสคำสั่งซื้อ</th>
                        <th>สถานะคำสั่งซื้อ</th>
                        <th>สินค้า (จำนวน)</th> <!-- เพิ่มคอลัมน์สำหรับชื่อสินค้าและจำนวน -->
                        <th>ราคารวมทั้งสิ้น</th>
                        <th>วันที่อัพเดทล่าสุด</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($completedOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>

                            @switch($order->status_id)
                                @case(1)
                                    <td>กำลังตรวจสอบ</td>
                                @break

                                @case(2)
                                    <td>กำลังดำเนินการ</td>
                                @break
                                @case(3)
                                    <td>กำลังจัดส่ง</td>
                                @break
                                @case(4)
                                    <td>จัดส่งสำเร็จ</td>
                                @break
                            @endswitch
                            <td>
                                @foreach ($order->order_details as $detail)
                                    {{ $detail->product_name }} ({{ $detail->amount }})<br> <!-- แสดงชื่อสินค้าและจำนวน -->
                                @endforeach
                            </td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
