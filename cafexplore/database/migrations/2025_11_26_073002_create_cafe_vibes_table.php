<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cafe_vibes', function (Blueprint $table) {
            $table->foreignId('cafe_id')->constrained()->onDelete('cascade');
            $table->foreignId('vibe_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->primary(['cafe_id', 'vibe_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cafe_vibes');
    }
};