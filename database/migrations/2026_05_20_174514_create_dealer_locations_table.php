<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dealer_locations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('line')->default('city');
            $table->string('address');
            $table->string('city')->default('Волгоград');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('working_hours')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dealer_locations');
    }
};
