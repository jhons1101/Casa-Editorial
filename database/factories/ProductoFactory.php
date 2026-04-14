<?php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    protected $model = Producto::class;

    public function definition()
    {
        return [
            'name'        => $this->faker->words(3, true),
            'description' => $this->faker->sentence(10),
            'category'    => $this->faker->randomElement(['Producto físico', 'Producto digital']),
            'status'      => $this->faker->randomElement(['Activo', 'Inactivo']),
            'price'       => $this->faker->randomFloat(2, 1000, 50000),
            'stock'       => $this->faker->numberBetween(0, 1000),
        ];
    }
}
