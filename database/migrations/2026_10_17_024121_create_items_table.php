<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id(); // Otomatis membuat angka 1, 2, 3, dst (Auto-Increment)
            $table->string('name');
            $table->string('category');
            $table->string('status');
            $table->string('image')->nullable(); // Tempat menyimpan jalur file foto
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};