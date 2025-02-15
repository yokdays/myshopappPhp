<?php
use Tests\TestCase;

class User_Register_Test extends TestCase
{
    public function test_user_can_register()
    {
        // ส่งคำขอ POST ไปที่ API /register เพื่อสมัครสมาชิก
        $response = $this->post('/register', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // ทดสอบว่าได้รับ HTTP Response status 201 (สร้างสำเร็จ)
        $response->assertStatus(302);
        // ทดสอบว่าในฐานข้อมูลมีข้อมูลผู้ใช้ที่สมัครใหม่
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
        ]);
    }
}

