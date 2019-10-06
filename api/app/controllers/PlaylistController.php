<?php

use Illuminate\Support\Facades\Input;
class PlaylistController extends BaseController {


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {



            $playlist_obj = new Playlist();

            $playlist= $playlist_obj->orderBy('id', 'desc')->get();

            $message=" Result Here..";
            return Response::json(array('error' => false,'message' => $message,'playlists'=>$playlist),200);



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
            $playlist_obj = new Playlist();

            $arr=array('url' => $data['url']);
            $playlist_obj->where('id', '=', $data['id'])->update($arr);
            $playlist= $playlist_obj->where('id', '=', $data['id'])->first();
            $message=" Result Here..";
            return Response::json(array('error' => false,'message' => $message,'playlist'=>$playlist->toArray()),200);


        }
    }



}
