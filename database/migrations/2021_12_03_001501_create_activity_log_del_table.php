<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityLogDelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_log_del', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('user_id_del');

            $table->string('log_name');
            $table->text('description');
            $table->text('subject_type');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->nullableMorphs('causer', 'causer');
            $table->ipAddress('ip');
            $table->json('agent');
            $table->json('properties')->nullable();

            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('create_time');

            $table->index(['log_name', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_log_del');
    }
}
