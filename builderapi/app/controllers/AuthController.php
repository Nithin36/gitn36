<?php

class AuthController extends BaseController {

/*
User Signup
*/

public function actionSignup() {

$data = Input::get();
$input['email'] = $data['email'];
$data['app_limit'] = 7;
$rules = array(
'email' => ['unique:tbl_users,email','required','email'],
'name' => 'required',
'industry' => ['required','numeric'],
'password' => 'required');
$validator = Validator::make($data, $rules);
if ($validator->fails()) 
{
//$messages = "Some thing went wrong...";
$messages = $validator->messages();
if ($messages->has('email'))
{
$messages=$messages->first('email');
}
else
{
$messages = "Some thing went wrong...";
}   
return Response::json(array('error' => true,'messages' => $messages),200);
}
else
{

$userObj = new User($data);
$userObj->password = Hash::make($data['password']);
    $days=13;
    $subscription_end_date = Date('Y-m-d', strtotime("+" . $days . " days"));
    $userObj->subscription_end_date = $subscription_end_date;
if ($userObj->save())
{
$mainObj = new MainController();
$activationObj = new ActivationLink();
$activationObj->id = $userObj->id;
$usercontact_obj2 = new UserContact();
$usercontact_obj2->log_title = 'ALBUMS';
$usercontact_obj2->userid = $userObj->id;
$usercontact_obj2->save();
$uniqid = uniqid();
$activationObj->activation_link = $uniqid;
if ($activationObj->save()) 
{
$email = $input['email'];
    //$mainObj->getExactUrl(
//$activate_account_link = $mainObj->getExactUrl()."/activate-account/" . $uniqid;
    $activate_account_link = "https://appreview4u.com/activation.php?actid=".$uniqid;
$view = "layouts/activate-account";
$data = array('activate_account_link' => $activate_account_link,);
$to = $email;
$subject = "Activate Account";
if (strpos($to, 'gmail') !== false)
{
$view2="layouts/welcome-account";
$subject2="Welcome To Float Album";
$mainObj2 = new MainController();
//$mainObj2->sendMail($view2, $data, $to, $subject2);
}
   // sleep(5);test@floatalbums.com
    $mainObj3 = new MainController();
//$mainObj3->sendMail($view, $data, $to, $subject);
   // $message='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> <html lang="en"> <head> <meta http-equiv="content-type" content="text/html; charset=utf-8"> <title>Title Goes Here</title> </head> <body> <p><a href="'.$activate_account_link.'">Activation link</a></p> </body> </html>';
    $message='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="margin: 0; padding: 0;" >
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
        <td bgcolor="#ffffff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table" style="    border: 1px solid #f1eeee;
    padding: 12px;">
                <tbody><tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tbody><tr>
                                <td>
                                    <!-- HERO IMAGE -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="padding-copy">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                            <img src="https://www.floatalbums.com/assets/images/170.png"  border="0" style="display: block; padding: 0; color: #666666; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px; " class="img-max">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #000; padding-top: 30px; float: left;" class="padding-copy">
                                                HI,</td>
                                        </tr>

                                        <tr>
                                            <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #000; padding-top: 30px;" class="padding-copy">
                                                Thanks for signing up with Floatalbums</td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #000;" class="padding-copy">
                                                Click the button below to activate  account</td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- BULLETPROOF BUTTON -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                        <tbody><tr>
                                            <td align="center" style="padding: 25px 0 0 0;" class="padding-copy">
                                                <table border="0" cellspacing="0" cellpadding="0" class="responsive-table">
                                                    <tbody><tr>
                                                        <td align="center"><a href="'.$activate_account_link.'" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #5D9CEC; border-top: 15px solid #5D9CEC; border-bottom: 15px solid #5D9CEC; border-left: 25px solid #5D9CEC; border-right: 25px solid #5D9CEC; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;" class="mobile-button">Activate Account →</a></td>
                                                    </tr>
                                                    </tbody></table>
                                            </td>
                                        </tr>
                                        </tbody></table>
                                </td>


                            </tr>
                            </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- COPY -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                                <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding-copy"></td>
                            </tr>
                            <tr>
                                <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #000;" class="padding-copy">
                                    Kind regards Float album team..</td>
                            </tr>
                            </tbody></table>
                    </td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    </tbody></table>
</body>
</html>';
    //Normal headers
    $subject = "Float Albums Activation Link";
    $headers  = 'From:info@floatalbums.com' . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";



    mail($to, $subject, $message, $headers);
//end mail
$messages='Confirmation link sent to your email. Please activate your account and login.';
return Response::json(array('error' => false,'messages' => $messages),200);
}
else
{
$messages = "Some thing went wrong";
return Response::json(array('error' => true,'messages' => $messages),200);
}
     
}
else
{
$messages = "Some thing went wrong";
return Response::json(array('error' => true,'messages' => $messages),200);
}

}
}


/*
User Login
*/
public function actionLogin() 
{

$data = Input::get();
$rules = array(
'email' => ['required','email'],
'password' => 'required');
$validator = Validator::make($data, $rules);
if ($validator->fails()) 
{
$messages = "Some thing went wrong...";
return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
}
else
{
$email = $data['email'];
$password = $data['password'];

$userObj = User::where('email', $email)->first();
if ($userObj) 
{
if (Hash::check($password, $userObj->password)) 
{
$status = $userObj->status;
if ($status == 1) 
{
if (Auth::attempt(array('email' => $email, 'password' => $password, 'status' => 1))) 
{
$messages = "Successfull Login..!";
//Session::put('id', $userObj->id);
if(trim($userObj->app_token)=="")
{
$token=Hash::make($userObj->id);
$userObj->app_token=$token;
$userObj->save();
}
	

return Response::json(array('error' => false,'messages' => $messages,'token' =>$userObj->app_token),200);
} 
else 
{
$messages = "Invalid Username or Password";
return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
}
} 
else 
{
$messages = "Account not activated. Please activate your account";
return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
}
} 
else 
{
$messages = "Invalid Username or Password";
return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
}
} 
else 
{
$messages = "Invalid Username or Password";
return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
}
}
}


/*
User token authentication
*/
public function tokenAuthentication() 
{

$data = Input::get();
$rules = array('email' => ['required','email'],
'token' => 'required');
$validator = Validator::make($data, $rules);
if ($validator->fails()) 
{
$messages = "Some thing went wrong...";
return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
}
else
{

	if (!Hash::check(Auth::id(),$data['token'])) 
{

	
 $email = $data['email'];


 $userObj = User::where('email', $email)->first();
if ($userObj) 
 {
 	
 if (Hash::check($userObj->id,$data['token'])) 
 {

 $status = $userObj->status;
 if ($status == 1) 
 {
// if (Auth::attempt(array('email' => $email, 'password' => $userObj->password 'status' => 1))) 
// {
// $messages = "Successfull Login..!";
// return Response::json(array('error' => false,'messages' => $messages,'token' =>Hash::make($userObj->id)),200);
// } 
// else 
// {
// $messages = "Invalid Username or Password";
// return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
// }
 } 
else 
 {
 $messages = "Account not activated. Please activate your account";
 return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
 }
} 
 else 
 {
 $messages = "Invalid Username or Password";
 return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
 }
 } 
 else 
 {
 $messages = "Invalid Username or Password";
 return Response::json(array('error' => true,'messages' => $messages,'token' =>''),200);
 }
}
else
{
$message=" Your token is not expired..";
return Response::json(array('error' => false,'message' => $message),200);
}	
}
}
/*
User Forgot Password
*/
public function actionForgetPassword() 
{

$input['email'] = Input::get('email');
$validator = Validator::make($input, array('email' => 'required|email'));
if ($validator->fails())
{
$messages = $validator->messages();
return Response::json(array('error' => true,'messages' => $messages->first('email')),200);
} 
else 
{
$email = $input['email'];
$userObj = User::where('email', $email)->first();
if($userObj)
{
$mainObj = new MainController();
$resetPasswordObj = new ResetPassword();
$resetPasswordObj->email = $email;
$uniqid = uniqid();
$resetPasswordObj->reset_link = $uniqid;
if ($resetPasswordObj->save()) 
{
$reset_link = $mainObj->getExactUrl() . "/auth/reset-password/" . $uniqid;
$view = "layouts/reset-password";
$data = array('reset_link' => $reset_link,);
$to = $email;
$subject = "Reset Password";
//$mainObj->sendMail($view, $data, $to, $subject);
    $message='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body style="margin: 0; padding: 0;" >
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tbody><tr>
        <td bgcolor="#ffffff" align="center" style="padding: 70px 15px 70px 15px;" class="section-padding">
            <table border="0" cellpadding="0" cellspacing="0" width="500" class="responsive-table" style="border: 1px solid #f1eeee;
                   padding: 12px;">
                <tbody><tr>
                    <td>
                        <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tbody><tr>
                                <td>
                                    <!-- HERO IMAGE -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody>
                                        <tr>
                                            <td class="padding-copy">
                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td>
                                                            <img src="https://www.floatalbums.com/assets/images/170.png"  border="0" style="display: block; padding: 0; color: #666666; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px; " class="img-max">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- COPY -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tbody><tr>
                                            <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding-copy"></td>
                                        </tr>
                                        <tr>
                                            <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #000;" >
                                                Click the Reset password button below to set new password. If this was not you , please disregard this email</td>
                                        </tr>
                                        </tbody></table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- BULLETPROOF BUTTON -->
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="mobile-button-container">
                                        <tbody><tr>
                                            <td align="center" style="padding: 25px 0 0 0;" class="padding-copy">
                                                <table border="0" cellspacing="0" cellpadding="0" class="responsive-table">
                                                    <tbody><tr>
                                                        <td align="center"><a href="'.$reset_link.'" target="_blank" style="font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #5D9CEC; border-top: 15px solid #5D9CEC; border-bottom: 15px solid #5D9CEC; border-left: 25px solid #5D9CEC; border-right: 25px solid #5D9CEC; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;" class="mobile-button">Reset  Password →</a></td>
                                                    </tr>
                                                    </tbody></table>
                                            </td>
                                        </tr>
                                        </tbody></table>
                                </td>


                            </tr>
                            </tbody></table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!-- COPY -->
                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tbody><tr>
                                <td align="center" style="font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;" class="padding-copy"></td>
                            </tr>
                            <tr>
                                <td align="center" style="padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #000;" class="padding-copy">
                                    Kind regards Float album team..</td>
                            </tr>
                            </tbody></table>
                    </td>
                </tr>
                </tbody></table>
        </td>
    </tr>
    </tbody></table>
</body>
</html>';
    //Normal headers
    $subject = "Float Albums  Reset Password";
    $headers  = 'From:info@floatalbums.com' . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";



    mail($to, $subject, $message, $headers);
}
$messages='Reset password link sent to your registered email.';
return Response::json(array('error' => false,'messages' => $messages),200);
}
else
{
$messages=' Your email is not registerd...';
return Response::json(array('error' => false,'messages' => $messages),200);
}
}
}





}
