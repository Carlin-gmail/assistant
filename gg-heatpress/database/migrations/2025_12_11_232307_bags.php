<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bags', function (Blueprint $table) {
            $table->id();

            // Physical bag group (customer account number)
            $table->unsignedBigInteger('bag_number');
            // Always equals customer_id

            // Sequential index: 1, 2, 3...
            $table->unsignedInteger('bag_index');
            // Identifies multiple bags under same customer

            // Relationship
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();

            // Additional details
            $table->string('subcategory')->nullable(); // ex: Football, Dance Team...
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // A customer cannot have duplicated bag_index
            $table->unique(['customer_id', 'bag_index']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bags');
    }
};
