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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id('id_reservasi');
            $table->unsignedBigInteger('id_pelanggan');
            $table->unsignedBigInteger('id_armada');

            $table->enum('status_reservasi', ['pending', 'dikonfirmasi', 'dibatalkan'])
                ->default('pending');

            $table->date('tanggal_reservasi');
            $table->timestamps();

            // FK ke pelanggans
            $table->foreign('id_pelanggan')
                ->references('id_pelanggan')
                ->on('pelanggans')
                ->onDelete('cascade');

            // FK ke armadas
            $table->foreign('id_armada')
                ->references('id_armada')
                ->on('armadas')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
