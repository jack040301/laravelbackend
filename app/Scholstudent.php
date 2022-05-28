<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scholstudent extends Model
{
    //

    protected $fillable = [
        'student_number','srms_id', 'semester', 'sem_startyear','sem_endyear','total_gwa',
    ];


    protected $table = 'scholstudents';



    protected $primaryKey = 'srms_id';
}
