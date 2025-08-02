<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNoTeleponToMasyarakatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
{
    Schema::table('masyarakat', function (Blueprint $table) {
        $table->string('no_telepon', 20)->nullable()->after('alamat');
    });
}

public function down(): void
{
    Schema::table('masyarakat', function (Blueprint $table) {
        $table->dropColumn('no_telepon');
    });
}
}
