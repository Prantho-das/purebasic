<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWatchProgressTable extends Migration
{
    public function up()
    {
        Schema::create('watch_progress', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('batch_id');
            $table->unsignedBigInteger('lecture_id');
            $table->unsignedInteger('watched_seconds')->default(0);
            $table->unsignedInteger('duration_seconds')->default(0);
            $table->timestamps();
            $table->unique(['user_id', 'batch_id', 'lecture_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('watch_progress');
    }
}
