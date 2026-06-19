<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('car_models', function (Blueprint $table) {
            $table->id();
            $table->string('brand')->default('Haval');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category');
            $table->string('drive_type');
            $table->unsignedBigInteger('price_from');
            $table->json('specs')->nullable();
            $table->unsignedSmallInteger('seats')->nullable();
            $table->unsignedSmallInteger('doors')->nullable();
            $table->string('transmission')->nullable();
            $table->string('hero_image')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_popular')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('car_models');
    }
};
