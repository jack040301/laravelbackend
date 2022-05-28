<?php

use Illuminate\Database\Seeder;

class ScholasticStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('scholstudents')->insert([
            'srms_id'=>'100001',
            'student_number'=>'20190344',
            'semester' => '1',
            'sem_startyear' => '2021',
            'sem_endyeaer' => '2022',
            'total_gwa' => '1',
            ]);
         
        //
      
    }
}
