<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ดึงคำสั่งซื้อสำหรับผู้ใช้ที่เข้าสู่ระบบ
        $order = Order::where('user_id', Auth::id())->where('status', 0)->first();

        // ตรวจสอบว่ามีคำสั่งซื้อหรือไม่
        if (!$order) {
            return view('orders.index')->with('message', 'ไม่มีคำสั่งซื้อในตระกร้า');
        }
        $this->updateOrderTotal($order);
        // ส่งคำสั่งซื้อไปยัง view
        return view('orders.index')->with('order', $order);
    }
    public function __construct()
    {
        $this->middleware('auth'); // ตรวจสอบว่า user ต้อง login
    }
    public function completed()
    {
        // ดึงรายการคำสั่งซื้อที่เสร็จสมบูรณ์ (status = 1) ของผู้ใช้ที่เข้าสู่ระบบ
        $completedOrders = Order::where('user_id', Auth::id())->where('status', 1)->get();

        // ส่งคำสั่งซื้อไปยัง view
        return view('orders.completed', compact('completedOrders'));
    }

    public static function getCartItemCount()
    {
        // ค้นหาคำสั่งซื้อที่มี status = 0 (ยังไม่ได้ Checkout) ของผู้ใช้ที่ล็อกอิน
        $order = Order::where('user_id', Auth::id())->where('status', 0)->first();

        // ถ้าไม่มีคำสั่งซื้อส่งกลับค่า 0
        if (!$order) {
            return 0;
        }

        // นับจำนวนสินค้าในตะกร้าจาก order_details
        return $order->order_details->sum('amount');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($item)
    {

        // การจัดการคำสั่งซื้อ
        $order = Order::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 0],
            ['status' => 0]
        );

        $product = Product::find($item);

        // ตรวจสอบสินค้าที่มีอยู่ในตะกร้า
        $orderDetail = OrderDetail::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        if ($orderDetail) {
            // ถ้ามีอยู่แล้ว เพิ่มจำนวน
            $orderDetail->amount += 1;
            $orderDetail->save();
        } else {
            // สร้างรายการใหม่ถ้าไม่มี
            $prepareCartDetail = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'amount' => 1,
                'Price' => $product->Price // ตั้งค่า default เป็น 0 หาก price เป็น null
            ];

            // Call this method after updating items in the cart
            OrderDetail::create($prepareCartDetail);
        }
        // คำนวณราคารวม

        return redirect()->route('shops.index')->with('success', 'เพิ่มสินค้าลงในตระกร้าสำเร็จ!');
    }


    private function updateOrderTotal(Order $order)
    {
        $total = $order->order_details->reduce(function ($carry, $orderDetail) {
            return $carry + ($orderDetail->amount * $orderDetail->price);
        }, 0);

        // อัปเดตคำสั่งซื้อ
        $order->update(['total' => $total]);
    }
    // เพิ่มฟังก์ชันเพื่อเพิ่มจำนวนสินค้า
    public function increaseQuantity($orderDetailId)
    {
        $orderDetail = OrderDetail::find($orderDetailId);

        if ($orderDetail) {
            $orderDetail->amount += 1; // เพิ่มจำนวนสินค้า
            $orderDetail->save(); // บันทึกการเปลี่ยนแปลง

            // คำนวณผลรวมราคาใหม่
            $order = Order::find($orderDetail->order_id);
            $this->updateOrderTotal($order); // เรียกใช้ฟังก์ชันเพื่ออัปเดตผลรวม
            // Call this method after updating items in the cart
            return redirect()->back()->with('success', 'เพิ่มจำนวนสินค้าสำเร็จ!');
        }

        return redirect()->back()->with('error', 'ไม่พบสินค้าที่ต้องการเพิ่มจำนวน');
    }

    public function decreaseQuantity($orderDetailId)
    {
        $orderDetail = OrderDetail::find($orderDetailId);

        if ($orderDetail) {
            if ($orderDetail->amount > 1) {
                $orderDetail->amount -= 1; // ลดจำนวนสินค้า
                $orderDetail->save(); // บันทึกการเปลี่ยนแปลง

                // คำนวณผลรวมราคาใหม่
                $order = Order::find($orderDetail->order_id);
                $this->updateOrderTotal($order); // เรียกใช้ฟังก์ชันเพื่ออัปเดตผลรวม
                // Call this method after updating items in the cart
                return redirect()->back()->with('success', 'ลดจำนวนสินค้าสำเร็จ!');
            } else {
                return redirect()->back()->with('error', 'ไม่สามารถลดจำนวนสินค้าได้');
            }
        }

        return redirect()->back()->with('error', 'ไม่พบสินค้าที่ต้องการลดจำนวน');
    }

    public function updateProductNames(Order $order)
    {
        $productNames = $order->order_details->pluck('product_name')->implode(', ');
        $order->update(['product_names' => $productNames]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        if ($request->value === "checkout") {
            $order->update([
                'status' => 1
            ]);

            // เรียกใช้ฟังก์ชัน updateProductNames เพื่ออัปเดตชื่อสินค้า
            $this->updateProductNames($order);
        }
        return redirect()->route('shops.index')->with('success', 'สั่งซื้อสินค้าสำเร็จ!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
