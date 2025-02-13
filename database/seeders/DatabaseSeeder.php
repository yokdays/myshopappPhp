<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // เพิ่มข้อมูลลงในตาราง users
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('user'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('user'),
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // เพิ่มข้อมูลลงในตาราง products
        DB::table('products')->insert([
            [
                'name' => 'เนื้อวัวสไลซ์',
                'price' => 250.00,
                'user_id' => 1,
                'image' => 'beef_slice.jpg',
                'stock' => 100,
                'product_type' => 'Cow',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'หมูสามชั้น',
                'price' => 150.00,
                'user_id' => 1,
                'image' => 'pork_belly.jpg',
                'stock' => 50,
                'product_type' => 'Pig',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ไก่ย่าง',
                'price' => 120.00,
                'user_id' => 2,
                'image' => 'grilled_chicken.jpg',
                'stock' => 80,
                'product_type' => 'Chicken',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'ปลาทอด',
                'price' => 180.00,
                'user_id' => 2,
                'image' => 'fried_fish.jpg',
                'stock' => 60,
                'product_type' => 'Fish',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);

        // เพิ่มข้อมูลลงในตาราง order_status
        DB::table('order_status')->insert([
            ['status_name' => 'Pending', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'Processing', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'Shipped', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'Delivered', 'created_at' => now(), 'updated_at' => now()],
            ['status_name' => 'Cancelled', 'created_at' => now(), 'updated_at' => now()],
        ]);

        DB::table('products')->insert([
            ['id' => 9, 'name' => 'เนื้อสันใน (Tenderloin)', 'price' => 325.00, 'user_id' => 2, 'image' => 'images/AkV5KHX6Da46b9UT4FmKj5aQte9CB8ivWrM9eXsy.jpg', 'stock' => 100, 'product_type' => 'cow', 'created_at' => Carbon::parse('2025-02-09 08:31:43'), 'updated_at' => Carbon::parse('2025-02-11 13:49:43')],
            ['id' => 10, 'name' => 'เนื้อสันนอก (Striploin)', 'price' => 320.00, 'user_id' => 2, 'image' => 'images/m919j86M6oJxM5JlSLW6cI21IaRrjou8jL4nD8bh.jpg', 'stock' => 100, 'product_type' => 'cow', 'created_at' => Carbon::parse('2025-02-09 08:32:49'), 'updated_at' => Carbon::parse('2025-02-11 13:40:38')],
            ['id' => 11, 'name' => 'เนื้อริบอาย (Ribeye)', 'price' => 420.00, 'user_id' => 2, 'image' => 'images/BdXrga7qt0O0iAfiwZVtVh8daLmbG53PEgTorpyD.jpg', 'stock' => 100, 'product_type' => 'cow', 'created_at' => Carbon::parse('2025-02-09 08:33:19'), 'updated_at' => Carbon::parse('2025-02-11 13:40:39')],
            ['id' => 12, 'name' => 'เนื้อสะโพก (Round)', 'price' => 295.00, 'user_id' => 2, 'image' => 'images/cFeFdxKpqcM8zdnRwNtHRczhdLvteJv46tvwdV3x.jpg', 'stock' => 100, 'product_type' => 'cow', 'created_at' => Carbon::parse('2025-02-09 08:33:42'), 'updated_at' => Carbon::parse('2025-02-11 13:50:00')],
            ['id' => 13, 'name' => 'เนื้อสันคอหรือสันไหล่ (Chuck)', 'price' => 425.00, 'user_id' => 2, 'image' => 'images/0cTvTXvkZT4xoPr846b5fTqr7P7s8kQcgzKCeriB.jpg', 'stock' => 100, 'product_type' => 'cow', 'created_at' => Carbon::parse('2025-02-09 08:34:08'), 'updated_at' => Carbon::parse('2025-02-11 13:50:05')],
            ['id' => 14, 'name' => 'ใบพาย (Oyster blade)', 'price' => 380.00, 'user_id' => 2, 'image' => 'images/OBVquB0GAou7TVd7vWWj27GJXlLilejkwi1NwLrc.jpg', 'stock' => 100, 'product_type' => 'cow', 'created_at' => Carbon::parse('2025-02-09 08:34:40'), 'updated_at' => Carbon::parse('2025-02-09 08:34:40')],
            ['id' => 15, 'name' => 'เนื้อเสือร้องไห้ (Brisket)', 'price' => 460.00, 'user_id' => 2, 'image' => 'images/66WBKZmGuZnkOtWgfDxdWQ8O8ObDYsLSBdcBQ58W.jpg', 'stock' => 100, 'product_type' => 'cow', 'created_at' => Carbon::parse('2025-02-09 08:35:09'), 'updated_at' => Carbon::parse('2025-02-09 08:35:09')],
            ['id' => 16, 'name' => 'เนื้อซี่โครง (Short Ribs)', 'price' => 350.00, 'user_id' => 2, 'image' => 'images/oqS1T1lVvYFOgLWjWz4TDKnorFyKzr4beQ7VLRlu.jpg', 'stock' => 100, 'product_type' => 'cow', 'created_at' => Carbon::parse('2025-02-09 08:35:44'), 'updated_at' => Carbon::parse('2025-02-09 08:35:44')],
        ]);


    }
}
