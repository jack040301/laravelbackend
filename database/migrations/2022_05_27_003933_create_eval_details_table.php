<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eval_details', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('evalform_id');
            $table->string('subjectcode');
            $table->string('subjectdesc');
            $table->string('grade');
            $table->string('units');
            $table->string('finalgrade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eval_details');
    }
}
