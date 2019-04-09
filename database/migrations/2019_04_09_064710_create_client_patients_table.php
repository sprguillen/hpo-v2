<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->unique()->nullable()->default(null);
            $table->unsignedBigInteger('client_id');
            $table->string('email', 45);
            $table->string('first_name', 45);
            $table->string('middle_name', 45)->nullable()->default(null);
            $table->string('last_name', 45);
            $table->string('gender', 15);
            $table->date('birth_date');
            $table->string('hpo_patient_id', 255)->nullable()->default(null);
            $table->text('passport_number')->nullable()->default(null);
            $table->text('citizenship')->nullable()->default(null);
            $table->string('blood_type', 10)->nullable()->default(null);
            $table->text('mother_maiden_name')->nullable()->default(null);
            $table->string('rh_level', 10);
            $table->text('address')->nullable()->default(null);
            $table->text('city')->nullable()->default(null);
            $table->text('mobile_number')->nullable()->default(null);
            $table->text('tel_number')->nullable()->default(null);
            $table->text('fax_number')->nullable()->default(null);
            $table->text('occupation')->nullable()->default(null);
            $table->string('hmo', 45)->nullable()->default(null);
            $table->string('hmo_number', 45)->nullable()->default(null);
            $table->datetime('last_visited_at')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_patients');
    }
}
