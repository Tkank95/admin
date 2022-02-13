<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberInfoDelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_info_del', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('user_id_del');
            $table->unsignedInteger('user_id');
            $table->unsignedTinyInteger('gender');
            $table->string('phone',10);
            $table->date('birthday');
            $table->string('address',100);
            $table->string('facebook',100);
            $table->string('team',15)->nullable();

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
        Schema::dropIfExists('member_info_del');
    }
}
