<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataLiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_live', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('apply_id');
            $table->date('date');
            $table->decimal('valid_time', 4,2,true)->default(0);
            $table->unsignedTinyInteger('valid_day')->default(0);
            $table->unsignedInteger('income')->default(0);
            $table->unsignedInteger('new_fan')->default(0);

            $table->timestamps();

//            $table->foreign('team')->references('id')->on('users')
//                ->onDelete('cascade')->onUpdate('cascade');
//            $table->foreign('cate_id')->references('id')->on('applications')
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
        Schema::dropIfExists('data_live');
    }
}
