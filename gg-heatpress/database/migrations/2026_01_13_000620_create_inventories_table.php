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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->nullable();
            $table->string('category')->nullable();
            $table->string('condition')->nullable(); //new, used, damaged, refurbished...
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->string('name')->required();
            $table->text('notes')->nullable();
            $table->string('material')->nullable();
            $table->string('model')->nullable();
            $table->string('location')->nullable();
            $table->string('status')->nullable();
            $table->string('style')->nullable();
            $table->string('size')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('quantity')->default(0);
            $table->string('sku')->unique()->nullable();
            $table->string('type')->nullable();
            $table->string('vendor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
