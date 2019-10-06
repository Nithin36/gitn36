<?php

use Illuminate\Support\Facades\Input;


class BuilderController extends BaseController {

public function actionUploadGallery() 
{ 
$data = Input::get(); 
$rules = array
(
  'token' => 'required',
  'app_id' => ['required','numeric'],
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
$userObj = User::where('app_token', $data['token'])->first();
 if ($userObj) 
{
$base_url = base_path();
$data = Input::all();
$id=$data['app_id'];
$url_arr=array();
$url_str="";
$files=Input::file("photo");
if(!empty($files))
{
foreach($files as $file):
if ($file->isValid())
{
$mime = $file->getMimeType();
 if(($mime=="image/jpeg")||($mime=="image/png")||($mime=="image/bmp"))
{

$extension =$file->getClientOriginalExtension();
$compresseed_image_path =  $base_url."/tmp_img/"; 
$filename= "IMG_" .rand(100000, 999999) .".". $extension;
$file->move($compresseed_image_path,$filename);
$destinationPath = "/gallery_images/".$id.'/'.$filename;
$compresseed_image_path = $compresseed_image_path.$filename; 
$client = new OvhSwiftLaravel(); 
if($client->filePut($compresseed_image_path,$destinationPath)) 
{
$appImg_obj = new AppImages();
$img_path = Config::get('globals.CDN_URL'); //'https://storage.uk1.cloud.ovh.net/v1/AUTH_962f0d922e3040c88db4b54fa5cfd469/madhu';
$appImg_obj->image_path = $img_path.$destinationPath;
$appImg_obj->image_type ="from_gallery";
$appImg_obj->app_id =$id;
$appImg_obj->page_id = "";
if ($appImg_obj->save()) 
{
$img_path = $img_path.$destinationPath;
File::Delete($compresseed_image_path);
//$url_str=$url_str.$img_path.",";
array_push($url_arr,$img_path);
}
} 
else
{
//$url_str=$url_str.$img_path.",";
	array_push($url_arr,'');
}
}
else
{
//$url_str=$url_str.",";
	array_push($url_arr,'');
}
}
else
{
	array_push($url_arr,'');
//$url_str=$url_str.",";
}	
endforeach;	
$message="Upload Sucess..";
return Response::json(array('error' => false,'urlarray' => $url_arr,'message' => $message,'status' => 1),200);
}
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}
}   
}

// public function actionUploadGallery() 
// { 
// $data = Input::get(); 
// $rules = array
// (
//   'token' => 'required',
//   'app_id' => ['required','numeric'],
// );
// $validator = Validator::make($data, $rules);
// if ($validator->fails()) 
// {
// $message="Some thing went wrong..";
// $validation_errors=$validator->messages()->toArray();
// return Response::json(array('error' => true,'message' => $message,'validationerror' => $validation_errors),200);
// }
// else
// {
// $userObj = User::where('app_token', $data['token'])->first();
//  if ($userObj) 
//  {
//  $base_url = base_path();

// $data = Input::all();

// foreach(Input::file("photo") as $file)
// {
//     //process each file
// }
// $id=$data['app_id'];
// if (Input::file('photo')->isValid())
// {
// $mime = Input::file('photo')->getMimeType();
// if(($mime=="image/jpeg")||($mime=="image/png")||($mime=="image/bmp"))
// {
// $extension = Input::file('photo')->getClientOriginalExtension();
// //$main_controller = new MainController();
// $compresseed_image_path =  $base_url."/tmp_img/"; 
//  //$compresseed_image_path =  public_path('/tmp_img');
// $filename= "IMG_" .rand(100000, 999999) .".". $extension;
// Input::file('photo')->move($compresseed_image_path,$filename);
// //$destinationPath = "/gallery_images/".$id.'/';
// $destinationPath = "/gallery_images/".$id.'/'.$filename;
// $compresseed_image_path = $compresseed_image_path.$filename; 
// $client = new OvhSwiftLaravel(); 
// if($client->filePut($compresseed_image_path,$destinationPath)) 
// {
// $appImg_obj = new AppImages();
// $img_path = Config::get('globals.CDN_URL'); //'https://storage.uk1.cloud.ovh.net/v1/AUTH_962f0d922e3040c88db4b54fa5cfd469/madhu';
// $appImg_obj->image_path = $img_path.$destinationPath;
// $appImg_obj->image_type ="from_gallery";
// $appImg_obj->app_id =$id;
// $appImg_obj->page_id = "";
// if ($appImg_obj->save()) 
// {
// $img_path = $img_path.$destinationPath;
// File::Delete($compresseed_image_path);
// $messages="Sucessfully saved ";
// return Response::json(array('error' => false,'messages' => $messages,'url' => $img_path,'status' => 1),200);
// }
// } 
// else
// {
// $messages="Not saved ";
// $cloud="Not saved to cloud..";
// return Response::json(array('error' => true,'messages' => $messages,'cloudmessage' => $cloud,'url' =>'','status' => 0),200);
// }
// }
// else
//  {
// $messages="Invalid image type. only jpeg,png,bmp..";
// $cloud=" ";
// return Response::json(array('error' => true,'messages' => $messages,'cloudmessage' => $cloud,'url' => '','status' => 0),200);
// }   
// }
// else
// {
// $messages="Something Wrong..";
// $cloud=" ";
// return Response::json(array('error' => true,'messages' => $messages,'cloudmessage' => $cloud,'url' => '','status' => 0),200);
// }
// }
// else
// {
// $message=" Your token is expired..";
// return Response::json(array('error' => false,'message' => $message),200);
// }
// }   
// }

public function actionUploadLogo() 
{ 
$data = Input::get(); 
$rules = array
(
  'token' => 'required',
  'app_id' => ['required','numeric'],
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
$userObj = User::where('app_token', $data['token'])->first();
 if ($userObj) 
 {
 $base_url = base_path();

$data = Input::all();
$id=$data['app_id'];
if (Input::file('photo')->isValid())
{
$mime = Input::file('photo')->getMimeType();
if(($mime=="image/jpeg")||($mime=="image/png")||($mime=="image/bmp"))
{
$extension = Input::file('photo')->getClientOriginalExtension();
//$main_controller = new MainController();
$compresseed_image_path =  $base_url."/tmp_img/"; 
 //$compresseed_image_path =  public_path('/tmp_img');
$filename= "IMG_" .rand(100000, 999999) .".". $extension;
Input::file('photo')->move($compresseed_image_path,$filename);
//$destinationPath = "/gallery_images/".$id.'/';
$destinationPath = "/builder_logo/".$id.'/'.$filename;
$compresseed_image_path = $compresseed_image_path.$filename; 
$client = new OvhSwiftLaravel(); 
if($client->filePut($compresseed_image_path,$destinationPath)) 
{

$img_path = Config::get('globals.CDN_URL'); //'https://storage.uk1.cloud.ovh.net/v1/AUTH_962f0d922e3040c88db4b54fa5cfd469/madhu';

$img_path = $img_path.$destinationPath;
File::Delete($compresseed_image_path);
$messages="Sucessfully saved ";
return Response::json(array('error' => false,'messages' => $messages,'url' => $img_path,'status' => 1),200);

} 
else
{
$messages="Not saved ";
$cloud="Not saved to cloud..";
return Response::json(array('error' => true,'messages' => $messages,'cloudmessage' => $cloud,'url' =>'','status' => 0),200);
}
}
else
 {
$messages="Invalid image type. only jpeg,png,bmp..";
$cloud=" ";
return Response::json(array('error' => true,'messages' => $messages,'cloudmessage' => $cloud,'url' => '','status' => 0),200);
}   
}
else
{
$messages="Something Wrong..";
$cloud=" ";
return Response::json(array('error' => true,'messages' => $messages,'cloudmessage' => $cloud,'url' => '','status' => 0),200);
}
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}
}   
}


public function actionUploadIcon() 
{ 
$data = Input::get(); 
$rules = array
(
  'token' => 'required',
  'app_id' => ['required','numeric'],
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
$userObj = User::where('app_token', $data['token'])->first();
 if ($userObj) 
 {
 $base_url = base_path();

$data = Input::all();
$id=$data['app_id'];
if (Input::file('photo')->isValid())
{
$mime = Input::file('photo')->getMimeType();
if(($mime=="image/jpeg")||($mime=="image/png")||($mime=="image/bmp"))
{
$extension = Input::file('photo')->getClientOriginalExtension();
//$main_controller = new MainController();
$compresseed_image_path =  $base_url."/tmp_img/"; 
 //$compresseed_image_path =  public_path('/tmp_img');
$filename= "IMG_" .rand(100000, 999999) .".". $extension;
Input::file('photo')->move($compresseed_image_path,$filename);
//$destinationPath = "/gallery_images/".$id.'/';
$destinationPath = "/builder_icon/".$id.'/'.$filename;
$compresseed_image_path = $compresseed_image_path.$filename; 
$client = new OvhSwiftLaravel(); 
if($client->filePut($compresseed_image_path,$destinationPath)) 
{

$img_path = Config::get('globals.CDN_URL'); //'https://storage.uk1.cloud.ovh.net/v1/AUTH_962f0d922e3040c88db4b54fa5cfd469/madhu';

$img_path = $img_path.$destinationPath;
File::Delete($compresseed_image_path);
$messages="Sucessfully saved ";
return Response::json(array('error' => false,'messages' => $messages,'url' => $img_path,'status' => 1),200);

} 
else
{
$messages="Not saved ";
$cloud="Not saved to cloud..";
return Response::json(array('error' => true,'messages' => $messages,'cloudmessage' => $cloud,'url' =>'','status' => 0),200);
}
}
else
 {
$messages="Invalid image type. only jpeg,png,bmp..";
$cloud=" ";
return Response::json(array('error' => true,'messages' => $messages,'cloudmessage' => $cloud,'url' => '','status' => 0),200);
}   
}
else
{
$messages="Something Wrong..";
$cloud=" ";
return Response::json(array('error' => true,'messages' => $messages,'cloudmessage' => $cloud,'url' => '','status' => 0),200);
}
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}
}   
}



public function getUploadedAudio() 
{
$data = Input::get(); 
$rules = array
(
  'token' => 'required'
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
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
$client = new OvhSwiftLaravel();
$folder='tones';
$array = array();
 foreach($client->fileList()as $obj)
{
 if((dirname($obj->getName()))==$folder)
{
$arr=explode('/',$obj->getName());
array_push($array,end($arr));
}
}
$message="Result here..";
return Response::json(array('error' => true,'message' => $message,'audios'=> $array),200);
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);	
}	
}

}


public function uploadVideo() 
{
$data = Input::get(); 
$rules = array
(
  'token' => 'required',
  'url' => 'required',
  'appid' => ['required','numeric']

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
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
$videoObj = new Videos();
if ($data['url']) 
{
$url_arr = explode("=", $data['url']);
$url = "https://www.youtube.com/embed/" . $url_arr[count($url_arr) - 1];
$videoObj->url = $url;
$videoObj->app_id = $data['appid'];
if ($videoObj->save()) 
{
//return json_encode(array("success" => true, 'msg' => 'Video saved successfully.', 'url' => $url, 'id' => $videoObj->id));
$message="Video saved successfully.";
return Response::json(array('error' => false,'message' => $message, 'url' => $url, 'id' => $videoObj->id),200);
}
} 
else 
{
$message="Video Url cannot be blank.";
return Response::json(array('error' => true,'message' => $message, 'url' => '', 'id' => ''),200);
//return json_encode(array("success" => false, 'msg' => 'Video Url cannot be blank'));
}
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}

}

}

    /* Funciton to Delete Youtube video's in sidebar */

public function deleteVideo() 
{
$data = Input::get(); 
$rules = array
(
  'token' => 'required',
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
	$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
if (Videos::destroy($data['id'])) 
{
//return json_encode(array("success" => true, 'msg' => 'Video deleted successfully'));
$message="Video deleted successfully";
return Response::json(array('error' => false,'message' => $message),200);
} 
else 
{

$message=" Somthing went wrong..";
return Response::json(array('error' => true,'message' => $message),200);
}
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);

}

}
}


   public function requestCreateSubdomain() {
$data = Input::get(); 
$rules = array
(
  'token' => 'required',
  'appid' => ['required','numeric'],
  'subdomain' => 'required'
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
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
$status=$this->createAppSubdomain($data['subdomain'], $data['appid']);
$message="Sucessfully created..";
return Response::json(array('error' => false,'message' => $message,'subdomain'=>$data['subdomain'],'status' => $status),200);
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}
}
}

public function createAppSubdomain($sd_input, $app_id) 
{
$app_obj = new Apps();
$app = $app_obj->find($app_id);
if ($app->subdomain == $sd_input) 
{
return ['status' => 'true'];
}
$validate_sd = $this->validateSubdomainInput($sd_input);
if ($validate_sd['status'] === 'false') 
{
return $validate_sd;
}
if ($app->subdomain !== $sd_input) 
{
$main_controller = new MainController();
            /* Load Cpanel Info */
$main_domain = $main_controller->getMainDomain();            //get main domain name
$cpanel_user = $main_controller->getCpanelUser();       //get cpanel username
$cpanel_pass = $main_controller->getCpanelPassword();   //get cpanel password
$cpanel_skin = $main_controller->getCpanelSkin();       //get cpanel skin
$main_application_dir = $main_controller->getMainApplicationDir();       //main application dir from public_html
$subdomain_dir = $main_application_dir . '/' . $app->ref_id;
            //Delete previous subdomain
$this->deleteSubdomain($app->subdomain, $main_domain, $cpanel_user, $cpanel_pass, $cpanel_skin);
//Create new subdomain
$this->createSubdomain($sd_input, $main_domain, $cpanel_user, $cpanel_pass, $cpanel_skin, $subdomain_dir);
//Save subdomain name in the database
$this->saveSubdomain($app, $sd_input);
return ['status' => 'true'];
}
}

public function saveSubdomain($app_obj, $subdomain) 
{
$app_obj->subdomain = $subdomain;
$app_obj->save();
}

public function validateSubdomainInput($subdomain) 
{
if ($subdomain == '') 
{
return ['status' => 'false', 'message' => 'You can not enter blank subdomain'];
}
$app_obj = new Apps();
$app = $app_obj->where('subdomain', $subdomain)->get();
if (count($app) > 0) 
{
return ['status' => 'false', 'message' => $subdomain . ' subdomain has already taken by someone else, please try different.'];
}
if (!preg_match("/[^A-Za-z0-9\!]/", $subdomain)) 
{
return ['status' => true];
}
return ['status' => 'false', 'message' => 'Invalid characters entered, special characters are not allowed'];
}

    /* Function for deleting subdomain  
     * @param $subdomain (String) => Input subdomain that we want to delete
     * return true/false
     */

    public function deleteSubdomain($subdomain, $rootDomain, $cPanelUser, $cPanelPass, $cPanelSkin) {
        $build_request = "/frontend/" . $cPanelSkin . "/subdomain/dodeldomain.html?domain=" . $subdomain . "_" . $rootDomain;

        $open_socket = fsockopen('localhost', 2082);
        if (!$open_socket) {
            return "Socket Error";
            exit();
        }

        $auth_string = $cPanelUser . ":" . $cPanelPass;
        $auth_pass = base64_encode($auth_string);
        $build_headers = "GET " . $build_request . "\r\n";
        $build_headers .= "HTTP/1.0\r\n";
        $build_headers .= "Host:localhost\r\n";
        $build_headers .= "Authorization: Basic " . $auth_pass . "\r\n";
        $build_headers .= "\r\n";

        fputs($open_socket, $build_headers);
        while (!feof($open_socket)) {
            fgets($open_socket, 128);
        }
        fclose($open_socket);

        // delete subdomain directory
        /* For deleting subdomain directory 
          $pass_shell = "rm -rf /home/" . $cPanelUser . "/public_html/" . $sub_domain_name;
          system($pass_shell);
         * 
         */
        return true;
    }

    /* Function for creating new subdomain in the system
     * @param $subdomain (String) => Input subdomain that we want to create in the system
     * return true/false
     */

    public function createSubdomain($subdomain, $rootDomain, $cPanelUser, $cPanelPass, $cPanelSkin, $subdomainDir) {
        $buildRequest = "/frontend/" . $cPanelSkin . "/subdomain/doadddomain.html?rootdomain=" . $rootDomain . "&domain=" . $subdomain . "&dir=" . $subdomainDir;
        $openSocket = fsockopen('localhost', 2082);
        if (!$openSocket) {
            return "Socket error";
            exit;
        }
        $authString = $cPanelUser . ":" . $cPanelPass;
        $authPass = base64_encode($authString);
        $buildHeaders = "GET " . $buildRequest . "\r\n";
        $buildHeaders .= "HTTP/1.0\r\n";
        $buildHeaders .= "Host:localhost\r\n";
        $buildHeaders .= "Authorization: Basic " . $authPass . "\r\n";
        $buildHeaders .= "\r\n";
        fputs($openSocket, $buildHeaders);
        //while(!feof($openSocket)) {
        fgets($openSocket, 128);
        //}
        fclose($openSocket);
        $newDomain = "http://" . $subdomain . "." . $rootDomain . "/";
        return $subdomain;
    }



    public function deleteGalleryPhoto() 
    {

   $data = Input::get(); 
$rules = array
(
  'token' => 'required',
  'id' => 'required',
  'appid' => ['required','numeric']
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
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
$client = new OvhSwiftLaravel(); 
$flag=0;
$ovi_image_path_org = Input::get("id"); 
$ovi_image_path = str_replace('https://pull-440.5centscdn.com/v1/AUTH_962f0d922e3040c88db4b54fa5cfd469/madhu/', '', $ovi_image_path_org);
$appImg_obj = new AppImages();
$img_obj = $appImg_obj->where('image_path', $ovi_image_path_org)->first(); //dd($ovi_image_path_org);
if($img_obj)
{
$app_obj = new Apps();
$app = $app_obj->find(Input::get("appid"));
if($app)
{ 	
$main_controller = new MainController();
        //print_r($app);
$app_dir_path = $main_controller->getAppDirPath($app->ref_id);
$contents = File::get($app_dir_path."/index.html");
$newcontent="";
$find='<li data-src="'.$img_obj->image_path.'"><img src="'.$img_obj->image_path.'"></li>';
if(strpos( $contents, $find ) !== false ) 
{
$flag=1;
$replacecontent=str_replace("$find"," ","$contents");
}
else
{
$find='<li data-src="'.$img_obj->image_path.'"><img src="'.$img_obj->image_path.'" style="width:100%;"></li>';
if(strpos( $contents, $find ) !== false )
{
$flag=1;
$replacecontent=str_replace("$find"," ","$contents");
}
}
if($flag==1)
{
File::put($app_dir_path."/index.html", $replacecontent);
}
if($img_obj) 
{
if ($img_obj->delete() && $client->fileDelete($ovi_image_path) ) 
{
$message="Sucessfully deleted..";
return Response::json(array('error' => false,'message' => $message),200);
}
else
{
$message=" Something Wrong..";
return Response::json(array('error' => true,'message' => $message),200);
}    
}
else
{
$message=" Something Wrong..";
return Response::json(array('error' => true,'message' => $message),200);
}
}
else
{
$message=" Something Wrong..";
return Response::json(array('error' => true,'message' => $message),200);
} 
}
else
{
$message=" image not found..";
return Response::json(array('error' => true,'message' => $message),200);
}   
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}   
}
}



public function listContacts()
{

$data = Input::all();
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
 
 $usercontact_obj = new UserContact();
$usercontact = $usercontact_obj->where('userid', '=', $userObj->id)->first();
// //return json_encode($usercontact);
$message=" Result Here..";
 return Response::json(array('error' => false,'message' => $message,'usercontact'=>$usercontact->toArray()),200);

 

}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}

}


public function addAddress()
{

$data = Input::all();
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
$usercontact_obj = new UserContact();
 $usercontact_obj2 = new UserContact(); 
$count = $usercontact_obj->where('userid', '=', $userObj->id)->count();
if($count!=0)
{

$arr=array('street' => $data['street'],'userid' => $userObj->id,'city' => $data['city'],'state' => $data['state'],'country' => $data['country'],'zip' => $data['zip']);
$usercontact_obj->where('userid', '=', $userObj->id)->update($arr);
$usercontact= $usercontact_obj->where('userid', '=', $userObj->id)->first();
}
else
{
 $usercontact_obj2->street = $data['street'];
 $usercontact_obj2->userid = $userObj->id;
 $usercontact_obj2->city = $data['city'];
 $usercontact_obj2->state = $data['state'];
 $usercontact_obj2->country = $data['country'];
 $usercontact_obj2->zip = $data['zip'];
 $usercontact_obj2->save();
 $usercontact = $usercontact_obj->find($usercontact_obj2->id);
}
$message=" Result Here..";
return Response::json(array('error' => false,'message' => $message,'usercontact'=>$usercontact->toArray()),200);
}
else
{
  $message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}

}


public function addContact()
{

$data = Input::all();
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
 $usercontact_obj = new UserContact();
$count = $usercontact_obj->where('userid', '=', $userObj->id)->count();
 if($count!=0)
 {

 $arr=array('email' => $data['email'],'website' => $data['website'],'con_number' => $data['cnumber'],'userid' =>$userObj->id);
$usercontact_obj->where('userid', '=', $userObj->id)->update($arr);
$usercontact= $usercontact_obj->where('userid', '=', $userObj->id)->first();
 }
else
 {
 $usercontact_obj2 = new UserContact(); 
$usercontact_obj2->email = $data['email'];
$usercontact_obj2->con_number = $data['cnumber'];
$usercontact_obj2->website = $data['website'];
 $usercontact_obj2->userid = $userObj->id;
 $usercontact_obj2->save();
 $usercontact = $usercontact_obj->find($usercontact_obj2->id);
 }
 $message=" Result Here..";
 return Response::json(array('error' => false,'message' => $message,'usercontact'=>$usercontact->toArray()),200);
}
else
{
  $message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}

}


public function addSociallink()
{

$data = Input::all();
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
$usercontact_obj = new UserContact();
$count = $usercontact_obj->where('userid', '=', $userObj->id)->count();
if($count!=0)
{

$arr=array('facebook' => $data['facebook'],'youtube' => $data['youtube'],'instagram' => $data['instagram'],'google' => $data['google'],'pininterest' => $data['pinterest'],'userid' => $userObj->id);
$usercontact_obj->where('userid', '=', $userObj->id)->update($arr);
$usercontact= $usercontact_obj->where('userid', '=', $userObj->id)->first();
}
else
{
$usercontact_obj2 = new UserContact(); 
$usercontact_obj2->facebook = $data['facebook'];
$usercontact_obj2->youtube = $data['youtube'];
$usercontact_obj2->instagram = $data['instagram'];
$usercontact_obj2->google = $data['google'];
$usercontact_obj2->pininterest = $data['pinterest'];


$usercontact_obj2->userid = $userObj->id;
$usercontact_obj2->save();
$usercontact = $usercontact_obj->find($usercontact_obj2->id);
}
$message=" Result Here..";
return Response::json(array('error' => false,'message' => $message,'usercontact'=>$usercontact->toArray()),200);
}
else
{
  $message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}

}


}
