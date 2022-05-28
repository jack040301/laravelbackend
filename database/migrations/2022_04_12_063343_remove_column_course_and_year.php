<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnCourseAndYear extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gradsheetinfo', function (Blueprint $table) {
            //
            $table->dropColumn('course');
            $table->dropColumn('year');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gradsheetinfo', function (Blueprint $table) {
            //

            $table->string('course');
            $table->string('year');
        });
    }
}
