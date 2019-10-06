<?php

use Illuminate\Support\Facades\Input;
class AlbumController extends BaseController {


    public function showList()
    {
        $data = Input::all();
        if((trim($data['category'])!="")&&(trim($data['category'])!="")) {
            $albums = DB::table('app_album')
                ->where('category',$data['category'])
                ->orderBy('id', 'desc')
                ->paginate(10)->toJson();
        }
        else
        {
            $albums = DB::table('app_album')
                ->orderBy('id', 'desc')
                ->paginate(10)->toJson();
        }
return $albums;


    }





}
