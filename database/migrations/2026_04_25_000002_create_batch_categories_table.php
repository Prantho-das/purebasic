<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatchCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('batch_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('fee_range')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('batch_categories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('batch_categories');
    }
}
