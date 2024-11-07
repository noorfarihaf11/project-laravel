<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Web Design',
            'color' => 'blue'

        ]);

        Category::create([
            'name' => 'UI UX',
            'color' => 'green'
            
        ]);

        Category::create([
            'name' => 'Machine Learning',
            'color' => 'yellow'
            
        ]);

        Category::create([
            'name' => 'Data Structure',
            'color' => 'pink'
            
        ]);
    }
}
