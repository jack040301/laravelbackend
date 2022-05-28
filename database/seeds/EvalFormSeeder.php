<?php

use Illuminate\Database\Seeder;

class EvalFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('evaluation_forms')->insert([
            'gradesheetid'=>'71034D39-92C2-4538-B0D6-F12F275433B7',
            'status_of_ef'=>'Passed',
            'archieve' => '1',
            'evalform_id' => '102346',
            'srms_id' => '100001',
        ]);         
    }
}
