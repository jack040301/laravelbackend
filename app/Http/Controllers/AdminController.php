<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
use App\User;
use App\Manager;
use App\ProfessorAccount;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    //
    //update of account ng admin

    public function updateAccountAdmin(Request $request, $id){
      

        $request->validate([
            'email' => 'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'student_number' => 'required',
            'password' =>'required',
            'confirmpass'=>'required|same:password|'
        ]);

       
       
    
     
  //      $input = $request->all();
        $admins = DB::table('admins')->where('id', $id)->limit(1)->update([
            'email' => $request->email,
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'student_number' => $request->student_number,
            'password' =>Hash::make($request->password)

        ]);
    
        

         return response()->json(['message'=>'successfull update']);
            
            
    }

//update of account ng user
public function updateAccountUser(Request $request, $id){
      

    $request->validate([
        'email' => 'required',
        'name'=>'required',
        'student_number' => 'required',
        'password' => 'required',
        'confirmpass' => 'required|same:password|',


    ]);

   
   
   // $name = $request->firstname . " ". $request->lastname;
 
//      $input = $request->all();
    $user = DB::table('users')->where('id', $id)->limit(1)->update([
        'email' => $request->email,
        'name' => $request->name,
        'student_number' => $request->student_number,
        'password' =>Hash::make($request->password)

    ]);

    

     return response()->json(['message'=>'successfull update']);
        
        
}



//update account prof 

public function updateAccountProf(Request $request, $profid){

    $request->validate([
        'email' => 'required',
        'firstname'=>'required',
        'middleinitial' => 'required',
        'lastname' => 'required',
        'faculty_rank' => 'required',
        'password' => 'required',
        'confirmpass' => 'required|same:password|',


    ]);

   
   
   // $name = $request->firstname . " ". $request->lastname;
 
//      $input = $request->all();

/* $request->validate([
    'email' => 'required',
    'firstname'=>'required',
    'middleinitial' => 'required',
    'lastname' => 'required',
    'faculty_rank' => 'required',
    'password' => 'required',
    'confirmpass' => 'required|same:password|',


]); */
    $user = DB::table('professor_accounts')->where('id', $profid)->limit(1)->update([
        'email' => $request->email,
        'firstname'=> $request->firstname,
        'middleinitial' =>  $request->middleinitial,
        'lastname' =>  $request->lastname,
        'faculty_rank' =>  $request->faculty_rank,
        'password' =>Hash::make($request->password)

    ]);

    

     return response()->json(['message'=>'successfull update']);

}



//update account prof 

public function updateAccountManager(Request $request, $managerid){



    $request->validate([
        'email' => 'required',
        'name'=>'required',
        'password' => 'required',
        'confirmpass' => 'required|same:password|',


    ]);

   
   
   // $name = $request->name . " ". $request->lastname;
 
//      $input = $request->all();

$request->validate([
    'name' => 'required',
    'email'=>'required',
    'password' => 'required',
    'confirmpass' => 'required|same:password|',


]);

    $user = DB::table('managers')->where('id', $managerid)->limit(1)->update([
        'email' => $request->email,
        'name'=> $request->name,
        'password' =>Hash::make($request->password)

    ]);

    

     return response()->json(['message'=>'successfull update']);

}


//login function



    public function adminlogin(Request $request) {
        $request->validate([
            'userEmail' => 'required',
            'userPassword' => 'required',
            'device_name' => 'required',
        ]);
     
        $countprof = ProfessorAccount::where('email', $request->userEmail)->limit(1)->count();

        $countMan =  Manager::where('email', $request->userEmail)->limit(1)->count();

        
        $user = ProfessorAccount::where('email', $request->userEmail)->first();

        if($user){

            
            if (! $user || ! Hash::check($request->userPassword, $user->password)) {
                throw ValidationException::withMessages([
                    'email' => ['Invalid Account Information.'],
                ]);
            } 
        }else{
          
            $user = Manager::where('email', $request->userEmail)->first();
    
          
            if (! $user || ! Hash::check($request->userPassword, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid Account Information.'],
            ]);
            

        }
            }

      return $user->createToken($request->device_name)->plainTextToken;


      
   
    
    
          
    }


    public function logout(Request $request){

        $request->user()->currentAccessToken()->delete();

        return response()->json([
           'message' => 'Successfully logged out'
        ]);
    }


    public function showadminaccount() {

        $admin = DB::table('admins')->when(request('search'), function($query) {
            $query->where('firstname', 'like', '%' . request('search') . '%')
            ->orWhere('lastname', 'like', '%' . request('search') . '%')
            ->orWhere('student_number', 'like', '%' . request('search') . '%')
            ;})->paginate(5);
        
        if(!$admin){
            return response()->json(['message'=>'couldnt get connect to the server']);
        }
        return response()->json($admin);
    }

    public function showuseraccount() {

        $user = DB::table('users')->when(request('search'), function($query) {
            $query->where('name', 'like', '%' . request('search') . '%')->orWhere('email', 'like', '%' . request('search') . '%')
            ->orWhere('student_number', 'like', '%' . request('search') . '%')
            ;})->paginate(5);


        if(!$user){
            return response()->json(['message'=>'couldnt get connect to the server']);
        }
        return response()->json($user);
    }


    public function showprofaccount() {

        $prof =  DB::table('professor_accounts')->when(request('search'), function($query) {
            $query->where('firstname', 'like', '%' . request('search') . '%')
            ->orWhere('lastname', 'like', '%' . request('search') . '%')
            ->orWhere('faculty_rank', 'like', '%' . request('search') . '%')
            ;})->paginate(5);

        if(!$prof){
            return response()->json(['message'=>'couldnt get connect to the server']);
        }
        return response()->json($prof);
    }


    public function countProf(){
        
     $prof =   DB::table('professor_accounts')->count();

     $stud =   DB::table('users')->count();
 
     $staff =   DB::table('admins')->count();

    


     return response()->json(['prof'=>$prof,
    'stud'=>$stud,
    'staff'=>$staff]);


    }

    public function countStudent(){

        $bscs = 'BS Computer Science';
        $bsit = 'BS Information Technology';
        $bsemc = 'BS Entertainment Multimedia Computing';
        $bsis = 'BS Information System';

     $bscstab=   DB::table('users')
     ->leftJoin('scholinfos', 'users.student_number', '=', 'scholinfos.student_number')->where('course', $bscs)->count();
    
     $bsittab=   DB::table('users')
     ->leftJoin('scholinfos', 'users.student_number', '=', 'scholinfos.student_number')->where('course', $bsit)->count();
    

     $bsistab=   DB::table('users')
     ->leftJoin('scholinfos', 'users.student_number', '=', 'scholinfos.student_number')->where('course', $bsis)->count();
    
     $bsemctab=   DB::table('users')
     ->leftJoin('scholinfos', 'users.student_number', '=', 'scholinfos.student_number')->where('course', $bsemc)->count();
    

     return response()->json(['bscs'=>$bscstab,
     'bsit'=>$bsittab,
     'bsis'=>$bsistab,
     'bsemc'=>$bsemctab]);


    }

    public function countStaff(){
     $staff =   DB::table('admins')->count();

     return response()->json($staff);

    }
}
