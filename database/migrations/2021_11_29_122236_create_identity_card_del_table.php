<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdentityCardDelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identity_card_del', function (Blueprint $table) {
            $table->unsignedInteger('id')->primary();
            $table->unsignedInteger('user_id_del');

            $table->unsignedInteger('apply_id');
            $table->string('number_cmnd', 12)->nullable();
            $table->string('cmnd_mt',100)->nullable();
            $table->string('cmnd_ms',100)->nullable();
            $table->string('selfie_cmnd',100)->nullable();
            $table->string('selfie', 100)->nullable();
            $table->string('selfie_team', 100)->nullable();
            $table->string('video_casting',100)->nullable();
            $table->string('game',100)->nullable();
            $table->string('rank_image',100)->nullable();
            $table->string('video_proof', 100)->nullable();

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
        Schema::dropIfExists('identity_card_del');
    }
}
