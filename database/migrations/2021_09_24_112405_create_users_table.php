<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->string('name',30);
            $table->string('email',50)->unique();
            $table->string('username',15)->unique();
            $table->string('google_id',50)->nullable();
            $table->string('password', 100);
            $table->unsignedTinyInteger('position')->default('5');
            $table->string('avatar',100);
            $table->unsignedTinyInteger('status')->default('1');
            $table->timestamp('banned_until')->nullable();

            $table->rememberToken();
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
