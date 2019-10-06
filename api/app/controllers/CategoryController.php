<?php

use Illuminate\Support\Facades\Input;
class CategoryController extends BaseController {


    public function showList()
    {
        $categories = DB::table('app_category')
            ->orderBy('id', 'desc')->get();

        //return $categories;
$message="Result Here";
       return Response::json(array('error' => false,'message' => $message,'categories'=>$categories),200);

    }





}
