@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Completed Orders</h1>
        @if ($allOrders->isEmpty())
            <p>No completed orders.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>รหัสคำสั่งซื้อ</th>
                        <th>รหัสลูกค้า</th>
                        <th>สินค้า (จำนวน)</th> <!-- เพิ่มคอลัมน์สำหรับชื่อสินค้าและจำนวน -->
                        <th>ราคารวมทั้งสิ้น</th>
                        <th>วันที่อัพเดทล่าสุด</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($allOrders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user_id }}</td>
                            <td>
                                @foreach ($order->order_details as $detail)
                                    {{ $detail->product_name }} ({{ $detail->amount }})<br> <!-- แสดงชื่อสินค้าและจำนวน -->
                                @endforeach
                            </td>
                            <td>{{ $order->total }}</td>
                            <td>{{ $order->updated_at }}</td>
                            <td>
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <label for="status">สถานะคำสั่งซื้อ: @switch($order->status_id)
                                        @case(1)
                                            กำลังตรวจสอบ
                                        @break

                                        @case(2)
                                            กำลังดำเนินการ
                                        @break
                                        @case(3)
                                            กำลังจัดส่ง
                                        @break
                                        @case(4)
                                            จัดส่งสำเร็จ
                                        @break
                                    @endswitch</label>
                                    <select name="status_id" id="status" class="form-control">
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status->id }}"
                                                {{ $order->status_id == $status->id ? 'selected' : '' }}>
                                                {{ $status->status_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit" class="btn btn-success mt-2">Update Status</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
