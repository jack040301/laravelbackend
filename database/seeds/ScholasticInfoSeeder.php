<?php

use Illuminate\Database\Seeder;

class ScholasticInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('scholinfos')->insert([
            'srms_id'=>'100001',
            'student_number'=>'20190344',
            'firstname' => 'JACQUELINE',
            'middlename' => 'COMBIS',
            'surname' => 'PORRAL',
            'address' => 'BLK1 LOT 11 CASTLE SPRING CAMARIN CALOOCAN CITY',
            'birthday' => 'MARCH 03 2001',
            'contact' => '0976432412',
            'course' => 'BS COMPUTER SCIENCE',
            'section' => '3A',
            'elementary' => 'CIELITO ZAMORA ELEMENTARY SCHOOL',
            'elemyeargrad' => '2016',
            'highschool' => 'CIELITO ZAMORA SENIOR HIGH SCHOOL',
            'hsyeargrad' => '2019',
            'archieve' => '1',]);
         
        //
    
    }
}
