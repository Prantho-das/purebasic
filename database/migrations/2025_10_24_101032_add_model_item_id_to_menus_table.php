<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModelItemIdToMenusTable extends Migration
{
    public function up()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->unsignedInteger('batch_id')->nullable()->after('route_name');
            $table->unsignedInteger('class_id')->nullable()->after('batch_id');
            $table->unsignedInteger('book_id')->nullable()->after('class_id');

            // Optional: Add foreign keys if you want (for integrity)
            // $table->foreign('batch_id')->references('id')->on('batches')->onDelete('set null');
            // $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
            // $table->foreign('book_id')->references('id')->on('books')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('menus', function (Blueprint $table) {
            $table->dropColumn(['batch_id', 'class_id', 'book_id']);
        });
    }
}