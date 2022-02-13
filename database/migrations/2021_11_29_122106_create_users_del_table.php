<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_del', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('user_id_del');
            $table->string('name',30);
            $table->string('email',50);
            $table->string('username',15);
            $table->string('google_id',50)->nullable();
            $table->string('password', 100);
            $table->unsignedTinyInteger('position');
            $table->string('avatar',100);
            $table->unsignedTinyInteger('status');
            $table->timestamp('banned_until')->nullable();

            $table->string('remember_token', 100)->nullable();

            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('create_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_del');
    }
}
