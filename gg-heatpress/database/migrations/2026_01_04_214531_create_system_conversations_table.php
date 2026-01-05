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
        Schema::create('system_conversations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('message_from')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('open');
            $table->string('subject')->nullable();
            $table->string('conclusion')->nullable();
            $table->string('priority')->nullable();
            $table->boolean('distak')->default(false);
            $table->string('page_url')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_conversations');
    }
};
