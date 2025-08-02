<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subkriteria extends Model
{
    // Nama tabel
    protected $table = 'subkriteria';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'kriteria_id',
        'nama',
        'nilai',
    ];

    /**
     * Relasi ke model Kriteria.
     * Setiap subkriteria milik satu kriteria.
     */
    public function kriteria(): BelongsTo
    {
        return $this->belongsTo(Kriteria::class);
    }
}
