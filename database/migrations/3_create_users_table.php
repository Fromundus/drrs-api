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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('id_number')->unique()->nullable();
            $table->string('educational_status')->nullable();
            $table->string('year_level')->nullable();
            $table->string('last_year_attended_or_year_graduated')->nullable();
            $table->string('email')->unique();
            $table->string('contact_number')->unique()->nullable();
            $table->string('program')->nullable();
            $table->string('college')->nullable();
            $table->string('password');
            $table->integer('role');
            $table->string('status');
            $table->string('e_signature')->nullable();
            $table->string('e_path')->nullable();
            
            $table->string('picture_passport')->nullable();
            $table->string('picture_passport_path')->nullable();

            $table->string('picture_2x2')->nullable();
            $table->string('picture_2x2_path')->nullable();

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign("program")->references("program_code")->on("programs");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
