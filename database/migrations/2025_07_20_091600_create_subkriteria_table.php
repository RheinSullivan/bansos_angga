<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubkriteriaTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('subkriteria', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke kriteria
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            
            // Nama subkriteria
            $table->string('nama');
            
            // Nilai subkriteria
            $table->float('nilai');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('subkriteria');
    }
}
