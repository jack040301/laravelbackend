<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Gradeofstudent;
use App\GradesheetInfo;
use Illuminate\Support\Facades\DB;


use Validator;




class GradesheetController extends Controller
{
    //
    public function addgradestudent(Request $request){

        $request->validate([
            'studNum' => 'required',
            'studFN' => 'required',
            'studLN' => 'required',
            'studMI' => 'required',
            'studMG' => 'required',
            'studFG' => 'required',
            'finalgrade' => 'required',
            'gradesheetid' => 'required',

        ]);

        $studentname = $request->studLN . " ". $request->studFN  . " ". $request->studMI;
  

  /*       $gradetable = new Gradeofstudent;
        $gradetable->gradesheetid  = $request->gradesheetid;
        $gradetable->student_number  = $request->studNum;
        $gradetable->studentname  = Str::upper($studentname);
        $gradetable->midterm  = $request->studMG;
        $gradetable->finalterm  = $request->studFG;
        $gradetable->finalgrade  = $request->finalgrade;
        $gradetable->save();
 */


$create = DB::table('gradeofstudents')->insert(
    ['gradesheetid' => $request->gradesheetid, 
    'student_number' =>  $request->studNum,
    'studentname'  => Str::upper($studentname),
    'midterm'  => $request->studMG,
    'finalterm'  => $request->studFG,
    'finalgrade'  => $request->finalgrade,
]);


       // return response()->json(['message'=>'grade added successfully']);

        return response()->json($create);
    }


    public function addgradesheetinfo(Request $request){
     
  
        $request->validate([
            'subjCode' => 'required',
            'subjDesc' => 'required',
            'subjSem' => 'required',
            'subjSY_start' => 'required',
            'subjSY_end' => 'required',
            'subjUnit' => 'required',
            'subjTime' => 'required',
            'subjDay' => 'required',
            'classProg' => 'required',
            'classYr' => 'required',
            'classSec' => 'required',

        ]); 

        $gradesheetid = Str::uuid();

        $gradetable = new GradesheetInfo;
        $gradetable->gradesheetid  =Str::upper($gradesheetid);
        $gradetable->subjectcode  =  Str::upper($request->subjCode);
        $gradetable->subjectdesc  = Str::upper($request->subjDesc);
        $gradetable->semester  = Str::upper($request->subjSem);
        $gradetable->sem_startyear  = Str::upper($request->subjSY_start);
        $gradetable->sem_endyear  = Str::upper($request->subjSY_end);
        $gradetable->units  = Str::upper($request->subjUnit);
        $gradetable->time  = Str::upper($request->subjTime);
        $gradetable->day  = Str::upper($request->subjDay);
        $gradetable->course_short  =Str::upper($request->classProg);
        $gradetable->course_year  = Str::upper($request->classYr);
        $gradetable->course_section  = Str::upper($request->classSec);
        $gradetable->professorID  =$request->profID;

        

        $gradetable->save();


    

        if ($gradetable) {
            return response()->json(['message'=>'grade added successfully']);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, grades could not be updated',
            ], 500);
        }
 
    }


    public function showgradesheet(){
      
        $gradesheet = GradesheetInfo::all();

        return response()->json($gradesheet);
      
     

    }

    //gradesheetpage

    public function showgsbyid(Request $request,$gradesheetid){
      
       // $gradesheet = GradesheetInfo::find($gradesheetid);
        $gradesheet = DB::table('gradsheetinfo')->where('gradesheetid', $gradesheetid)->get();
        return response()->json($gradesheet);
      
     //WAG KALIMUTAN LAGYAN NG REQUEST PARA MAKUHA YUNG SHEET

    }

    //gradesheetcardper professor

    public function gradesheetcardprof(Request $request, $profid){

        $gradesheetprof = DB::table('gradsheetinfo')->where('professorID', $profid)->get();
        return response()->json($gradesheetprof);

    }
    //

    public function archievegradesheet(Request $request, $gradesheetid){



        $gradetable = DB::table('gradsheetinfo')->where('gradesheetid', $gradesheetid)->limit(1)->update([
            'archieve' => $request->status_archieve,

        ]);

      //  $grades = DB::table('gradsheetinfo')->where('gradesheetid', $gradesheetid)->limit(1)->get();

     
            return response()->json([
                'success' => true,
                'grades' =>$gradesheetid
            ]);
      


    }


    public function updategradesheetinfo(Request $request,$gradesheetid){


  

                $grades = GradesheetInfo::where('gradesheetid', '=', $gradesheetid)->firstOrFail();   

                $updated = $grades->update($request->all());

                if ($updated) {
                    return response()->json([
                        'success' => true,
                        'grades' => $grades
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Sorry, cook could not be updated',
                    ], 500);
                }


    }

    //patch method
    public function addgs(Request $request,$id)
    {

        $this->validate($request,[
            'student_number' => 'required',
            'studentname' => 'required',
            'midterm' => 'required',
            'finalterm' => 'required',
            'finalgrade' => 'required',
            'gradesheetid' => 'required',

        ]);
  

    //    $requestData = $request->all();


  

    $gradeofstudent = DB::table('gradeofstudents')
    ->where('id', $id)
    ->update(['student_number' => $request->student_number,
    'studentname' => $request->studentname,
    'midterm' => $request->midterm,
    'finalterm' => $request->finalterm,
    'finalgrade' => $request->finalgrade,
//    'archieve' =>$request->arch
            ]);

    return response()->json($gradeofstudent);
    
   

    
            //return response()->json(['message'=>'successfull update']);

  /* foreach( $requestData as $key=>$datainside){

          /*   $data = new Gradeofstudent;
            $data->student_number  = $datainside->student_number;
            $data->gradesheetid =  $datainside->$gradesheetid;
            $data->studentname  = $datainside->studentname;
            $data->midterm  = $datainside->midterm;
            $data->finalterm  = $datainside->finalterm;
            $data->finalgrade  = $datainside->finalgrade;
            $data-save();

            } 
 */
           // Gradeofstudent::query()->update(['student_number' => 0, 'column2' => 'New']);

             // Gradeofstudent::upsert($requestData);
 //             Gradeofstudent::upsert($requestData,["name"],["value"]);
 

        //Gradeofstudent::update(array_merge($request->all(), ['midterm' => 'midterm']));
                
        
         
        

              /*   foreach ($requestData as $key => $data) {
                Gradeofstudent::create([
                'gradesheetid'       =>  $data->gradesheetid,
                'student_number'       =>  $data->student_number,
                'midterm'      =>  $data->midterm,
                'finalterm'         =>  $data->finalterm,
                'finalgrade' =>  $data->finalgrade,
                'studentname'     =>  $data->studentname
                ]);
            } */

        //return response()->json(['message'=>'grade added successfully']);


        
     }

     public function showspecgradesheet(Request $request,$gradesheetid){

      $gradesheet= DB::table('gradeofstudents')->where('gradesheetid', $gradesheetid)->orderBy('studentname')->get();

        return response()->json($gradesheet);



     }


     public function paginatecard(Request $request, $profid){


        /* $gradesheetprof = DB::table('gradsheetinfo')->where('professorID', $profid)->paginate(5);
        return response()->json($gradesheetprof); */


         return DB::table('gradsheetinfo')->where('professorID', $profid)->where('archieve', null)->orwhere('archieve', '0')->when(request('search'), function($query) {
            $query->where('course_short', 'like', '%' . request('search') . '%')->orWhere('subjectcode', 'like', '%' . request('search') . '%')
            ->orWhere('sem_startyear', 'like', '%' . request('search') . '%')->orWhere('sem_endyear', 'like', '%' . request('search') . '%');
        })->orderBy('gradesheetid', 'desc')->paginate(5); 

     }


  

}
