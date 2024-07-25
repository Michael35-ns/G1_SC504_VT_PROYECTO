<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presupuesto>
 */
class PresupuestoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // "id_presupuesto" => fake()->unique()->numberBetween(1, 30),
            "monto_total" => fake()->numberBetween(500000, 20000000),
            "id_usuario" => fake()->unique()->numberBetween(1, 30),
            "usuario_reg" => fake()->passthrough("usuario_reg"),
            "accion" => fake()->randomElement(["get", "post"]),
            "id_estado" => fake()->numberBetween(2, 4)
        ];
    }

    // public function unverified(): static
    // {
    //     return $this->state(fn(array $attributes) => [
    //         ''
    //     ]);
    // }
}
