<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoteAppDelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Promote_app_Del', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('user_id_del');

            $table->unsignedInteger('app_id');
            $table->string('title');
            $table->string('banner',100);
            $table->text('content');
            $table->text('register');
            $table->unsignedTinyInteger('status');

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
        Schema::dropIfExists('Promote_app_Del');
    }
}
