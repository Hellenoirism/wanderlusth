<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->time('waktu')->after('tanggal_reservasi');
            $table->string('tujuan')->after('waktu');
            $table->integer('jumlah_penumpang')->after('tujuan');
        });
    }

    public function down(): void
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn(['waktu', 'tujuan', 'jumlah_penumpang']);
        });
    }
};