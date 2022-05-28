<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EvaluationForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;




class EvaluationFormController extends Controller
{
    //


    //show,search,count


    public function EvalShow(Request $request){


       /*  $allevalform = DB::table('evaluation_forms')
            ->leftJoin('scholinfos', 'evaluation_forms.srms_id', '=', 'scholinfos.srms_id')
            ->get();
 */

        //$allevalform = EvaluationForm::all();


        $allevalform = DB::table('evaluation_forms')
        ->leftJoin('scholinfos', 'evaluation_forms.srms_id', '=', 'scholinfos.srms_id')->where('evaluation_forms.archieve', null)->orwhere('evaluation_forms.archieve', '0')->when(request('search'), function($query) {
            $query->where('firstname', 'like', '%' . request('search') . '%')->orWhere('surname', 'like', '%' . request('search') . '%')
            ->orWhere('student_number', 'like', '%' . request('search') . '%')
            ->orWhere('evalform_id', 'like', '%' . request('search') . '%')
            ->orWhere('course', 'like', '%' . request('search') . '%')
            ->orWhere('section', 'like', '%' . request('search') . '%');})
        ->paginate(10);


        //three tables


        return response()->json($allevalform);
    }

    //creation ng account
    public function enrollmentdb(){

      /*   $finalArray = [];
       
        $gradesheetid = Str::uuid(); */

      
        
        $student_detail = DB::connection('mysql2')->table("tblstudents")->select('studentNumber', 'studentType')
        ->when(request('search'), function($query) {
            $query->where('studentNumber', 'like', '%' . request('search') . '%')
            ->orWhere('studentType', 'like', '%' . request('search') . '%');
        })->paginate(10);

/* 
        $batch = array();
        foreach($student_detail as $items){
            $student_number = $items->studentNumber;
            $batch[] = array('student_number' => $student_number);
        } */
       // $merged = $student_detail->merge($data);
     //   $finalArray = array_merge($data, $$arr1);


        //$result = $merged->all();

return response()->json($student_detail);

    }


    public function enrolldbprof(Request $request){
       $data = $request->user()->professorID;

      // $userID = auth()->user()->email; 
      $userEmail = auth()->user()->id; 

      $data2 = 22002;

     // $student_detail = DB::connection('mysql2')->table("tblaccounts")->leftjoin('tblprofessors', 'tblaccounts.accountID', '=', 'tblprofessors.accountID')->where('professorID','=',$data)->get();

    $student_detail = DB::connection('mysql2')->table("tblprofessorsubjects")->leftjoin('tblsubjects', 'tblprofessorsubjects.subjectCode', '=', 'tblsubjects.subjectCode')
    ->leftjoin('tblsubjectschedules', 'tblprofessorsubjects.scheduleID', '=', 'tblsubjectschedules.scheduleID')
    ->leftjoin('tblcoursedetails', 'tblsubjectschedules.courseID', '=', 'tblcoursedetails.courseID')->where('tblprofessorsubjects.professorID','=',$data)->get();



    $batch = array();
    foreach($student_detail as $items){
        $subjectcode = $items->subjectCode;
        $subjectdesc = $items->subjectDescription;
        $semester = $items->semester;
        $sem_start = $items->schoolYear;
    //    $sem_end = $items->;
        $units = $items->subjectUnits;
        $starttime = $items->startTime;
        $endtime = $items->endTime;

        $day = $items->day;
        $course = $items->courseDescription;
        $course_year = $items->year;
        $course_section = $items->section;
     //   $professor = $items->;
      //  $facultyrank = $items->;




        $batch[] = array('gradesheetid' =>  $gradesheetid = Str::uuid(), 'subjectcode' => $subjectcode, 'subjectdesc' => $subjectdesc,'semester' => $semester,
        'sem_start' => $sem_start,'units' => $units,'starttime' => $starttime,'endtime' => $endtime,'day' => $day,'course' => $course,'course_year' => $course_year,
        'course_section' => $course_section);

    }


    return response()->json($batch);

        
    }


    public function insertEval(Request $request){


            $evalid = Str::random(40);

        $evaldetails = DB::table('eval_details')->insert(
            ['evalform_id' => $evalid, 
            'subjectcode' =>  $request->subjcode,
            'subjectdesc'  =>$request->subjdesc,
            'grade'  => $request->studGrade,
            'units'  => $request->studUnits,
            'finalgrade'  => $request->finalgrade,
        ]);


        $evalform = DB::table('evaluation_forms')->insert(
            ['evalform_id' => $evalid, 
            'status_of_ef' =>  $request->status,
            'gradesheetid' =>  '',
            'srms_id' => $request->srms_id

            //add total column for fg x units
        ]);
        
    return response()->json($evaldetails);
            


    }


    public function getEvalTablePerStudent(Request $request,$srms_id){
        
      
        $perstudenteval = DB::table('evaluation_forms')->where('srms_id',$srms_id)->get();

         return response()->json($perstudenteval);


    }


    public function getEvalFormGradePerEvalid(Request $request,$eval_id){
        
      
        $evalperID = DB::table('eval_details')->where('evalform_id',$eval_id)->get();

         return response()->json($evalperID);


    }

    public function evalTopView(Request $request, $srms_id){

        $topview = DB::table('evaluation_forms')
        ->leftJoin('scholinfos', 'evaluation_forms.srms_id', '=', 'scholinfos.srms_id')
        ->leftJoin('scholstudents', 'scholinfos.srms_id', '=', 'scholstudents.srms_id')->where('scholinfos.srms_id',$srms_id)->get();

        return response()->json($topview);

    }

    public function getsrmsid(Request $request,$studentnumber){
        $getsrmsid = DB::table('users')
        ->leftJoin('scholinfos', 'users.student_number', '=', 'scholinfos.student_number')
        ->where('scholinfos.student_number',$studentnumber)->get('srms_id');


        return response()->json($getsrmsid);

        
    }
}
