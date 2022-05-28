<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddArchieveColumnInGradsheetinfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gradsheetinfo', function (Blueprint $table) {
            //

                $table->boolean('archieve')->nullable();
                //
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gradsheetinfo', function (Blueprint $table) {
            //

            $table->dropColumn('archieve');
        });
    }
}
