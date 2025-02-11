<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $search = $request->search;
        if ($search != '') {
            $products = Product::where('name', 'like', '%' . $search . '%')->orWhere('price', 'like', '%' . $search . '%')->paginate(9);
        } else {
            $products = Product::paginate(9);
        }
        return view('products.index')->with('products',$products);

        // return view('products.index',[
        //     'products' => $products,
        // ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // store product
        $file = Storage::disk('public')->put('images', $request->image);
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required'
        ]);
        $product = new Product;
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->user_id = Auth::id();
        $product->image = $file;
        $product->product_type = $request->product_type;
        $product->save();

        return redirect()->route('products.index')->with('success','Product has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // ตรวจสอบการอัปโหลดรูปภาพและฟิลด์ข้อมูลที่จำเป็น
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'stock' => 'required'// ตรวจสอบไฟล์รูปภาพ
        ]);

        // ค้นหา Product ตาม ID
        $product = Product::findOrFail($id); // ใช้ findOrFail เพื่อจัดการกรณีไม่พบข้อมูล

        // เช็กว่ามีการอัปโหลดรูปภาพใหม่หรือไม่
        if ($request->hasFile('image')) {
            // อัปโหลดรูปภาพไปยัง disk 'public' ภายใต้โฟลเดอร์ 'images'
            $file = $request->file('image')->store('images', 'public');

            // บันทึก path ของรูปภาพใหม่ในฐานข้อมูล
            $product->image = $file;
        }

        // อัปเดตข้อมูล product
        $product->name = $request->name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->user_id = Auth::id();

        // บันทึกการอัปเดต
        $product->save();

        // ส่งผู้ใช้กลับไปยังหน้าที่ต้องการหลังจากอัปเดตสำเร็จ
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // ค้นหาสินค้าตามชื่อหรือหมวดหมู่
        $productsGrouped = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('product_type', 'LIKE', "%{$query}%")
            ->get()
            ->groupBy('product_type');

        return view('shops.index', compact('productsGrouped'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product delete successfully.');

    }
}
