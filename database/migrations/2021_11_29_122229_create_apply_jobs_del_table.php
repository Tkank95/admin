<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplyJobsDelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply_jobs_del', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('user_id_del');

            $table->unsignedInteger('user_id');
            $table->unsignedInteger('app_id');
            $table->string('id_in_app',15);
            $table->string('nickname',50);
            $table->string('team', 15);
            $table->unsignedTinyInteger('worked');
            $table->string('talent',100);
            $table->string('experience',100);
            $table->dateTime('cast_datetime')->nullable();

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
        Schema::dropIfExists('apply_jobs_del');
    }
}
