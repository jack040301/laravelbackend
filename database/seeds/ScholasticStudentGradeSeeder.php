<?php

use Illuminate\Database\Seeder;

class ScholasticStudentGradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('scholstudentgrades')->insert([
            'srms_id'=>'100001',
            'subjectcode'=>'CSE 102',
            'subjectdesc' => 'GRAPHICS AND VISUAL COMPUTING',
            'grade' => '1',
            'units' => '3',]);
         
        //
    
    }
}
