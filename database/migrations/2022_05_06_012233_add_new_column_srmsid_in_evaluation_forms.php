<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnSrmsidInEvaluationForms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('evaluation_forms', function (Blueprint $table) {
            $table->string('srms_id',32)->index();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('evaluation_forms', function (Blueprint $table) {
            //

            $table->dropColumn('srms_id');
        });
    }
}
