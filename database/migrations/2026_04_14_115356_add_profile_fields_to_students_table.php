<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProfileFieldsToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('address');
            $table->string('gender', 20)->nullable()->after('photo');
            $table->string('fb')->nullable()->after('gender');
        });
    }

    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['photo', 'gender', 'fb']);
        });
    }
}
