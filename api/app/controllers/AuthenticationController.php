<?php

use Illuminate\Support\Facades\Input;
class AuthenticationController extends BaseController {



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */


    public function actionSignup() {
        $data = Input::get();

        $rules = array(
            'email' => 'required|email|unique:app_user',
            'mobno' => 'required',
            'password' => 'required',
            'name' => 'required'
        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $message="Some thing went wrong..";
            $validation_errors=$validator->messages()->toArray();
            return Response::json(array('error' => true,'message' => $message,'validationerror' => $validation_errors),200);
        } else {
            $userObj = new User($data);
            $userObj->password = base64_encode($data['password']);
            $userObj->password2 = Hash::make($data['password']);

            if ($userObj->save()) {
                $message = " Sucessfully Signup..";
                return Response::json(array('error' => false, 'message' => $message), 200);
            }
            else
            {
                $message = " Something went wrong..";
                return Response::json(array('error' => true, 'message' => $message), 200);
           }

        }
    }


    public function actionLogin() {
        $email = Input::get('email');
        $password = Input::get('password');
        $userObj = User::where('email', $email)->first();
        if ($userObj) {
            if ((Hash::check($password, $userObj->password2))&&(base64_encode($password)==$userObj->password)) {
                $message = " Sucessfully Signin..";
                return Response::json(array('error' => false, 'message' => $message, 'loginid' => $userObj->id,'name' => $userObj->name,'email' => $userObj->email,'mobno' => $userObj->mobno), 200);
            } else {
                $message = " UnAuthorised to login ..";
                return Response::json(array('error' => true, 'message' => $message), 200);
            }
        } else {
            $message = " UnAuthorised to login ..";
            return Response::json(array('error' => true, 'message' => $message), 200);
        }
    }

    public function actionForgetPassword() {
        $input['email'] = Input::get('email');
        $validator = Validator::make($input, array('email' => 'required|email'));
        if ($validator->fails()) {
            $message="Some thing went wrong..";
            $validation_errors=$validator->messages()->toArray();
            return Response::json(array('error' => true,'message' => $message,'validationerror' => $validation_errors),200);
        } else {
            $email = $input['email'];
            $userObj = User::where('email', $email)->first();
            if($userObj)
            {
               // $userObj2 = User::where('email', $email)->first();


                $mainObj = new MainController();
    //            $view = "auth/remainder";
//                $data = array(
//                    'email' => $userObj->email,
//                    'password' => base64_decode($userObj->password)
//                );
                $message='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sohmi-Account Details</title>
</head>
	<body>
		<h2>Account Details</h2>

		<p>
			UserName:  ' .$email .'<br/>
			Password:   ' .base64_decode($userObj->password) .' <br/>
		</p>
	</body>
</html>';
                $to = $email;
                $servermail=$mainObj->getFromEmail();
                $subject = "Reset Password";
                //$mainObj->sendMail($view, $data, $to, $subject);

                //Normal headers
                $subject = "Sohmi-Forgot Password Details";
                $headers  = 'From:'.$servermail . "\r\n";
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                $to  = $userObj->email;

               if (!mail($to, $subject, $message, $headers))
                {
                    $message = "Try after sometime..";
                    return Response::json(array('error' => false, 'message' => $message), 200);
                } else {
                   $message = "Your password details are send to mail..";
                   return Response::json(array('error' => false, 'message' => $message), 200);
                }
                //$message = "Your password details are send to mail..";
               // return Response::json(array('error' => false, 'message' => $message), 200);
            }
            else
                {
                    $message = "Email id not found..";
                    return Response::json(array('error' => false, 'message' => $message), 200);
                }
        }
    }



}
