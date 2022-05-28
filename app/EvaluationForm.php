<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationForm extends Model
{
    //

    protected $fillable = [
        'gradesheetid','srms_id', 'status_of_ef','archieve',
      ];


      protected $primaryKey = ['gradesheetid','srms_id'];
      

     
     
  
      protected $table = 'evaluation_forms';
}
