<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('users')->insert([
            'name' =>'jackdaisuki',
            'email' => 'jackdaisuki04@gmail.com',
            'student_number' => '20190344',
            'user_role' => 'student',
            'password' => Hash::make('password'),
        ]);
    }
}
