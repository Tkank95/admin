<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->default(0);
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('new_id');
            $table->longText('content');
            $table->unsignedTinyInteger('status')->default(1);

            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users')
//                ->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('new_id')->references('id')->on('new_tutorials')
//                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
