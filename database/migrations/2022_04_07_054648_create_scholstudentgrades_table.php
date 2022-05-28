<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholstudentgradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholstudentgrades', function (Blueprint $table) {
            $table->string('srms_id',32)->index();
            $table->string('subjectcode');
            $table->string('subjectdesc');
            $table->string('grade');
            $table->string('units');

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
        Schema::dropIfExists('scholstudentgrades');
    }
}
