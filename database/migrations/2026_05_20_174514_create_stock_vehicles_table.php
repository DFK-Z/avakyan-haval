<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_model_id')->constrained()->cascadeOnDelete();
            $table->foreignId('car_trim_id')->nullable()->constrained()->nullOnDelete();
            $table->string('vin')->nullable()->unique();
            $table->string('color')->nullable();
            $table->unsignedBigInteger('price');
            $table->unsignedSmallInteger('year');
            $table->string('engine')->nullable();
            $table->string('drive')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_vehicles');
    }
};
