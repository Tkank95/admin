<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultCastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_cast', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('apply_id')->unique();
            $table->unsignedTinyInteger('result')->default(2);
            $table->unsignedInteger('wage')->default(1)->nullable();
            $table->unsignedTinyInteger('contract')->default(0);
            $table->unsignedTinyInteger('contract_status')->default(4);
            $table->unsignedTinyInteger('active')->default(1);
            $table->date('pass_date')->nullable();
            $table->date('start_day')->nullable();
            $table->string('policy',100);
            $table->text('note')->nullable();

            $table->timestamps();

//            $table->foreign('apply_id')->references('id')->on('apply_jobs')
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
        Schema::dropIfExists('result_cast');
    }
}
