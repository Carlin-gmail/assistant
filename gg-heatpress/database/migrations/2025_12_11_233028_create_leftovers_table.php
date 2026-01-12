<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leftovers', function (Blueprint $table) {
            $table->id();

            // Relations
            $table->foreignId('bag_id')->constrained()->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('transfer_type_id')->nullable()->constrained()->nullOnDelete();

            // Bag logic (physical identifiers)
            $table->integer('bag_number');    // same as customer_id
            $table->integer('bag_index');     // 1,2,3... if multiple bags exist for same number

            // Vendor
            $table->string('vendor')->nullable(); // Stahls, Supacolor, Kingdom, etc.

            // Core leftover info
            $table->string('location');       // Full Front, Left Chest, Back, Youth, etc.
            $table->string('size')->nullable();
            $table->text('description')->nullable();
            $table->integer('quantity')->default(0);

            // Batching
            $table->integer('batch_number');  // increments per bag

            // Lifecycle tracking
            $table->date('expires_at')->nullable();
            $table->date('consumed_at')->nullable();

            // Image
            $table->string('image_path')->nullable();

            // QR / Meta
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leftovers');
    }
};
