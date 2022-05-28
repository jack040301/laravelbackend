<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scholstudentgrade extends Model
{
    //

    protected $fillable = [
       'srms_id', 'subjectcode', 'subjectdesc','grade','units',
    ];
}
