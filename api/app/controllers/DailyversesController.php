<?php

use Illuminate\Support\Facades\Input;
class DailyVersesController extends BaseController {


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (Input::file("slider")) {
            foreach (Input::file("slider") as $file) {
                //process each file

                $file_input = $file->getClientOriginalName();
                if ($file_input != '') {
                    $extension = $file->getClientOriginalExtension();
                    $arr = array("jpg", "jpeg", "png", "bmp", "JPG", "JPEG", "PNG");
                    if (in_array($extension, $arr)) {
                        $file_name = str_random(6) . '_' . $file_input;
                        $photo_upload_path = __DIR__ . '/../../upload/slider/';
                        $file->move($photo_upload_path, $file_name);
                        // move_uploaded_file($file->getClientFileName(), $photo_upload_path);
                        $slider_obj2 = new Slider();
                        $slider_obj2->slidername = 'hai';
                        $slider_obj2->sliderfile = $file_name;

                        $slider_obj2->save();

                        // return Response::json(array('error' => false, 'message' => $message), 200);
                    }

                }
            }
            $message = " Sucessfully addded..";
            return Response::json(array('error' => false, 'message' => $message), 200);
        } else
        {
            $message = "Some thing wrong.. ";
            return Response::json(array('error' => true, 'message' => $message), 200);
        }

    }

    public function pollUpdate()
    {
        //echo "nithin";
        $data = Input::get();

        $rules = array
        (

            'id' => ['required','numeric'],
            'yes' => 'numeric',
            'no' => 'required',
            'maybe' => 'required'

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
            $dailyverse_obj = new Dailyverse();
            $dailyversearr= $dailyverse_obj->find($data['id']);
            if(!empty($dailyversearr)) {
                $yes = $dailyversearr['yes'] + $data['yes'];
                $no = $dailyversearr['no'] + $data['no'];
                $maybe = $dailyversearr['maybe'] + $data['maybe'];
                $arr = array('yes' => $yes, 'no' => $no, 'maybe' => $maybe);
                $dailyverse_obj2 = new Dailyverse();
                $dailyverse_obj2->where('id', '=', $data['id'])->update($arr);
                $dailyverse = $dailyverse_obj2->where('id', '=', $data['id'])->first();
                $message = " Result Here..";
                return Response::json(array('error' => false, 'message' => $message, 'dailyverse' => $dailyverse->toArray()), 200);
            }
            else
            {
                $message = " Something went wrong..";
                return Response::json(array('error' => true, 'message' => $message), 200);
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
        $data = Input::all();
        if((trim($data['lang'])!="")&&(trim($data['date'])!="")) {
            $dailyverses = DB::table('app_dailyverse')
                ->where('versedate',$data['date'])
                ->where('language',$data['lang'] )
                ->orderBy('id', 'desc')
                ->paginate(10)->toJson();
        }
        elseif ((trim($data['lang'])!=""))
        {
            $dailyverses = DB::table('app_dailyverse')

                ->where('language',$data['lang'] )
                ->orderBy('id', 'desc')
                ->paginate(10)->toJson();
        }
        elseif ((trim($data['vdate'])!=""))
        {
            $dailyverses = DB::table('app_dailyverse')
                ->where('versedate',$data['vdate'])
                ->orderBy('id', 'desc')
                ->paginate(10)->toJson();
        }
        else
        {
            $dailyverses = DB::table('app_dailyverse')
                ->orderBy('id', 'desc')
                ->paginate(10)->toJson();
        }
        return $dailyverses;



    }



    public function destroy()
    {
        //echo base_path();

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
            $slider_obj = new Slider();
            $slider =  $slider_obj->find($data['id']);
            if(!empty($slider))
            {
                $path = base_path() . '/upload/slider/' . $slider['sliderfile'];
                File::delete($path);
                $slider->delete();
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
