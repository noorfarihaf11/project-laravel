<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\JenisUser;
use App\Models\Post;
use App\Models\Menu;
use App\Models\MenuUser;
use App\Models\MenuLevel;
use App\Models\UserActivity;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            JenisUserSeeder::class,
            UserSeeder::class, 
            MenuLevelSeeder::class,
            MenuSeeder::class,
            MenuUserSeeder::class,
            // UserActivity::class
        ]);
        
        // Ambil data setelah seeding
        $categories = Category::all();
        $users = User::all();
        $posts = Post::all();
        $menus = Menu::all();
        $menuUsers = MenuUser::all();
    
        // Lakukan apa pun yang perlu dilakukan dengan data yang diperoleh
    }
}
