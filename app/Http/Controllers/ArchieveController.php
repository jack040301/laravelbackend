<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GradesheetInfo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArchieveController extends Controller
{
    //


    public function archievegradesheet(Request $request, $profid){

    
 $gradesheet = DB::table('gradsheetinfo')
 ->where([
    ['professorID', '=', $profid],
    ['archieve', '=', '1'],])->when(request('search'), function($query) {
        $query->where('course_short', 'like', '%' . request('search') . '%')->orWhere('gradesheetid', 'like', '%' . request('search') . '%')
        ->orWhere('course_year', 'like', '%' . request('search') . '%')->orWhere('course_section', 'like', '%' . request('search') . '%');
    })->paginate(10);
      
    if ($gradesheet) {
        return response()->json($gradesheet
        );
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Sorry, couldnt get the archieve files',
        ], 500);
    } 

    }

    public function archievescholastic(){
       
        $scholinfo = DB::table('scholinfos')->where('archieve', '1')
        ->when(request('search'), function($query) {
            $query->where('student_number', 'like', '%' . request('search') . '%')
            ->orwhere('firstname', 'like', '%' . request('search') . '%')->orWhere('surname', 'like', '%' . request('search') . '%')
            ->orWhere('course', 'like', '%' . request('search') . '%')
            ->orWhere('section', 'like', '%' . request('search') . '%')
            ->orWhere('srms_id', 'like', '%' . request('search') . '%');
        })->paginate(10);
      
        if ($scholinfo) {
            return response()->json($scholinfo
            );
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, couldnt get the archieve files',
            ], 500);
        } 
    
     
 
     }

     public function archieveeval(){

        $evalform = DB::table('evaluation_forms')->where('archieve', '1')
        ->when(request('search'), function($query) {
            $query->where('status_of_ef', 'like', '%' . request('search') . '%')
            ->orWhere('srms_id', 'like', '%' . request('search') . '%')
            ->orWhere('evalform_id', 'like', '%' . request('search') . '%');})->paginate(10);
      
        if ($evalform) {
            return response()->json($evalform
           );
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, couldnt get the archieve files',
            ], 500);
        } 
    

            //archieve query of evaluation
     }


     public function gradesheetunArchieve(Request $request, $gradesheetid){
       
        $gsunarchieve = DB::table('gradsheetinfo')
        ->where('gradesheetid', $gradesheetid)
        ->update(['archieve' => null,
                ]);

        return response()->json($gsunarchieve);

     }


     //update

     //archieve schol
     public function scholarch(Request $request,$srms_id){
        $studentarch = DB::table('scholinfos')
        ->where('srms_id', $srms_id)
        ->update(['archieve' => '1'
                ]);

        return response()->json($studentarch);

     }

     //unarchieve schol

     public function unarchieveSchol(Request $request,$srms_id){
        $studentarch = DB::table('scholinfos')
        ->where('srms_id', $srms_id)
        ->update(['archieve' => null,
                ]);

        return response()->json($studentarch);

     }


     public function pdfconversion($data,Request $request){

        $pdf = PDF::loadView('file.pdf', ['data' => $data]);
        return $pdf->output();


     }
}
