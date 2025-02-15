<?php

use Tests\TestCase;

class User_Login_Test extends TestCase
{
    public function test_user_can_login()
    {
        $response = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);
    }
}


