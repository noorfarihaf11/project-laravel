<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\MenuLevel; // Pastikan kelas MenuLevel di-import
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_level'=>MenuLevel::factory(),
            'menu_name' => fake()->name(),
            'menu_link' => fake()->name(),
            'menu_icon' => fake()->name(),
            'parent_id' => fake()->name(),
            'create_by' => fake()->name()
        ];
    }
}
