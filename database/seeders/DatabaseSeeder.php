<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kriteria;
use App\Models\Subkriteria;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Kosongkan tabel users
        \App\Models\User::truncate();
        // Create admin user
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);
        // User masyarakat
        User::create([
            'name' => 'Sistem Masyarakat',
            'username' => 'sm',
            'password' => bcrypt('password123'),
            'role' => 'masyarakat',
        ]);

        // Create kriteria
        $kriteria1 = Kriteria::create([
            'nama' => 'Pendapatan',
            'bobot' => 0.3,
            'tipe' => 'cost'
        ]);

        $kriteria2 = Kriteria::create([
            'nama' => 'Jumlah Tanggungan',
            'bobot' => 0.25,
            'tipe' => 'benefit'
        ]);

        $kriteria3 = Kriteria::create([
            'nama' => 'Kondisi Rumah',
            'bobot' => 0.2,
            'tipe' => 'cost'
        ]);

        $kriteria4 = Kriteria::create([
            'nama' => 'Pekerjaan',
            'bobot' => 0.15,
            'tipe' => 'benefit'
        ]);

        $kriteria5 = Kriteria::create([
            'nama' => 'Usia',
            'bobot' => 0.1,
            'tipe' => 'benefit'
        ]);

        // Create subkriteria for Pendapatan
        Subkriteria::create(['kriteria_id' => $kriteria1->id, 'nama' => 'Sangat Rendah', 'nilai' => 1]);
        Subkriteria::create(['kriteria_id' => $kriteria1->id, 'nama' => 'Rendah', 'nilai' => 2]);
        Subkriteria::create(['kriteria_id' => $kriteria1->id, 'nama' => 'Sedang', 'nilai' => 3]);
        Subkriteria::create(['kriteria_id' => $kriteria1->id, 'nama' => 'Tinggi', 'nilai' => 4]);
        Subkriteria::create(['kriteria_id' => $kriteria1->id, 'nama' => 'Sangat Tinggi', 'nilai' => 5]);

        // Create subkriteria for Jumlah Tanggungan
        Subkriteria::create(['kriteria_id' => $kriteria2->id, 'nama' => '1-2 Orang', 'nilai' => 5]);
        Subkriteria::create(['kriteria_id' => $kriteria2->id, 'nama' => '3-4 Orang', 'nilai' => 4]);
        Subkriteria::create(['kriteria_id' => $kriteria2->id, 'nama' => '5-6 Orang', 'nilai' => 3]);
        Subkriteria::create(['kriteria_id' => $kriteria2->id, 'nama' => '7-8 Orang', 'nilai' => 2]);
        Subkriteria::create(['kriteria_id' => $kriteria2->id, 'nama' => '9+ Orang', 'nilai' => 1]);

        // Create subkriteria for Kondisi Rumah
        Subkriteria::create(['kriteria_id' => $kriteria3->id, 'nama' => 'Sangat Baik', 'nilai' => 1]);
        Subkriteria::create(['kriteria_id' => $kriteria3->id, 'nama' => 'Baik', 'nilai' => 2]);
        Subkriteria::create(['kriteria_id' => $kriteria3->id, 'nama' => 'Sedang', 'nilai' => 3]);
        Subkriteria::create(['kriteria_id' => $kriteria3->id, 'nama' => 'Kurang', 'nilai' => 4]);
        Subkriteria::create(['kriteria_id' => $kriteria3->id, 'nama' => 'Sangat Kurang', 'nilai' => 5]);

        // Create subkriteria for Pekerjaan
        Subkriteria::create(['kriteria_id' => $kriteria4->id, 'nama' => 'PNS', 'nilai' => 5]);
        Subkriteria::create(['kriteria_id' => $kriteria4->id, 'nama' => 'Swasta', 'nilai' => 4]);
        Subkriteria::create(['kriteria_id' => $kriteria4->id, 'nama' => 'Wirausaha', 'nilai' => 3]);
        Subkriteria::create(['kriteria_id' => $kriteria4->id, 'nama' => 'Buruh', 'nilai' => 2]);
        Subkriteria::create(['kriteria_id' => $kriteria4->id, 'nama' => 'Tidak Bekerja', 'nilai' => 1]);

        // Create subkriteria for Usia
        Subkriteria::create(['kriteria_id' => $kriteria5->id, 'nama' => '18-30 Tahun', 'nilai' => 5]);
        Subkriteria::create(['kriteria_id' => $kriteria5->id, 'nama' => '31-40 Tahun', 'nilai' => 4]);
        Subkriteria::create(['kriteria_id' => $kriteria5->id, 'nama' => '41-50 Tahun', 'nilai' => 3]);
        Subkriteria::create(['kriteria_id' => $kriteria5->id, 'nama' => '51-60 Tahun', 'nilai' => 2]);
        Subkriteria::create(['kriteria_id' => $kriteria5->id, 'nama' => '60+ Tahun', 'nilai' => 1]);

        // Create sample masyarakat data
        \App\Models\Masyarakat::create([
            'nama' => 'Ahmad Supriadi',
            'nik' => '3273010101990001',
            'alamat' => 'Jl. Sudirman No. 123, Jakarta',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1990-01-01',
            'penghasilan' => 1500000,
            'jumlah_tanggungan' => 3,
            'kondisi_rumah' => 'Kurang Layak',
            'status_pekerjaan' => 'Tidak Tetap',
            'pendidikan' => 'SMA',
            'akses_kesehatan' => 1,
        ]);

        \App\Models\Masyarakat::create([
            'nama' => 'Siti Nurhaliza',
            'nik' => '3273010201990002',
            'alamat' => 'Jl. Thamrin No. 456, Jakarta',
            'jenis_kelamin' => 'P',
            'tanggal_lahir' => '1985-05-15',
            'penghasilan' => 1000000,
            'jumlah_tanggungan' => 4,
            'kondisi_rumah' => 'Tidak Layak',
            'status_pekerjaan' => 'Pengangguran',
            'pendidikan' => 'SD',
            'akses_kesehatan' => 0,
        ]);

        \App\Models\Masyarakat::create([
            'nama' => 'Budi Santoso',
            'nik' => '3273010301990003',
            'alamat' => 'Jl. Gatot Subroto No. 789, Jakarta',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '1988-12-20',
            'penghasilan' => 2000000,
            'jumlah_tanggungan' => 2,
            'kondisi_rumah' => 'Layak',
            'status_pekerjaan' => 'Tetap',
            'pendidikan' => 'S1',
            'akses_kesehatan' => 1,
        ]);
    }
}
