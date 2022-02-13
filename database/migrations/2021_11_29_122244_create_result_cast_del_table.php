<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultCastDelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_cast_del', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('user_id_del');

            $table->unsignedInteger('apply_id');
            $table->unsignedTinyInteger('result');
            $table->unsignedInteger('wage');
            $table->unsignedTinyInteger('contract');
            $table->unsignedTinyInteger('contract_status');
            $table->unsignedTinyInteger('active');
            $table->date('pass_date')->nullable();
            $table->date('start_day')->nullable();
            $table->string('policy',100);
            $table->text('note')->nullable();

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
        Schema::dropIfExists('result_cast_del');
    }
}
