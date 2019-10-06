<?php
class UserController extends BaseController {


    public function getProfileDetails()
    {
        $data = Input::get();
        $rules = array
        (
            'token' => 'required'
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
            $userObj = User::where('app_token', $data['token'])->first();
            if ($userObj)
            {
               $count = Apps::where('user_id',$userObj->id)->count();
              $applimit=0;
                if(($count>$userObj->app_limit)||($count==$userObj->app_limit))
               {
                   $applimit=1;
                }
               $message = " Result Here..";
               return Response::json(array('error' => false, 'message' => $message, 'userprofile' => $userObj->toArray(),'appscreated'=>$count,'applimit'=>$applimit), 200);
            }
            else
            {
                $message=" Your token is expired..";
                return Response::json(array('error' => false,'message' => $message),200);
            }
        }
    }


}