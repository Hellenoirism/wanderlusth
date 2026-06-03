<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE reservasis 
            MODIFY status_reservasi 
            ENUM('Pending', 'Diproses','Dikonfirmasi', 'Dibatalkan', 'Selesai') 
            DEFAULT 'Pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
