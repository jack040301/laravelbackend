<?php

use Illuminate\Database\Seeder;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('professor_accounts')->insert([
            'email'=>'professor@gmail.com',
            'password'=>Hash::make('password123'),
            'user_role' => 'professor',
            'professorID' => 1001]);
         
        //
    }
}
