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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string("request_id")->unique();
            $table->string("document");
            $table->string("service_code");
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('id_number');
            $table->string('educational_status')->nullable();
            $table->string('year_level')->nullable();
            $table->string('last_year_attended_or_year_graduated')->nullable();
            $table->string('email');
            $table->string('contact_number')->nullable();
            $table->string('program');
            $table->string('college');
            $table->string('clearance')->nullable();
            $table->integer('price')->nullable();
            $table->string('status');
            $table->timestamp('for_pickup')->nullable();
            $table->timestamp('admin_registrar')->nullable();
            $table->timestamp('admin_cashier')->nullable();
            $table->timestamp('admin_library')->nullable();
            $table->timestamp('admin_accounting_services')->nullable();
            $table->timestamp('admin_student_services')->nullable();
            $table->timestamp('admin_dorm')->nullable();
            $table->timestamp('admin_dean')->nullable();
            $table->timestamp('rejected')->nullable();
            $table->timestamp('completed')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamp('pickup_date')->nullable();
            $table->string('proof')->nullable();
            $table->string('path_proof')->nullable();

            $table->string('p')->nullable();
            $table->string('picture_passport_path')->nullable();

            $table->string('tbt')->nullable();
            $table->string('picture_2x2_path')->nullable();

            $table->string('aol')->nullable();
            $table->string('affidavit_of_loss_path')->nullable();

            $table->string('pbc')->nullable();
            $table->string('psa_birth_certificate_path')->nullable();

            $table->string('spa')->nullable();
            $table->string('spa_path')->nullable();

            $table->string('alfo')->nullable();
            $table->string('authorization_letter_from_owner_path')->nullable();

            $table->string('viar')->nullable();
            $table->string('valid_id_authorized_representative_path')->nullable();

            $table->timestamp('document_stamp_release')->nullable();

            $table->timestamps();

            $table->foreign('document')->references('name')->on('services');
            // $table->foreign('email')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
