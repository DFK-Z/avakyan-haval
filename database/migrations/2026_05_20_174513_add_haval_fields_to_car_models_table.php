<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('car_models', function (Blueprint $table) {
            $table->string('line')->default('city')->after('brand');
            $table->string('tagline')->nullable()->after('name');
            $table->string('badge')->nullable()->after('tagline');
            $table->unsignedSmallInteger('model_year')->nullable()->after('transmission');
            $table->text('price_disclaimer')->nullable()->after('price_from');
            $table->boolean('is_updated')->default(false)->after('is_popular');
            $table->boolean('show_in_hero')->default(false)->after('is_updated');
        });
    }

    public function down(): void
    {
        Schema::table('car_models', function (Blueprint $table) {
            $table->dropColumn([
                'line', 'tagline', 'badge', 'model_year',
                'price_disclaimer', 'is_updated', 'show_in_hero',
            ]);
        });
    }
};
