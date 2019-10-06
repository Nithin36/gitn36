<?php

use Illuminate\Support\Facades\Input;

class EventController extends BaseController {

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


            'title' => ['required'],
            'sdate' => ['required'],
            'edate' => ['required'],
            'description' => ['required'],

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
           $flag=0;
            $file_name ="";

            if (Input::hasFile('event'))
            {
                $extension = Input::file('event')->getClientOriginalExtension();
                $arr = array("jpg", "jpeg", "png", "bmp", "JPG", "JPEG", "PNG");
                if (in_array($extension, $arr)) {


                    $file_name = str_random(6) . '_' . $_FILES['event']['name'];
                    $photo_upload_path = __DIR__ . '/../../upload/event/' . $file_name;

                    move_uploaded_file($_FILES["event"]["tmp_name"], $photo_upload_path);
                    $flag=1;
                }
                else
                {
                    $flag=2;
                }

            }
              $event_obj = new Newsevent();
              $event_obj->title = $data['title'];
              $event_obj->sdate = $data['sdate'];
              $event_obj->edate = $data['edate'];
              $event_obj->description = $data['description'];
              $event_obj->photo= $file_name;

           if($event_obj->save())
           {
               if(($flag==1)||($flag==0))
               {
                   $message = " Sucessfully added..";
               }
               else
               {
                   $message = " Sucessfully addded But image is invalid";
               }
               return Response::json(array('error' => false, 'message' => $message), 200);
           }
else
    {
        $message="Some thing went wrong..";

        return Response::json(array('error' => true,'message' => $message),200);
    }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
        $events = DB::table('app_event')
            ->orderBy('id', 'desc')
            ->paginate(10)->toJson();

        return $events;
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
        $data = Input::get();;


       $rules = array
       (
           'id' => ['required'],
           'title' => ['required'],
           'sdate' => ['required'],
           'edate' => ['required'],
           'description' => ['required'],

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



           $event_obj = new Newsevent();

           $event =  $event_obj->find($data['id']);
           if(!empty($event)) {

            $file_name =$event['photo'];
             // $file_input = $_FILES['event']['name'];
               if (Input::hasFile('event'))
               {
                $extension = Input::file('event')->getClientOriginalExtension();
                 $arr = array("jpg", "jpeg", "png", "bmp", "JPG", "JPEG", "PNG");
                  if (in_array($extension, $arr)) {

                    if(file_exists('upload/event/'.$event['photo']))
                     {
                           $path=base_path().'/upload/event/'.$event['photo'];
                          File::delete($path);
                      }
                      $file_name = str_random(6) . '_' . $_FILES['event']['name'];
                       $photo_upload_path = __DIR__ . '/../../upload/event/' . $file_name;

                      move_uploaded_file($_FILES["event"]["tmp_name"], $photo_upload_path);

                 }


              }

                $arr = array('title' => $data['title'], 'sdate' => $data['sdate'], 'edate' => $data['edate'], 'description' => $data['description'], 'photo' => $file_name);
               $event_obj->where('id', '=', $data['id'])->update($arr);

               $message = " Sucessfully Updated..";
                return Response::json(array('error' => false, 'message' => $message), 200);
           }
            else
           {
               $message="Some thing went wrong..";
               return Response::json(array('error' => true,'message' => $message),200);
           }
       }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy()
    {
        $data = Input::get();
        $rules = array
        (

            'id' => ['required','numeric']
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
            $event_obj = new Newsevent();
            $event =  $event_obj->find($data['id']);
            if(!empty($event))
            {
                if(file_exists('upload/event/'.$event['photo']))
                {
                    $path=base_path().'/upload/event/'.$event['photo'];
                    File::delete($path);
                }
                $event->delete();
                $message = " Sucessfully Deleted..";
                return Response::json(array('error' => false, 'message' => $message), 200);
            }
            else
            {
                $message = "Something Wrong.. ";
                return Response::json(array('error' => true, 'message' => $message), 200);
            }
        }
    }





}
