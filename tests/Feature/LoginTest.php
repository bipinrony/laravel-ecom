<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        // case for validation
        $response = $this->post('/login');
        $response->assertInvalid([
            'email' => 'The email field is required.',
            'password' => 'The password field is required.',
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/');

        // for invalid email
        $response = $this->post('/login', ['email' => 'test@test.com', 'password' => 'test@test.com']);
        $response->assertInvalid([
            'email' => 'The selected email is invalid',
        ]);
        $response->assertStatus(302);

        // for invalid creds
        $response = $this->post(
            '/login',
            ['email' => 'demo@yopmail.com', 'password' => 'test@test.com']
        );
        $response->assertStatus(302);
        $response->assertRedirect('/login');

        // for invalid creds
        $response = $this->post(
            '/login',
            ['email' => 'demo@yopmail.com', 'password' => '123456']
        );
        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
