<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvalDetails extends Model
{
    //

    
    protected $fillable = [
        'evalform_id', 'subjectcode', 'subjectdesc','grade','units','finalgrade'
     ];

     protected $table = 'evaldetails';


     protected $primaryKey = 'evalform_id';

     public $timestamps = false;

}
