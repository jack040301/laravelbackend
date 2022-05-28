<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GradesheetInfo extends Model
{
    //

    protected $fillable = [
      'gradesheetid', 'course','subjectcode','subjectdesc','semester','sem_startyear','sem_endyear'
      ,'units','time','day','year','professor','facultyrank'
      ,'course_short','course_year','course_section','archieve'];


      protected $table = 'gradsheetinfo';


      protected $primaryKey = 'gradesheetid';


      public $timestamps = false;
    
   
}
