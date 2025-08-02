<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Masyarakat;

class MasyarakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create sample masyarakat data
        Masyarakat::create([
            'nama' => 'Ahmad Supriadi',
            'nik' => '3273010101990001',
            'alamat' => 'Jl. Sudirman No. 123, Jakarta',
            'tanggal_lahir' => '1990-01-01',
            'penghasilan' => 1500000,
            'jumlah_tanggungan' => 3,
            'kondisi_rumah' => 'Layak',
            'status_pekerjaan' => 'Tetap',
            'pendidikan' => 'SMA',
            'akses_kesehatan' => true,
            'kepemilikan_aset' => json_encode(['motor']),
            'usia' => 33,
        ]);

        Masyarakat::create([
            'nama' => 'Siti Nurhaliza',
            'nik' => '3273010201990002',
            'alamat' => 'Jl. Thamrin No. 456, Jakarta',
            'tanggal_lahir' => '1985-05-15',
            'penghasilan' => 800000,
            'jumlah_tanggungan' => 5,
            'kondisi_rumah' => 'Kurang Layak',
            'status_pekerjaan' => 'Tidak Tetap',
            'pendidikan' => 'SMP',
            'akses_kesehatan' => false,
            'kepemilikan_aset' => json_encode([]),
            'usia' => 38,
        ]);

        Masyarakat::create([
            'nama' => 'Budi Santoso',
            'nik' => '3273010301990003',
            'alamat' => 'Jl. Gatot Subroto No. 789, Jakarta',
            'tanggal_lahir' => '1988-12-20',
            'penghasilan' => 2500000,
            'jumlah_tanggungan' => 2,
            'kondisi_rumah' => 'Layak',
            'status_pekerjaan' => 'Tetap',
            'pendidikan' => 'S1',
            'akses_kesehatan' => true,
            'kepemilikan_aset' => json_encode(['motor', 'tanah']),
            'usia' => 35,
        ]);

        Masyarakat::create([
            'nama' => 'Dewi Sartika',
            'nik' => '3273010401990004',
            'alamat' => 'Jl. Merdeka No. 101, Jakarta',
            'tanggal_lahir' => '1992-08-10',
            'penghasilan' => 1200000,
            'jumlah_tanggungan' => 4,
            'kondisi_rumah' => 'Layak',
            'status_pekerjaan' => 'Tetap',
            'pendidikan' => 'SMA',
            'akses_kesehatan' => true,
            'kepemilikan_aset' => json_encode(['motor']),
            'usia' => 31,
        ]);

        Masyarakat::create([
            'nama' => 'Rudi Hartono',
            'nik' => '3273010501990005',
            'alamat' => 'Jl. Pancasila No. 202, Jakarta',
            'tanggal_lahir' => '1987-03-25',
            'penghasilan' => 600000,
            'jumlah_tanggungan' => 6,
            'kondisi_rumah' => 'Tidak Layak',
            'status_pekerjaan' => 'Pengangguran',
            'pendidikan' => 'SD',
            'akses_kesehatan' => false,
            'kepemilikan_aset' => json_encode([]),
            'usia' => 36,
        ]);
    }
}
