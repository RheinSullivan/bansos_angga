<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    use HasFactory;

    protected $table = 'masyarakat';

    protected $fillable = [
        'nama',
        'nik',
        'alamat',
        'tanggal_lahir',
        'no_telepon',
        'jumlah_tanggungan',
        'kondisi_rumah',
        'status_pekerjaan',
        'pendidikan',
        'akses_kesehatan',
        'kepemilikan_aset',
        'usia',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'kepemilikan_aset' => 'array',
        'akses_kesehatan' => 'boolean',
    ];
}
