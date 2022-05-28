<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('admins')->insert([
            'username'=>'SA101',
            'email'=>'jacquelineporral28@gmail.com',
            'firstname'=>'jacqueline',
            'lastname'=>'porral',
            'password'=>Hash::make('password123'),
            'student_number' => '20190344',
            'user_role' => 'staff',]);
         
    }
}
