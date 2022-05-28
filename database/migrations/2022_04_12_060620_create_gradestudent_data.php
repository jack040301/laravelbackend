<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradestudentData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradeofstudents', function (Blueprint $table) {
            $table->string('gradesheetid');
            $table->string('student_number');
            $table->string('studentname');
            $table->double('midterm');
            $table->double('finalterm');
            $table->double('finalgrade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gradeofstudents');
    }
}
