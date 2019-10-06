<?php

use Illuminate\Support\Facades\Input;
class PopupController extends BaseController {



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
            $popup_obj = new Popup();

            $popup= $popup_obj ->where('id', '=', $data['id'])->first();
            $message=" Result Here..";
            return Response::json(array('error' => false,'message' => $message,'popup'=>$popup->toArray()),200);


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

            $file_input = $_FILES['popup']['name'];
            if ($file_input != '') {
                $extension = Input::file('popup')->getClientOriginalExtension();
                $arr = array("jpg", "jpeg", "png", "bmp", "JPG", "JPEG", "PNG");
                if (in_array($extension, $arr)) {
            $popup_obj = new Popup();
                    $popup=$popup_obj->find($data['id']);
                    if(file_exists('upload/popup/'.$popup['image']))
                    {
                        $path=base_path().'/upload/popup/'.$popup['image'];
                        File::delete($path);
                    }
                    $file_name = str_random(6) . '_' . $_FILES['popup']['name'];
                    $photo_upload_path = __DIR__ . '/../../upload/popup/' . $file_name;

                    move_uploaded_file($_FILES["popup"]["tmp_name"], $photo_upload_path);

            $arr=array('image' => $file_name);
            $popup_obj->where('id', '=', $data['id'])->update($arr);
            $popup=$popup_obj->where('id', '=', $data['id'])->first();
            $message=" Result Here..";
            return Response::json(array('error' => false,'message' => $message,'popup'=>$popup->toArray()),200);
                } else {
                    $message = "only png,jpg images only..";
                    return Response::json(array('error' => false, 'message' => $message), 200);

                }

            }

        }
    }




}
