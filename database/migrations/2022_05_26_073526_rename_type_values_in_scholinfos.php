<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTypeValuesInScholinfos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scholinfos', function (Blueprint $table) {
            //

            $table->string('firstname')->nullable()->change();
            $table->string('middlename')->nullable()->change();
            $table->string('surname')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('birthday')->nullable()->change();
            $table->integer('contact')->nullable()->change();
            $table->string('course')->nullable()->change();
            $table->string('section')->nullable()->change();
            $table->string('elementary')->nullable()->change();
            $table->string('elemyeargrad')->nullable()->change();
            $table->string('highschool')->nullable()->change();
            $table->string('hsyeargrad')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scholinfos', function (Blueprint $table) {
            //
        });
    }
}
