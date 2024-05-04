<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id();
            $table->json('medical_history')->nullable();
            $table->string('doctor_name')->nullable();
            $table->string('licence_number')->nullable();
            $table->string('diagnosis')->nullable();
            $table->json('allergies_and_adverse_reaction')->nullable();
            $table->json('medication_list')->nullable();
            $table->json('vital_signs')->nullable();
            $table->json('physical_examination_findings')->nullable();
            $table->json('laboratory_test_results')->nullable();
            $table->json('procedures_and_treatments')->nullable();
            $table->json('drogress_notes')->nullable();
            $table->json('diagnostic_codes')->nullable();
            $table->json('consent_forms_and_authorizations')->nullable();
            $table->json('discharge_summaries')->nullable();
            $table->foreignId('doctor_id')->constrained('profiles');;
            $table->foreignId('patient_id')->constrained('profiles');;
            $table->foreignId('created_id')->constrained('users');;
            $table->integer('modified_id')->nullable();;
            $table->string('attachments')->nullable();
            $table->softDeletes('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_records');
    }
}
