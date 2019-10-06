<?php

use Illuminate\Support\Facades\Input;

class PageController extends BaseController {

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

            if (Input::hasFile('page'))
            {
                $extension = Input::file('page')->getClientOriginalExtension();
                $arr = array("jpg", "jpeg", "png", "bmp", "JPG", "JPEG", "PNG");
                if (in_array($extension, $arr)) {


                    $file_name = str_random(6) . '_' . $_FILES['page']['name'];
                    $photo_upload_path = __DIR__ . '/../../upload/page/' . $file_name;

                    move_uploaded_file($_FILES["page"]["tmp_name"], $photo_upload_path);
                    $flag=1;
                }
                else
                {
                    $flag=2;
                }

            }
            $page_obj = new Page();
            $page_obj->title = $data['title'];
            $page_obj->description = $data['description'];
            $page_obj->photo= $file_name;

            if($page_obj->save())
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
    public function showList()
    {
        $events = DB::table('page')
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



            $page_obj = new  Page();

            $page =  $page_obj->find($data['id']);
            if(!empty($page)) {

                $file_name =$page['photo'];
                // $file_input = $_FILES['event']['name'];
                if (Input::hasFile('page'))
                {
                    $extension = Input::file('page')->getClientOriginalExtension();
                    $arr = array("jpg", "jpeg", "png", "bmp", "JPG", "JPEG", "PNG");
                    if (in_array($extension, $arr)) {

                        if(file_exists('upload/page/'.$page['photo']))
                        {
                            $path=base_path().'/upload/page/'.$page['photo'];
                            File::delete($path);
                        }
                        $file_name = str_random(6) . '_' . $_FILES['page']['name'];
                        $photo_upload_path = __DIR__ . '/../../upload/page/' . $file_name;

                        move_uploaded_file($_FILES["page"]["tmp_name"], $photo_upload_path);

                    }


                }

                $arr = array('title' => $data['title'], 'description' => $data['description'], 'photo' => $file_name);
                $page_obj->where('id', '=', $data['id'])->update($arr);
                $page2=  $page_obj ->where('id', '=', $data['id'])->first();

                $message = " Sucessfully Updated..";
                return Response::json(array('error' => false, 'message' => $message, 'page' => $page2->toArray()), 200);
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
            $page_obj = new Page();
            $page =  $page_obj->find($data['id']);
            if(!empty($page))
            {
                if(file_exists('upload/page/'.$page['photo']))
                {
                    $path=base_path().'/upload/page/'.$page['photo'];
                    File::delete($path);
                }
                $page->delete();
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
            $page_obj = new Page();

            $page= $page_obj ->where('id', '=', $data['id'])->first();
            $message=" Result Here..";
            return Response::json(array('error' => false,'message' => $message,'page'=>$page->toArray()),200);


        }



    }


}
