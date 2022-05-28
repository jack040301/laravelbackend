<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class GradeStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('gradeofstudents')->insert([
            'student_number'=>'jacqueline porral',
            'studentname'=>'superadmin@gmail.com',
            'midterm'=>1.25,
            'finalterm' => 1.25,
            'finalgrade'=>1.25,
        ]);
    }
}
