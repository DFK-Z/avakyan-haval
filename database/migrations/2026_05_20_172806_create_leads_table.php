<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('type');
            $table->string('status')->default('new');
            $table->foreignId('car_model_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('car_trim_id')->nullable()->constrained()->nullOnDelete();
            $table->text('message')->nullable();
            $table->timestamp('preferred_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
