<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SendGrid;
use App\ProfessorAccount;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Auth\Events\PasswordReset;


class EmailController extends Controller
{
    //

    public function sendemailconcern(Request $request){

        $validated = $request->validate([
       
            'senderMsg' => 'required',
            'senderEmail' => 'required|email',
            'senderName' => 'required',
          
        ]);

        $sendername = $validated['senderName'];

        $from = $validated['senderEmail'];
     
    //    $addresses = EmailListing::all();
     
   
        $emailContent = $validated['senderMsg'];

        $email = new \SendGrid\Mail\Mail(); 
        $email->setFrom($from, $sendername);
        $email->setSubject("ESCORD UCC CONCERN");
        $email->addTo("ucc.escord@gmail.com", "UCC ESCORD");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html",  $emailContent
        );
        $sendgrid = new \SendGrid(getenv('SENDGRID_API_KEY'));
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }   


    }



    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json(["msg" => "Invalid/Expired url provided."], 401);
        }
    
        $user = ProfessorAccount::findOrFail($user_id);
    
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
    
        //return redirect()->to('/');
        return response()->json(["msg" => "REDIRECT."]);

    }
    
    public function resend() {
     /*    if (auth()->user()->hasVerifiedEmail()) {
            return response()->json(["msg" => "Email already verified."], 400);
        }
    
        auth()->user()->sendEmailVerificationNotification();
    
        return response()->json(["msg" => "Email verification link sent on your email id"]); */
    }


    public function forgotpassword(){
        
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $token = str_random(64);
    
          DB::table('password_resets')->insert(
              ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
          );
    
         /*  Mail::send('customauth.verify', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Reset Password Notification');
          }); */
    
          return back()->with('message', 'We have e-mailed your password reset link!');
      }

      public function sendPasswordResetLink(Request $request)
            {
    return $this->sendResetLinkEmail($request);
        }

        protected function sendResetLinkResponse(Request $request, $response)
            {
         return response()->json([
        'message' => 'Password reset email sent.',
        'data' => $response
            ]);
        }

        protected function sendResetLinkFailedResponse(Request $request, $response)
        {
    return response()->json(['message' => 'Email could not be sent to this email address.']);


    }


    public function callResetPassword(Request $request)
{
    return $this->reset($request);
}

protected function resetPassword($user, $password)
{
    $user->password = Hash::make($password);
    $user->save();
    event(new PasswordReset($user));
}


protected function sendResetResponse(Request $request, $response)
{
    return response()->json(['message' => 'Password reset successfully.']);
}
/**
 * Get the response for a failed password reset.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  string  $response
 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
 */
protected function sendResetFailedResponse(Request $request, $response)
{
    return response()->json(['message' => 'Failed, Invalid Token.']);
}



}
