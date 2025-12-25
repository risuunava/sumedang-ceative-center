<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Hapus kolom price_per_hour
            $table->dropColumn('price_per_hour');
        });
        
        Schema::table('bookings', function (Blueprint $table) {
            // Hapus kolom total_price
            $table->dropColumn('total_price');
        });
    }

    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->decimal('price_per_hour', 10, 2)->default(0);
        });
        
        Schema::table('bookings', function (Blueprint $table) {
            $table->decimal('total_price', 10, 2);
        });
    }
};