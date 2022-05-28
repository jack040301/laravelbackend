<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ScholasticRecordController extends Controller
{
    //

    //show this to MIS TABLE

    //BABANG TABLE SA SRMS
    public function showscholastperStudent(Request $request, $student_number){
        //this is per SR OF STUDENT

        $studentscholinfo = DB::table('gradeofstudents')
        ->leftJoin('gradsheetinfo', 'gradeofstudents.gradesheetid', '=', 'gradsheetinfo.gradesheetid')->where('gradeofstudents.student_number', $student_number)->orderBy('course_year')->get();



         $information = DB::table('scholinfos')->where('student_number',$student_number)->limit(1)->get();

        
        $batch = array();
        //done first year
        $firstyearFirstSem = array();
        $firstyearSecondSem = array();

        //

        //second year
        $secondyearFirstSem = array();
        $secondyearSecondSem = array();

        
        //third year 
        $thirdyearFirstSem = array();
        $thirdyearSecondSem = array();


        //
        $fourthyearFirstSem = array();
        $fourthyearSecondSem = array();




        foreach($studentscholinfo as $items){
            $gradesheetid = $items->gradesheetid;
            $midterm = $items->midterm;
            $finalterm = $items->finalterm;
            $finalgrade = $items->finalgrade;
            $semester = $items->semester;
            $subjectdesc = $items->subjectdesc;
            $subjectcode = $items->subjectcode;
            $course_year = $items->course_year;
            $sem_startyear = $items->sem_startyear;
            $sem_endyear = $items->sem_endyear;
            $units = $items->units;


            //first year
            if($course_year === '1'){
                //first sem
                if($semester === 1){  
            $firstyearFirstSem[] = array('student_number' => $student_number,'gradesheetid' => $gradesheetid,
            'subjectdesc'=> $subjectdesc,
            'subjectcode'=> $subjectcode,
            'semester'=> $semester,
            'sem_startyear' => $sem_startyear,
            'sem_endyear' => $sem_endyear,
            'stud_year'=>$course_year,
            'midterm' => $midterm,
            'finalterm' => $finalterm,
            'finalgrade' => $finalgrade,
            'units'=>$units);
                }
            if($semester === 2){  //second sem
                    $firstyearSecondSem[] = array('student_number' => $student_number,'gradesheetid' => $gradesheetid,
                    'subjectdesc'=> $subjectdesc,
                    'subjectcode'=> $subjectcode,
                    'semester'=> $semester,
                    'sem_startyear' => $sem_startyear,
                    'sem_endyear' => $sem_endyear,
                    'stud_year'=>$course_year,
                    'midterm' => $midterm,
                    'finalterm' => $finalterm,
                    'finalgrade' => $finalgrade,
                    'units'=>$units);

                    }
            }

            //second year
            if($course_year === '2'){

                if($semester === 1){  
                $secondyearFirstSem[] = array('student_number' => $student_number,'gradesheetid' => $gradesheetid,
                'subjectdesc'=> $subjectdesc,
                'subjectcode'=> $subjectcode,
                'semester'=> $semester,
                'sem_startyear' => $sem_startyear,
                'sem_endyear' => $sem_endyear,
                'stud_year'=>$course_year,
                'midterm' => $midterm,
                'finalterm' => $finalterm,
                'finalgrade' => $finalgrade,
                'units'=>$units);

            }

            if($semester === 2){  
                $secondyearSecondSem[] = array('student_number' => $student_number,'gradesheetid' => $gradesheetid,
                'subjectdesc'=> $subjectdesc,
                'subjectcode'=> $subjectcode,
                'semester'=> $semester,
                'sem_startyear' => $sem_startyear,
                'sem_endyear' => $sem_endyear,
                'stud_year'=>$course_year,
                'midterm' => $midterm,
                'finalterm' => $finalterm,
                'finalgrade' => $finalgrade,
                'units'=>$units);
                
            }
    
             }
             //third year
             if($course_year === '3'){

                if($semester === 1){
                    $thirdyearFirstSem[] = array('student_number' => $student_number,'gradesheetid' => $gradesheetid,
                    'subjectdesc'=> $subjectdesc,
                    'subjectcode'=> $subjectcode,
                    'semester'=> $semester,
                    'sem_startyear' => $sem_startyear,
                    'sem_endyear' => $sem_endyear,
                    'stud_year'=>$course_year,
                    'midterm' => $midterm,
                    'finalterm' => $finalterm,
                    'finalgrade' => $finalgrade,
                    'units'=>$units);
                }
                if($semester === 2){

                    $thirdyearSecondSem[] = array('student_number' => $student_number,'gradesheetid' => $gradesheetid,
                    'subjectdesc'=> $subjectdesc,
                    'subjectcode'=> $subjectcode,
                    'semester'=> $semester,
                    'sem_startyear' => $sem_startyear,
                    'sem_endyear' => $sem_endyear,
                    'stud_year'=>$course_year,
                    'midterm' => $midterm,
                    'finalterm' => $finalterm,
                    'finalgrade' => $finalgrade,
                    'units'=>$units);
                }
        
          }
            //fourth year
            if($course_year === '4'){

                if($semester === 1){
            $fourthyearFirstSem[] = array('student_number' => $student_number,'gradesheetid' => $gradesheetid,
            'subjectdesc'=> $subjectdesc,
            'subjectcode'=> $subjectcode,
            'semester'=> $semester,
            'sem_startyear' => $sem_startyear,
            'sem_endyear' => $sem_endyear,
            'stud_year'=>$course_year,
            'midterm' => $midterm,
            'finalterm' => $finalterm,
            'finalgrade' => $finalgrade,
            'units'=>$units);

                }

                if($semester === 2){
                    $fourthyearSecondSem[] = array('student_number' => $student_number,'gradesheetid' => $gradesheetid,
                    'subjectdesc'=> $subjectdesc,
                    'subjectcode'=> $subjectcode,
                    'semester'=> $semester,
                    'sem_startyear' => $sem_startyear,
                    'sem_endyear' => $sem_endyear,
                    'stud_year'=>$course_year,
                    'midterm' => $midterm,
                    'finalterm' => $finalterm,
                    'finalgrade' => $finalgrade,
                    'units'=>$units);
        
                        }


         }

            $batch[] = array('student_number' => $student_number,'gradesheetid' => $gradesheetid,
            'subjectdesc'=> $subjectdesc,
            'subjectcode'=> $subjectcode,
            'semester'=> $semester,
            'sem_startyear' => $sem_startyear,
            'sem_endyear' => $sem_endyear,
            'stud_year'=>$course_year,
            'midterm' => $midterm,
            'finalterm' => $finalterm,
            'finalgrade' => $finalgrade,
            'units'=>$units);
        }


        $batch += ['student_info' => $information]; 
        
        $data = array_merge(['student_info'=>$information,
        'first'=> $firstyearFirstSem, 'firstSecondSem'=>$firstyearSecondSem,
        'second'=>$secondyearFirstSem, 'secondSecondSem'=>$secondyearSecondSem,
        'third'=>$thirdyearFirstSem, 'thirdSecondSem'=>$thirdyearSecondSem,
        'fourth'=>$fourthyearFirstSem, 'fourthSecondSem'=>$fourthyearSecondSem]);
      // $data = array_merge([$information],$batch);


    
    return response()->json($data);

    }

    //THIS IS ALL SCHOLASTIC INFO
    public function showscolasticMIS(Request $request){
            //

            $scholinfo= DB::table('scholinfos')->where('archieve', null)->orwhere('archieve', '0')->when(request('search'), function($query) {
                $query->where('firstname', 'like', '%' . request('search') . '%')->orWhere('surname', 'like', '%' . request('search') . '%')
                ->orWhere('student_number', 'like', '%' . request('search') . '%')
                ->orWhere('course', 'like', '%' . request('search') . '%')
                ->orWhere('srms_id', 'like', '%' . request('search') . '%')
                ->orWhere('section', 'like', '%' . request('search') . '%');})->orderBy('surname')->paginate(10);


        return response()->json($scholinfo);
    }

    //THIS IS STUDENT SCHOL INFO GET

    public function scholstudent(Request $request, $student_number){

        $student = DB::table('scholinfos')
        ->leftJoin('scholstudentgrades', 'scholinfos.srms_id', '=', 'scholstudentgrades.srms_id')
        ->leftJoin('scholstudents', 'scholstudentgrades.srms_id', '=', 'scholstudents.srms_id')->where('scholinfos.student_number', $student_number)->limit(1)->get();
       
        return response()->json($student);

    }


    //MIS UPDATE

    public function scholupdate(Request $request, $srms_id){
        $studentupdate = DB::table('scholinfos')
        ->where('srms_id', $srms_id)
        ->update(['student_number' => $request->studNum,
        'course' => $request->studProgram,
        'section' => $request->studSection,
        'surname' => $request->studLN,
        'firstname' => $request->studFN,
        'middlename' => $request->studMN,
        'birthday' => $request->studBirthday,
        'address' => $request->studAddress,
        'contact' => $request->studContactNum,
        'elementary' => $request->studElemSchool,
        'elemyeargrad' => $request->studElemGradYr,
        'highschool' => $request->studHighSchool,
        'hsyeargrad' => $request->studHighSchoolGradYr,
    //    'archieve' =>$request->arch
                ]);

        return response()->json($studentupdate);

    }


    public function showscolasticMISwithCourseSec(Request $request){
        //
        //$request->classProg
        

        $section = $request->classYr . $request->classSec;
        $course = $request->classProg;
 
      $scholinfo= DB::table('scholinfos')->where('section', '=', $section)->where('course','=', $course)->where('archieve',null)->orderBy('surname')->paginate(10); 

       /*     $scholinfo= DB::table('scholinfos')->where('section', '=', $section)->where('course','=', $course)->orWhere(function($q) {
            $q->where('archieve', '0')->where('archieve',null);
        })->when(request('search'), function($query) {
                $query->where('firstname', 'like', '%' . request('search') . '%')->orWhere('surname', 'like', '%' . request('search') . '%')
                ->orWhere('student_number', 'like', '%' . request('search') . '%')
               ;})->orderBy('surname')->paginate(10);  */



/* $scholinfo= DB::table('scholinfos')->where('section', '=', $section)->where('course','=', $course)->orWhere(function($q) {
    $q->where('archieve', '0')
    ->where('archieve',null);
}); 

$search = $request->search;

if($search !== "") 
{

    $search = $request->search;

    
  $scholinfo = $scholinfo->where('firstname','LIKE',"%{$search}%")
        ->orWhere('student_number', 'like',"%{$search}%"); 
} 

$schols = $scholinfo->orderBy('surname')->paginate(10);
 */
return response()->json($scholinfo);
   
}


public function PerGradesofStudentsSRMS(Request $request){

    

}


}
