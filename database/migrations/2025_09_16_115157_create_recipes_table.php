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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // recipe title
            $table->string('image_url')->nullable(); // recipe image
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // link to users
            $table->timestamps();
            $table->string('category')->nullable();
            $table->string('youtube')->nullable();
            $table->string('source')->nullable();
            $table->json('measures')->nullable();
            $table->json('tags')->nullable();
            $table->json('instructions')->nullable(); 
            $table->json('ingredients')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
