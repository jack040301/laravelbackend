<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholstudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholstudents', function (Blueprint $table) {
            $table->string('student_number')->unique();
            $table->string('srms_id',32)->index();
            $table->integer('semester');
            $table->integer('sem_startyear');
            $table->integer('sem_endyeaer');
            $table->string('total_gwa');


            $table->foreign('srms_id')->references('srms_id')->on('scholinfos')->onUpdate('cascade');; //edit here

       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scholstudents');
    }
}
