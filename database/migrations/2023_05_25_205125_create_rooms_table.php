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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('size');
            $table->string('price');
            $table->string('capacity');
            $table->text('description');
            $table->boolean('wifi')->default(0);
            $table->boolean('air_condition')->default(0);
            $table->boolean('balcony')->default(0);
            $table->boolean('sea_view')->default(0);
            $table->boolean('minibar')->default(0);
            $table->boolean('strongbox')->default(0);
            $table->boolean('tv')->default(0);
            $table->boolean('worktable')->default(0);
            $table->boolean('sofa')->default(0);
            $table->boolean('parking')->default(0);
            $table->boolean('spa_and_wellness')->default(0);
            $table->boolean('breakfast')->default(0);
            $table->boolean('no_smoking')->default(0);
            $table->boolean('crib')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
