<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('dispatcher_id')->after('id')->nullable();
            $table->unsignedBigInteger('payment_mode_id')->after('dispatcher_id')->nullable();

            $table->foreign('dispatcher_id')->references('id')->on('dispatchers')->onDelete('cascade');
            $table->foreign('payment_mode_id')->references('id')->on('payment_modes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('dispatcher_id');
            $table->dropForeign('payment_mode_id');

            $table->dropColumn('dispatcher_id');
            $table->dropColumn('payment_mode_id');
        });
    }
}
