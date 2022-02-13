<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('new_tutorials', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('app_id');
            $table->string('title',100);
            $table->longText('content');
            $table->string('image',100);
            $table->unsignedTinyInteger('top')->default(0);

            $table->timestamps();

//            $table->foreign('user_id')->references('id')->on('users')
//                ->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('app_id')->references('id')->on('applications')
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
        Schema::dropIfExists('new_tutorials');
    }
}
