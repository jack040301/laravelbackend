<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfessorIdInProfessorAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('professor_accounts', function (Blueprint $table) {
            //
            $table->integer('professorID')->unique();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('professor_accounts', function (Blueprint $table) {
            //
            $table->dropColumn('professorID');

        });
    }
}
