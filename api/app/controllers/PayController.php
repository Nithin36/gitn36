<?php

use Illuminate\Support\Facades\Input;

class PayController extends BaseController {

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //echo "nithin";
        $data = Input::all();


        $rules = array
        (


            'planid' => 'required|numeric',
            'userid' => 'required|numeric',
            'orderid' => 'required'


        );
        $validator = Validator::make($data, $rules);
        if ($validator->fails())
        {
            $message="Some thing went wrong..";
            $validation_errors=$validator->messages()->toArray();
            return Response::json(array('error' => true,'message' => $message,'validationerror' => $validation_errors),200);
        }
        else
        {
            $user = new User();
          $pay_date = Date('Y-m-d');
            $user_obj=$user->find($data['userid']);
           $courseplan = new Courseplan();
          $courseplan_obj=$courseplan->find($data['planid']);
            $course = new Course();
            $courseid=$courseplan_obj->course;
            $course_obj=$course->find($courseid);
           $pay_obj = new Paylog();
            $pay_obj->planid = $data['planid'];
          $pay_obj->userid = $data['userid'];
            $pay_obj->orderid = $data['orderid'];
            $pay_obj->username = $user_obj->name;
           $pay_obj->planname = $courseplan_obj->name;
            $pay_obj->amount = $courseplan_obj->price;
            $pay_obj->paydate = $pay_date;
           $pay_obj->courseid = $course_obj->id;
            $pay_obj->coursename = $course_obj->name;
            $pay_obj->coursestatus = $course_obj->online;


            if($pay_obj->save())
            {
                $coursetype="Online";
                if($course_obj->online==0)
                {
                    $coursetype="Offline";
                }
                $message='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sohmi-Payment Details</title>
</head>
	<body>
		<h2>Payment Details</h2>

		<p>
			<table style="width:100%" border="1">
  <tr>
    <th>Name</th>
    <th>Course Type</th> 
    <th>Course</th> 
    <th>Amount</th>
  </tr>
  <tr style="text-align: center;">
    <td>'.$user_obj->name.'</td>
     <td>'.$coursetype.'</td> 
    <td>'.$course_obj->name.'</td> 
    <td>'.$courseplan_obj->price.'</td>
  </tr>
  
</table>
		</p>
	</body>
</html>';
                $mainObj = new MainController();
                $to = $user_obj->email;
                $servermail=$mainObj->getFromEmail();
                $subject = "Payment Details";
                //$mainObj->sendMail($view, $data, $to, $subject);
                //$servermail="";
                //Normal headers
                $subject = "Sohmi Payment Details";
                $headers  = "From: ".$servermail."\r\n";
                $headers .= 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                mail($to, $subject, $message, $headers);
                //$to  = $userObj->email;
                  $message = " Sucessfully added ..";

               return Response::json(array('error' => false, 'message' => $message), 200);
           }
           else
           {
                $message="Some thing went wrong..";

               return Response::json(array('error' => true,'message' => $message),200);
          }
        }
    }





}
