<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;
use App\Models\Producto;
use App\Models\User;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_lists_products_as_json()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        Producto::factory()->create(['name' => 'Libro A']);
        Producto::factory()->create(['name' => 'Libro B']);

        $response = $this->getJson('/api/productos');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Libro A'])
                 ->assertJsonFragment(['name' => 'Libro B']);
    }

    public function test_create_a_product_and_returns_json()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $data = [
            'name' => 'Nuevo Libro',
            'description' => '',
            'category' => 'Producto digital',
            'status' => 'Activo',
            'price' => 10000,
            'stock' => 100,
        ];

        $response = $this->postJson('/api/productos', $data);
        $response->assertStatus(200)->assertJsonFragment(['name' => 'Nuevo Libro']);

        $this->assertDatabaseHas('productos', ['name' => 'Nuevo Libro']);
    }

    public function test_fails_to_create_product_without_name()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $data = [
            'description' => 'Sin nombre',
            'category' => 'Novela',
            'status' => 'Activo',
        ];

        $response = $this->postJson('/api/productos', $data);

        $response->assertStatus(422)->assertJsonValidationErrors(['name']);
    }

    public function test_updates_a_product()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $producto = Producto::factory()->create(['name' => 'Nombre anterior del producto']);

        $response = $this->putJson("/api/productos/{$producto->id}", [
            'name' => 'Nombre nuevo del producto',
            'description' => $producto->description,
            'category' => $producto->category,
            'status' => $producto->status,
            'price' => $producto->price,
            'stock' => $producto->stock,
        ]);

        $response->assertStatus(200)->assertJsonFragment(['name' => 'Nombre nuevo del producto']);

        $this->assertDatabaseHas('productos', ['name' => 'Nombre nuevo del producto']);
    }

    public function test_soft_deletes_a_product()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        $producto = Producto::factory()->create(['status' => 'Activo']);
        $response = $this->deleteJson("/api/productos/{$producto->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['status' => 'Inactivo']);

        $this->assertDatabaseHas('productos', ['id' => $producto->id, 'status' => 'Inactivo']);
    }

    public function test_searches_products_by_name()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        Producto::factory()->create(['name' => 'Laravel Básico']);
        Producto::factory()->create(['name' => 'Spring Boot Avanzado']);

        $response = $this->getJson('/api/productos/search?name=laravel');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Laravel Básico'])
                 ->assertJsonMissing(['name' => 'Spring Boot Avanzado']);
    }

    public function test_returns_empty_search_results()
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        Producto::factory()->create(['name' => 'Laravel Básico']);
        $response = $this->getJson('/api/productos/search?name=python');

        $response->assertStatus(200)->assertExactJson([]);
    }
}