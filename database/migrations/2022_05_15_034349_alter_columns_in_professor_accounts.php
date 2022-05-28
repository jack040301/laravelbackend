<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnsInProfessorAccounts extends Migration
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

            $table->string('firstname');
            $table->string('middleinitial');
            $table->string('lastname');
            $table->string('faculty_rank');


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
            $table->dropColumn('firstname');
            $table->dropColumn('middleinitial');
            $table->dropColumn('lastname');
            $table->dropColumn('faculty_rank');
           

        });
    }
}
