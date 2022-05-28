<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholinfos', function (Blueprint $table) {
            $table->string('srms_id')->primary();
            $table->string('student_number')->unique();
            $table->string('firstname');
            $table->string('middlename');
            $table->string('surname');
            $table->string('address');
            $table->string('birthday');
            $table->integer('contact');
            $table->string('course');
            $table->string('section');
            $table->string('elementary');
            $table->string('elemyeargrad');
            $table->string('highschool');
            $table->string('hsyeargrad');



            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scholinfos');
    }
}
