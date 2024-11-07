<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MenuUser;

class MenuUserSeeder extends Seeder
{
    public function run(): void
    {
        MenuUser::create([
            'id_jenis_user' => '1',
            'menu_id' => '1'
        ]);

        MenuUser::create([
            'id_jenis_user' => '1',
            'menu_id' => '2'
        ]);

        MenuUser::create([
            'id_jenis_user' => '1',
            'menu_id' => '3'
        ]);

        MenuUser::create([
            'id_jenis_user' => '1',
            'menu_id' => '4'
        ]);

        MenuUser::create([
            'id_jenis_user' => '1',
            'menu_id' => '5'
        ]);

        MenuUser::create([
            'id_jenis_user' => '1',
            'menu_id' => '6'
        ]);

        MenuUser::create([
            'id_jenis_user' => '2',
            'menu_id' => '1'
        ]);

        MenuUser::create([
            'id_jenis_user' => '2',
            'menu_id' => '2'
        ]);

        MenuUser::create([
            'id_jenis_user' => '2',
            'menu_id' => '3'
        ]);
    }
}
