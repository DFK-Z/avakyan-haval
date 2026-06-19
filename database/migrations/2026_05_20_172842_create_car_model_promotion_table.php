<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_model_promotion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained()->cascadeOnDelete();
            $table->foreignId('promotion_id')->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['car_model_id', 'promotion_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_model_promotion');
    }
};
