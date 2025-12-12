<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transfer_types', function (Blueprint $table) {
            $table->id();

            $table->string('name');                     // UltraColor, High Tack, DTF, Vinyl...
            $table->string('supplier')->nullable();     // Who we buy it from
            $table->string('fabric_type')->nullable();  // Cotton, Poly, Nylon, etc.

            $table->integer('temperature')->nullable();  // Fahrenheit
            $table->integer('press_time')->nullable();   // seconds
            $table->string('pressure')->nullable();      // Light, Medium, Firm
            $table->string('peel_type')->nullable();     // Hot, Warm, Cold peel

            $table->text('notes')->nullable();           // Any additional directions

            $table->date('last_update')->nullable();     // Forces workers to verify outdated info

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transfer_types');
    }
};
