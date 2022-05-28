<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gradeofstudent extends Model
{
    //

    protected $fillable = [
        'student_number','gradesheetid', 'studentname','midterm','finalterm','finalgrade',
      ];
  
  
      protected $primaryKey = ['gradesheetid'];
     
     
      public $timestamps = false;

      protected $table = 'gradeofstudents';


      public function operador(){
    
        return $this->belongsTo('\App\Scholstudent');
        
    }
}
