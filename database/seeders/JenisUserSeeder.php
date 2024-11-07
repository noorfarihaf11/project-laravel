<?php

namespace Database\Seeders;

use App\Models\JenisUser;
use Illuminate\Database\Seeder;

class JenisUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisUser::create([
            'name' => 'Administrator'

        ]);
        JenisUser::create([
            'name' => 'Dosen'

        ]);
        JenisUser::create([
            'name' => 'Mahasiswa'

        ]);
            
    }
}
