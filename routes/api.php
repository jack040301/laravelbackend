<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
   
 });
 Route::group(['middleware' => 'auth:sanctum'], function() {
    //logout session

  
    Route::post('/logout','AdminController@logout');
     //addgradesheetinfo
     

  });


  
   
   Route::get('/edb','EvaluationFormController@enrolldbprof')->middleware('auth:sanctum');



//paginatin
  Route::get('/paginatecard/{profid}','GradesheetController@paginatecard');
  


//gradesheet dashboard modal
  Route::post('/gradesheetinfo','GradesheetController@addgradesheetinfo');
 
 // gradesheet page modal
    Route::post('/gradesheetstudent','GradesheetController@addgradestudent');
  
    
    Route::get('/showgs/{gradesheetid}','GradesheetController@showgsbyid');


    Route::get('/showgs','GradesheetController@showgradesheet');

    Route::get('/displaygrade/{gradesheetid}','GradesheetController@showspecgradesheet');


    //gradesheet per prof card
    Route::get('/perprofcard/{gradesheetid}','GradesheetController@gradesheetcardprof');


    //this is for multirows patch method
    Route::put('/addgs/{id}','GradesheetController@addgs');

    //update  GRADESHEET
    Route::put('/updategs/{gradesheetid}','GradesheetController@updategradesheetinfo');

    //ARRCHIIEVE NG GRADESHEET PER ID
    Route::put('/archievegs/{gradesheetid}','GradesheetController@archievegradesheet');


   //SHOW NG ARCHEIVE NG GRADESHEET
    Route::get('/archievegs/{profid}','ArchieveController@archievegradesheet');
    Route::get('/archieveschol','ArchieveController@archievescholastic');


    Route::put('/unarchieveSchol','ArchieveController@unarchieveSchol');


    Route::put('/unarchieveGS/{gsid}','ArchieveController@gradesheetunArchieve');
   
    




//login of all account
Route::post('/adminlogin','AdminController@adminlogin');

Route::post('/userlogin','LoginController@login');



//Manager{{SuperAdmin API}}

//showing ng account
Route::get('/showuseraccount','AdminController@showuseraccount');
Route::get('/showadminaccount','AdminController@showadminaccount');
Route::get('/showprofaccount','AdminController@showprofaccount');


//GET THE COUNT OF TABLES

Route::get('/countProf','AdminController@countProf');
Route::get('/countStudent','AdminController@countStudent');
Route::get('/countStaff','AdminController@countStaff');


//


//creation of account
Route::post('/createaccadm','LoginController@createaccountAdmin');
Route::post('/createaccstud','LoginController@createaccountStudent');
Route::post('/createaccprof','LoginController@createProfessor');


//sending email concern

Route::post('/sendemail','EmailController@sendemailconcern');

//verification

Route::get('email/verify/{id}', 'EmailController@verify'); // Make sure to keep this as your route name

Route::get('email/resend', 'EmailController@resend');

 


//update of account 
//konting edit nalang
Route::put('/updateAdmin/{id}','AdminController@updateAccountAdmin');   
Route::put('/updateStudent/{id}','AdminController@updateAccountUser');
Route::put('/updateProf/{profid}','AdminController@updateAccountProf');   
Route::put('/updateManager/{id}','AdminController@updateAccountManager');   


//evaluation api
Route::get('/archieveevalform','ArchieveController@archieveeval');
Route::get('/evalform','EvaluationFormController@EvalShow');


//TRIAL FOR ENROLLMENT DB

Route::get('/enrolldb','EvaluationFormController@enrollmentdb');


///SCHOLASTIC RECORD 

//mis schol
Route::get('/perstudentschol/{studentnumber}','ScholasticRecordController@showscholastperStudent');


//get
Route::get('/studentCondition','ScholasticRecordController@showscolasticMISwithCourseSec');



Route::get('/showscolmis','ScholasticRecordController@showscolasticMIS');

//student schol
Route::get('/studentschol/{studentnumber}','ScholasticRecordController@scholstudent');


//update info
Route::put('/scholupdate/{srmsid}','ScholasticRecordController@scholupdate');

//update archieve

Route::put('/scholarch/{srmsid}','ArchieveController@scholarch');


//sendPasswordReset


Route::post('/SendCode','ForgotPassword@createCodeForForgetPassword');
Route::post('/updatePassword','ForgotPassword@UpdatePassword');


//evaluation post

Route::post('/evalCreate','EvaluationFormController@insertEval');

//student part evaltable

Route::get('/evalTableStudent/{gradesheetid}','EvaluationFormController@getEvalTablePerStudent');

Route::get('/evalPerevalID/{evalid}','EvaluationFormController@getEvalFormGradePerEvalid');


Route::get('/evalTopView/{srms_id}','EvaluationFormController@evalTopView');


//get srms id
Route::get('/getsrmsid/{studentnumber}','EvaluationFormController@getsrmsid');

