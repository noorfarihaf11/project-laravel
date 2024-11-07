<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserActivity;
use DB;

class UserActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserActivity::create([
            'id_user' => '1',
            'description' => 'login',
            'status' => 'success',
            'menu_id' => '2'
        ]);
    }
}
