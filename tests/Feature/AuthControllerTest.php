<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

use RefreshDatabase;

public function testUserRegistration()
{

    $response = $this->postJson(route('register'), [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200);
}

public function testUserLogin()
{
    $response = $this->postJson(route('login'), [
        'email' => 'johndoe@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200);

}

 public function testUserLogout()
    {
        $user = User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->postJson(route('logout'), [], [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200); 
    }


}
