<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradsheetinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradsheetinfo', function (Blueprint $table) {
            $table->string('gradesheetid')->primary();
            $table->string('course');
            $table->string('subjectcode');
            $table->string('subjectdesc');
            $table->integer('semester');
            $table->string('sem_startyear');
            $table->string('sem_endyear');
            $table->string('units');
            $table->string('time');
            $table->string('day');
            $table->string('year');
            $table->string('course_short');
            $table->string('course_year');
            $table->string('course_section');
            $table->string('professor');
            $table->string('facultyrank');

            $table->foreign('gradesheetid')->references('gradesheetid')->on('gradeofstudents')->onUpdate('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gradsheetinfo');
    }
}
