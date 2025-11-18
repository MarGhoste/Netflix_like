<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movie_favorites', function (Blueprint $table) {
            // Claves primarias compuestas
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');

            // Establecer la clave primaria compuesta
            $table->primary(['user_id', 'movie_id']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movie_favorites');
    }
};
