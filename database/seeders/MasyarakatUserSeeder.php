<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Masyarakat;

class MasyarakatUserSeeder extends Seeder
{
    public function run()
    {
        // Create masyarakat users based on existing masyarakat data
        $masyarakatList = Masyarakat::all();
        
        foreach ($masyarakatList as $masyarakat) {
            User::create([
                'name' => $masyarakat->nama,
                'username' => $masyarakat->nik,
                'password' => bcrypt('password'),
                'role' => 'masyarakat',
            ]);
        }
    }
} 