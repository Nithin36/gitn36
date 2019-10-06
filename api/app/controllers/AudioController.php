<?php

use Illuminate\Support\Facades\Input;
class AudioController extends BaseController {


    public function showList()
    {
     //   echo "nithin";
        $data = Input::all();
        if((trim($data['album'])!="")&&(trim($data['album'])!="")) {
            $audios = DB::table('app_audio')
                ->where('album',$data['album'])
                ->orderBy('id', 'desc')
                ->paginate(10)->toJson();
       }
        else
        {
           $audios = DB::table('app_audio')
               ->orderBy('id', 'desc')
                ->paginate(10)->toJson();
       }
        return $audios;


    }





}
