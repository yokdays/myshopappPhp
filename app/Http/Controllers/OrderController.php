<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

        if ($product->stock <= 0) {
            return redirect()->route('shops.index')->with('error', 'สินค้าหมด!');
        }

        // ตรวจสอบสินค้าที่มีอยู่ในตะกร้า
        $orderDetail = OrderDetail::where('order_id', $order->id)
            ->where('product_id', $product->id)
            ->first();

        if ($orderDetail) {
            // คำนวณจำนวนที่เพิ่ม
            $newAmount = $orderDetail->amount + 1;

            // เช็คว่าสินค้าจะเพิ่มได้ไหม
            if ($product->stock > 0) {
                $orderDetail->amount = $newAmount; // ปรับจำนวน
                $orderDetail->save(); // บันทึกการเปลี่ยนแปลง
            } else {
                return redirect()->route('shops.index')->with('error', 'ไม่สามารถเพิ่มจำนวนสินค้าได้ เนื่องจากจำนวนสต็อกไม่เพียงพอ!');
            }
        } else {
            // สร้างรายการใหม่ถ้าไม่มีในตะกร้า
            $prepareCartDetail = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'amount' => 1,
                'price' => $product->Price,
                'image' => $product->image
            ];

            OrderDetail::create($prepareCartDetail);
        }

        // ลดจำนวนสต็อกหลังจากเพิ่มสินค้าในตะกร้า
        $product->stock -= 1;
        $product->save();

        return redirect()->route('shops.index')->with('success', 'เพิ่มสินค้าลงในตระกร้าสำเร็จ!');
    }

    public function checkout(Order $order)
    {
        return view('orders.checkout', compact('order'));
    }

    public function processCheckout(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'image' => 'required|image',
        ]);

        $order = Order::findOrFail($id);
        if ($request->hasFile('image')) {
            // อัปโหลดรูปภาพไปยัง disk 'public' ภายใต้โฟลเดอร์ 'images'
            $file = Storage::disk('public')->put('images/bills', $request->image);


            // บันทึก path ของรูปภาพใหม่ในฐานข้อมูล
            $order->customer_bill = $file;
        }

        $order->user_id = Auth::id();
        $order->customer_name = $request->name;
        $order->customer_address = $request->address;
        $order->status = 1;
        $order->save();


        return redirect()->route('shops.index')->with('success', 'สั่งซื้อสินค้าสำเร็จ!');
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
            $product = Product::find($orderDetail->product_id);

            if ($product->stock > 0) {
                $orderDetail->amount += 1; // เพิ่มจำนวนสินค้า
                $orderDetail->save(); // บันทึกการเปลี่ยนแปลง

                // ลดจำนวนสต็อก
                $product->stock -= 1;
                $product->save();

                // อัปเดตผลรวมราคาใหม่
                $order = Order::find($orderDetail->order_id);
                $this->updateOrderTotal($order); // เรียกใช้ฟังก์ชันเพื่ออัปเดตผลรวม

                return redirect()->back()->with('success', 'เพิ่มจำนวนสินค้าสำเร็จ!');
            } else {
                return redirect()->back()->with('error', 'สินค้าหมด ไม่สามารถเพิ่มจำนวนได้');
            }
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

                // เพิ่มจำนวนสต็อกคืน
                $product = Product::find($orderDetail->product_id);
                $product->stock += 1;
                $product->save();

                return redirect()->back()->with('success', 'ลดจำนวนสินค้าสำเร็จ!');
            } elseif ($orderDetail->amount == 1) {
                // หากจำนวนสินค้าลดเหลือ 0 ให้ลบรายการจากตะกร้า
                $product = Product::find($orderDetail->product_id);
                $product->stock += 1; // เพิ่มจำนวนสต็อกคืน
                $product->save();

                $orderDetail->delete(); // ลบสินค้าออกจากตะกร้า

                // อัปเดตผลรวมราคาใหม่
                $order = Order::find($orderDetail->order_id);
                $this->updateOrderTotal($order); // เรียกใช้ฟังก์ชันเพื่ออัปเดตผลรวม

                return redirect()->back()->with('success', 'ลบสินค้าจากตะกร้าสำเร็จ!');
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
        $allOrders = Order::where('status', 1)->get();
        return view('products.order', compact('allOrders'));
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
