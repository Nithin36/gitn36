<?php

class CommonController extends BaseController {

public function allCategories()
{
$categories = Category::get();
if($categories->count()>0)
{
$message="Result here";
return Response::json(array('error' => false,'message' => $message,'categories'=>$categories->toArray()),200);
}
else
{
$message="No Result ";
return Response::json(array('error' => false,'message' => $message,'categories' => $categories->toArray()),200);
}
}



}
