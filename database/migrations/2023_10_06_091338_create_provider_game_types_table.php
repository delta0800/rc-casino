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
        Schema::create('provider_game_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('game_provider_id')->constrained('game_providers')->onDelete('cascade');
            $table->foreignId('game_type_id')->constrained('game_types')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provider_game_types');
    }
};
