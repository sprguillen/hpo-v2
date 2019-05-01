<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->unique()->nullable()->default(null);
            $table->string('global_prefix', 40)->nullable()->default(null);
            $table->string('type', 45)->default('client');
            $table->tinyInteger('role')->default(0);
            $table->string('username', 45);
            $table->string('email', 45)->unique();
            $table->string('password');
            $table->string('first_name', 45);
            $table->string('last_name', 45);
            $table->string('contact_number', 45)->nullable();
            $table->string('business_name', 45)->nullable();
            $table->string('business_address')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('users');
    }
}
