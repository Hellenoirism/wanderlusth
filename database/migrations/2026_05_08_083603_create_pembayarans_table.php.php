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
        Schema::create('pembayarans', function (Blueprint $table) {

            $table->id('id_pembayaran');

            $table->unsignedBigInteger('id_reservasi')->unique();

            $table->decimal('harga_awal', 15, 2)->default(0);

            $table->decimal('harga_final', 15, 2)->default(0);

            $table->decimal('dp', 15, 2)->default(0);

            $table->decimal('total_bayar', 15, 2)->default(0);

            $table->decimal('sisa_pembayaran', 15, 2)->default(0);

            $table->enum('status_pembayaran', [
                'Belum Bayar',
                'DP',
                'Lunas'
            ])->default('Belum Bayar');

            $table->string('metode_pembayaran')->nullable();

            $table->date('tanggal_pembayaran')->nullable();

            $table->timestamps();

            $table->foreign('id_reservasi')
                ->references('id_reservasi')
                ->on('reservasis')
                ->cascadeOnDelete();

            $table->index('status_pembayaran');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
