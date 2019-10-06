<?php

use Illuminate\Support\Facades\Input;
class LivetvController extends BaseController {



	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
        $data = Input::get();

        $rules = array
        (

            'id' => ['required','numeric'],

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

            $data = Input::all();
            $liveyoutube_obj = new Liveyoutube();

            $livetv= $liveyoutube_obj->where('id', '=', $data['id'])->first();
            $message=" Result Here..";
            return Response::json(array('error' => false,'message' => $message,'livetv'=>$livetv->toArray()),200);


        }
	}



	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
	    //echo "nithin";
       $data = Input::get();

    $rules = array
     (
         'url' => 'required',
        'id' => ['required','numeric'],

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

           $data = Input::all();
          $liveyoutube_obj = new Liveyoutube();

           $arr=array('url' => $data['url']);
           $liveyoutube_obj->where('id', '=', $data['id'])->update($arr);
          $livetv= $liveyoutube_obj->where('id', '=', $data['id'])->first();
           $message=" Result Here..";
           return Response::json(array('error' => false,'message' => $message,'livetv'=>$livetv->toArray()),200);


       }
	}



}
