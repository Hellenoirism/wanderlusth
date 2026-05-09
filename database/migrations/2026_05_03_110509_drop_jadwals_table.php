<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::dropIfExists('jadwals');
    }

    public function down(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id('id_jadwal');
            $table->unsignedBigInteger('id_armada');
            $table->date('tanggal');
            $table->string('tujuan');
            $table->time('waktu');
            $table->timestamps();
        });
    }
};
