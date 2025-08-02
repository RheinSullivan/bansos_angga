<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    // Nama tabel di database
    protected $table = 'kriteria';

    // Kolom-kolom yang boleh diisi mass-assignment
    protected $fillable = ['nama', 'bobot', 'tipe'];

    // Relasi ke subkriteria (satu kriteria punya banyak subkriteria)
    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }
}
