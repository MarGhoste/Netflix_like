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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('release_date')->nullable();
            //$table->string('director')->nullable();
            //$table->string('genre')->nullable();
            $table->string('image')->nullable();
           // $table->double('rating')->nullable();
            $table->integer('duration')->nullable();
           // $table->integer('views')->nullable();
           // $table->integer('likes')->nullable();
           // $table->integer('dislikes')->nullable();
           // $table->integer('comments')->nullable();
            $table->string('trailer_url')->nullable();
            $table->boolean('is_trending')->default(false);
            $table->boolean('is_new')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
