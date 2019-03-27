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
            $table->string('code', 20);
            $table->string('global_prefix', 40)->nullable()->default(null);
            $table->enum('type', ['admin', 'client', 'processor', 'staff']);
            $table->string('payment_mode', 45)->nullable()->default(null);
            $table->string('dispatch_mode', 45)->nullable()->default(null);
            $table->string('username', 45)->unique();
            $table->string('email', 45)->unique();
            $table->text('password');
            $table->boolean('active');
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
