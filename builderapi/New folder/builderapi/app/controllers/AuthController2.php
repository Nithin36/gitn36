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
$activate_account_link = $mainObj->getExactUrl()."/activate-account/" . $uniqid;
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
    $mainObj3 = new MainController();
$mainObj3->sendMail($view, $data, $to, $subject);
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
 	echo "nithin2";
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
$mainObj->sendMail($view, $data, $to, $subject);
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
