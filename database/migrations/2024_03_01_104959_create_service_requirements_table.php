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
        Schema::create('service_requirements', function (Blueprint $table) {
            $table->id();
            $table->string('service_code');
            $table->string('name');
            $table->string('requirement_code');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->timestamps();

            $table->foreign('service_code')->references('service_code')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requirements');
    }
};
