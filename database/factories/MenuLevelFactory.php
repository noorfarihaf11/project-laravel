<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\MenuLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\menu_level>
 */
class MenuLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'level' => fake()->name(),
        ];
    }
}
