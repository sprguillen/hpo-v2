<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBathcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 50)->unique();

            $table->integer('source_id')->unsigned();
            $table->integer('clinician_id')->unsigned();
            $table->integer('created_by')->unsigned();

            $table->tinyInteger('dispatch_mode');
            $table->tinyInteger('patient_type');
            $table->tinyInteger('payment_mode');
            $table->tinyInteger('status')->default(0);
            $table->integer('slides')->nullable();
            $table->integer('blood')->nullable();
            $table->integer('forms')->nullable();
            $table->integer('specimen')->nullable();
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
        Schema::dropIfExists('batches');
    }
}
