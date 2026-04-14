<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registers_a_new_user_and_returns_token()
    {
        $response = $this->postJson('/api/register', [
            'name' => 'Stiven',
            'email' => 'stiven.vargas@example.com',
            'password' => '123456',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'user' => ['id', 'name', 'email'],
                     'token'
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'stiven.vargas@example.com',
        ]);
    }

    public function test_logs_in_existing_user_and_returns_token()
    {
        $user = User::create([
            'name' => 'Stiven',
            'email' => 'stiven.vargas@example.com',
            'password' => Hash::make('123456'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'stiven.vargas@example.com',
            'password' => '123456',
        ]);

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'user' => ['id', 'name', 'email'],
                     'token'
                 ]);
    }

    public function test_logs_out_authenticated_user()
    {
        $user = User::create([
            'name' => 'Stiven',
            'email' => 'stiven.vargas@example.com',
            'password' => Hash::make('123456'),
        ]);

        $token = $user->createToken('api-token')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->postJson('/api/logout');

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Sesión cerrada correctamente',
                 ]);
    }

    public function test_fails_to_register_with_duplicate_email()
    {
        User::create([
            'name' => 'Stiven',
            'email' => 'stiven.vargas@example.com',
            'password' => Hash::make('123456'),
        ]);

        $response = $this->postJson('/api/register', [
            'name' => 'John Stiven Vargas',
            'email' => 'stiven.vargas@example.com', // Usuario con email ya existente
            'password' => 'secret',
        ]);

        $response->assertStatus(422)->assertJsonValidationErrors(['email']);
    }

    public function test_fails_to_login_with_invalid_password()
    {
        User::create([
            'name' => 'Stiven',
            'email' => 'stiven.vargas@example.com',
            'password' => Hash::make('123456'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'stiven.vargas@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'Credenciales inválidas',
                 ]);
    }

    public function test_fails_to_login_with_not_existent_user()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'usuarionoexiste@example.com',
            'password' => '123456',
        ]);

        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'Credenciales inválidas',
                 ]);
    }
}