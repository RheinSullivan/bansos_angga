<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('masyarakat', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('nik', 20)->unique();
            $table->text('alamat');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->unsignedInteger('penghasilan');
            $table->unsignedTinyInteger('jumlah_tanggungan');
            $table->enum('kondisi_rumah', ['Layak', 'Kurang Layak', 'Tidak Layak']);
            $table->enum('status_pekerjaan', ['Pengangguran', 'Tidak Tetap', 'Tetap']);
            $table->enum('pendidikan', ['Tidak Sekolah', 'SD', 'SMP', 'SMA', 'Diploma', 'S1']);
            $table->boolean('akses_kesehatan'); // 1 = punya BPJS, 0 = tidak
            $table->json('kepemilikan_aset')->nullable(); // Contoh: ["motor", "tanah"]
            $table->unsignedTinyInteger('usia')->nullable(); // Boleh dihitung otomatis dari tanggal_lahir
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('masyarakat');
    }
};
