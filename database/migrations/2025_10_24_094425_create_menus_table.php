<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id'); // 5.7 uses increments for id
            $table->string('name');
            $table->string('slug')->unique();
            $table->enum('menu_type', ['header', 'footer', 'sidebar', 'other'])->default('header');
            $table->unsignedInteger('parent_id')->nullable();
            $table->integer('sort_order')->default(0);
            $table->enum('link_type', ['custom', 'model'])->default('custom');
            $table->string('custom_url')->nullable();
            $table->string('model_name')->nullable();
            $table->string('route_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('menus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
