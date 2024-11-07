<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuLevel;
use DB;

class MenuLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuLevel::create([
            'level' => '1'
        ]);

        MenuLevel::create([
            'level' => '2'
        ]);
    }
}
