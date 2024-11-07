<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Menu::create([
            'id_level' => '1',
            'menu_name' => 'Dashboard',
            'menu_link' => 'dashboard',
            'menu_icon' => 'bi bi-house-heart',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);
            
        Menu::create([
            'id_level' => '1',
            'menu_name' => 'My Posts',
            'menu_link' => 'dashboard/posts',
            'menu_icon' => 'bi bi-file-earmark-richtext ',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);

        Menu::create([
            'id_level' => '1',
            'menu_name' => 'Back to Home Page',
            'menu_link' => 'home',
            'menu_icon' => 'bi bi-box-arrow-left',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);

        Menu::create([
            'id_level' => '2',
            'menu_name' => 'Post Categories',
            'menu_link' => 'dashboard/categories',
            'menu_icon' => 'bi bi-folder-symlink',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);

        Menu::create([
            'id_level' => '2',
            'menu_name' => 'Master Menu',
            'menu_link' => 'dashboard/menu',
            'menu_icon' => 'bi bi-grid-1x2',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);

        Menu::create([
            'id_level' => '2',
            'menu_name' => 'Master User',
            'menu_link' => 'dashboard/useroperations',
            'menu_icon' => 'bi bi-person-workspace',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);

        Menu::create([
            'id_level' => '2',
            'menu_name' => 'Master Role',
            'menu_link' => 'dashboard/role',
            'menu_icon' => 'bi bi-people',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);

        Menu::create([
            'id_level' => '2',
            'menu_name' => 'Setting Menu User',
            'menu_link' => 'dashboard/settingmenu',
            'menu_icon' => 'bi bi-person-gear',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);

        Menu::create([
            'id_level' => '1',
            'menu_name' => 'Emiten',
            'menu_link' => 'dashboard/emiten',
            'menu_icon' => 'bi bi-cash-coin',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);
        
        Menu::create([
            'id_level' => '1',
            'menu_name' => 'Transaksi Harian',
            'menu_link' => 'dashboard/transaksiharian',
            'menu_icon' => 'bi bi-file-bar-graph',
            'parent_id' => '0',
            'create_by' => 'admin'
        ]);



        

        
            
    }
}
