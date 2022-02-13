<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityLogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::connection(config('activitylog.database_connection'))->create(config('activitylog.table_name'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('log_name');
            $table->text('description');
            $table->text('subject_type');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->nullableMorphs('causer', 'causer');
            $table->ipAddress('ip');
            $table->json('agent');
            $table->json('properties')->nullable();
            $table->timestamps();
            $table->index(['log_name', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::connection(config('activitylog.database_connection'))->dropIfExists(config('activitylog.table_name'));
    }
}
