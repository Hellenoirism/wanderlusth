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
        Schema::create('armada_fasilitas', function (Blueprint $table) {
            $table->id();

            // relasi ke armadas
            $table->unsignedBigInteger('armada_id');
            $table->foreign('armada_id')
                ->references('id_armada')
                ->on('armadas')
                ->cascadeOnDelete();

            // relasi ke fasilitas
            $table->foreignId('fasilitas_id')
                ->constrained('fasilitas')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armada_fasilitas');
    }
};
