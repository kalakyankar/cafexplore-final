<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cafe_facilities', function (Blueprint $table) {
            $table->foreignId('cafe_id')->constrained()->onDelete('cascade');
            $table->foreignId('facility_id')->constrained()->onDelete('cascade');
            $table->boolean('is_halal')->default(false);
            $table->timestamps();
            
            $table->primary(['cafe_id', 'facility_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cafe_facilities');
    }
};