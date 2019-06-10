<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('client_id');

            $table->string('code', 50)->unique();
            $table->string('global_custom_id', 255)->unique();
            $table->string('hpo_patient_id', 255)->unique();

            $table->string('client_custom_id', 255)->nullable();

            $table->string('email', 100);
            $table->string('first_name', 50)->nullable();
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('mothers_maiden_name', 50)->nullable();
            $table->string('gender')->nullable();
            $table->date('birth_date')->nullable();
            $table->text('passport_number')->nullable();
            $table->text('citizen')->nullable();
            $table->string('blood_type', 10)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('senior_citizen_id', 255)->nullable();
            $table->string('telephone_number', 50)->nullable();
            $table->string('fax_number', 50)->nullable();
            $table->string('mobile_number', 50)->nullable();
            $table->string('occupation', 50)->nullable();
            $table->string('hmo_card', 50)->nullable();
            $table->string('hmo_card_no', 50)->nullable();
            $table->string('last_visit_at', 50)->nullable();

            $table->softDeletes();
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
        Schema::dropIfExists('patients');
    }
}
