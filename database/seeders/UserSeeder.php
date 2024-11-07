<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
   
    public function run(): void
    {
        User::create([
            'name' => 'Sakhwa Ratifa',
            'email' => 'sakhwa@gmail.com',
            'username' => 'sakhwa',
            'password' => Hash::make('sakhwa'),
            'status_user' => 'success',
            'id_jenis_user' => '1'
        ]);
        
        User::create([
            'name' => 'Noor Fariha',
            'email' => 'farah@gmail.com',
            'username' => 'farah',
            'password' => Hash::make('farah'),
            'status_user' => 'success',
            'id_jenis_user' => '2'
        ]);
    
                        

    }
}