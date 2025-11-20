<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_ratings_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('vehicle_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('rating'); // 1-5
            $table->string('comment', 500)->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'vehicle_id']); // 1 reseña por usuario/vehículo
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};

