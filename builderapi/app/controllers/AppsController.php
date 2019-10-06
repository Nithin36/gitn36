<?php

class AppsController extends BaseController {

/**
* 
*
* @return Show all user themes
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

 public function createAppSubdomain($sd_input, $app_id) 
 {
        //Validate the domain name
        $app_obj = new Apps();
        $app = $app_obj->find($app_id);
        if ($app->subdomain == $sd_input) {
            return ['status' => 'true'];
        }

        $validate_sd = $this->validateSubdomainInput($sd_input);
        if ($validate_sd['status'] === 'false') {
            return $validate_sd;
        }

        if ($app->subdomain !== $sd_input) {
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


       public function validateSubdomainInput($subdomain) {
        if ($subdomain == '') {
            return ['status' => 'false', 'message' => 'You can not enter blank subdomain'];
        }
        $app_obj = new Apps();
        $app = $app_obj->where('subdomain', $subdomain)->get();
        if (count($app) > 0) {
            return ['status' => 'false', 'message' => $subdomain . ' subdomain has already taken by someone else, please try different.'];
        }
        if (!preg_match("/[^A-Za-z0-9\!]/", $subdomain)) {
            return ['status' => true];
        }
        return ['status' => 'false', 'message' => 'Invalid characters entered, special characters are not allowed'];
    }


      public function saveSubdomain($app_obj, $subdomain) {
        $app_obj->subdomain = $subdomain;
        $app_obj->save();
    }


public  function showAllThemes()
{
$data = Input::get();
$rules = array('token' => 'required');
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
$user = Auth::user();
$theme_obj = new Theme();
$themes = $theme_obj->where('theme_category',$userObj->industry)->get();  
if($themes->count()>0)
{
$message="Result Here..";
}
else
{
$message=" No Result";
}      
$user_subscription_obj = new UserSubscription();
$app_limit_exeed_status = $user_subscription_obj->isUserAppLimitExceed($userObj->id,$userObj->app_limit);
if(!$app_limit_exeed_status)
{
$appmessage="Your app limit  is   exceeded";
return Response::json(array('error' => false,'message' => $message,'applimit'=>0,'appmessage'=>$appmessage,'themes'=>$themes->toArray()),200);
}
 else
{
$appmessage="Your app limit  is  not exceeded";
return Response::json(array('error' => false,'message' => $message,'applimit'=>1,'appmessage'=>$appmessage,'themes'=>$themes->toArray()),200);
}
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}
}
}

public function deleteSubdomain($subdomain, $rootDomain, $cPanelUser, $cPanelPass, $cPanelSkin) 
{
$build_request = "/frontend/" . $cPanelSkin . "/subdomain/dodeldomain.html?domain=" . $subdomain . "_" . $rootDomain;
$open_socket = fsockopen('localhost', 2082);
if (!$open_socket) 
{
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
while (!feof($open_socket)) 
{
fgets($open_socket, 128);
}
fclose($open_socket);
return true;
}
/**
* Show all user themes
*
* @return Response
*/
public static function getRandomString($length) 
{
$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
}
       
public static function copyThemeToApp($zip_file,$random_str) 
{
$_this = new self;
$theme_dir = __DIR__.'/../../../themes/'.rtrim($zip_file,'.zip');
$apps_dir = __DIR__.'/../../../apps/'.$random_str;        
File::makeDirectory($apps_dir);
return File::copyDirectory($theme_dir, $apps_dir);
}
/**
* Create App
*
* @return created app data and url
*/
public function actionCreateNewApp() 
{
$data = Input::get(); 
$rules = array
(
'token' => 'required',
'theme_id' => ['required','numeric'],
'app_name' => 'required'
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
$theme_obj = new Theme();                      
$theme = $theme_obj->find($data['theme_id']);
$zip_file = $theme->zip_file;
$random_str = $this->getRandomString(8);
$file_copy = $this->copyThemeToApp($zip_file,$random_str);
if($file_copy == 1)
{
$app = new Apps;
//           $app = $app_obj->create();           
$app->app_title = $data['app_name'];
$app->ref_id = $random_str;
$app->user_id = $userObj->id;
$app->theme_id = $data['theme_id'];
$app->theme_color = $theme->theme_color;
$app->save();
$appobj = $app->find($app->id);
$message="Your app created sucessfully..";
$main_controller = new MainController();
$url=$main_controller->getAppsUrl().$appobj->ref_id."/index.html?version=".substr(md5(microtime()),rand(0,26),7);
    $usercontact_obj = new UserContact();
    $usercontact_obj2 = new UserContact();
    $count = $usercontact_obj->where('userid', '=', $userObj->id)->count();
    if ($count != 0) {
        $usercontact = $usercontact_obj->where('userid', '=', $userObj->id)->first();
        if ($appobj) {
            $main_controller = new MainController();
//                        //print_r($app);
            $app_dir_path = $main_controller->getAppDirPath($appobj->ref_id);
            $qp = html5qp($app_dir_path . "/index.html");
            $qp->find('.ftb-street')->text($usercontact['street']);
            $qp->find('.ftb-city')->text($usercontact['city']);
            $qp->find('.ftb-state')->text($usercontact['state']);
            $qp->find('.ftb-country')->text($usercontact['country']);
            $qp->find('.ftb-zip')->text($usercontact['zip']);
            $qp->find('.ftb-promo-fb')->attr('href', $usercontact['facebook']);
            $qp->find('.ftb-promo-fb')->attr('data-url', $usercontact['facebook']);
            $qp->find('.ftb-promo-youtube')->attr('href', $usercontact['youtube']);
            $qp->find('.ftb-promo-youtube')->attr('data-url', $usercontact['youtube']);
            $qp->find('.ftb-promo-instagram')->attr('href', $usercontact['instagram']);
            $qp->find('.ftb-promo-instagram')->attr('data-url', $usercontact['instagram']);
            $qp->find('.ftb-promo-pinterest')->attr('href', $usercontact['pinterest']);
            $qp->find('.ftb-promo-pinterest')->attr('data-url', $usercontact['pinterest']);
            $qp->find('.ftb-website-link')->attr('href',$usercontact['website']);
            $qp->find('.ftb-website-link')->attr('data-url',$usercontact['website']);
            $qp->find('.ftb-email')->attr('href','mailto:'.$usercontact['email']);
            $qp->find('.ftb-email')->attr('data-url',$usercontact['email']);
            $qp->find('.ftb-contact-number')->attr('href','tel:'.$usercontact['con_number']);
            $qp->find('.ftb-contact-number')->attr('data-url',$usercontact['con_number']);

            $sct1 = "  function inIframe() { try { return window.self !== window.top; } catch (e) { return true; }try { return window.self !== window.top; } catch (e) { return true; } } console.log(getSubdomainName()); function getSubdomainName(){var hostParts = location.hostname.split('.');var subdomain = hostParts.shift();var upperleveldomain = hostParts.join('.'); return subdomain = subdomain.trim();}";
            $sct2 =" function sendVisitCall(ip){ $.ajax({url:  '".$main_controller->getExactUrl(). "/capture-new-visit',data:{ip:ip,subdomain: getSubdomainName() },type:'post',success:function(response){}}); }";
            $sct3="  if(inIframe() !== null ){ if(inIframe() !== undefined) { $.getJSON('http://jsonip.com/?callback=?', function (data) {var ipAddress = data.ip; sendVisitCall(data.ip); }); }}";
           // $sct5="$.getJSON('http://jsonip.com/?callback=?', function (data) {var ipAddress = data.ip; sendVisitCall(data.ip); }); ";
$script='<script class="ftb-visit-script">'.$sct1.$sct2.$sct3.'</script>';
            $qp->top('body')->append($script);
            $qp->writeHTML($app_dir_path."/index.html");
            //$message=" Sucessfully updated..";

        }


    }

    $message = " Result Here..";
return Response::json(array('error' => false,'message' => $message,'templateurl'=>$url,'createdapp'=> $appobj->toArray()),200);
}
else
{
$message="Your app not created..";
$appobj=array();
return Response::json(array('error' => true,'message' => $message,'templateurl'=>'','createdapp'=> $appobj->toArray()),200);
}
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}
}
}


public function saveApp() 
{
$data = Input::get(); 
$rules = array
(
'token' => 'required',
'code' => 'required',
'appid'=> 'required',
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
 $data = Input::get();
$extension = Input::file('file')->getClientOriginalExtension();
 if($extension=="html")
 {
 $fileurl = __DIR__ . '/../../../apps/' . $data['code'] . '/' ;
 Input::file('file')->move($fileurl,Input::file('file')->getClientOriginalName());
 $main_controller = new MainController();
$fileurl2=$main_controller->getUploadAppsUrl(). $data['code'] . '/';
$app_obj = new Apps();
$app = $app_obj->find($data['appid']);
//print_r($app);
$code=" ";
if($app)
{
if(trim($app->subdomain)=="")
{
$this->createAppSubdomain($data['code'], $data['appid']);
$code=$data['code'];
}
else
{
$code=$app->subdomain;
}    
}

$message="App saved sucessfully";
return Response::json(array('error' => false,'urls' => $fileurl2,'subdomain'=>$code,'message' => $message),200);
}
else
{
 $message="Invalid File..";
return Response::json(array('error' => true,'urls' => '','message' => $message),200);
}	
}
else
{
$message="Something went wrong..";
return Response::json(array('error' => true,'urls' => '','message' => $message),200);
}	
}
}

public function searchAlluserapps () 
{
$data = Input::get(); 
$rules = array
(
  'token' => 'required',
  'apptitle' => 'required'
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

$apps = DB::table("tbl_apps")->select("tbl_apps.*",
  DB::raw("IF(tbl_apps.publish_date IS  NULL , '',tbl_apps.publish_date ) as pdate"),
        DB::raw("(SELECT count(*) FROM tbl_visits WHERE tbl_visits.app_id = tbl_apps.id) as appvisit"),
       DB::raw("(SELECT count( distinct tbl_visits.ip_address) FROM tbl_visits WHERE tbl_visits.app_id = tbl_apps.id ) as  uniquevisit"))->where('app_title','like', $data['apptitle']."%")->where('user_id', $userObj->id)->paginate(15)->toJson();

//return Response::json(array('error' => false,'message' => $message,'templateurl'=>$url,'createdapp'=> $appobj->toArray()),200);
return $apps;


}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}
}
}


public function listAlluserapps () 
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
    //$custom = collect(['my_data' => 'My custom data here']);

   // $data = $custom->merge($book);

$uid=$userObj->id;

   $totalviews= DB::table('tbl_visits')

       ->whereIn('tbl_visits.app_id', function($query)use ($uid)
       {
           $query->select('tbl_apps.id')
               ->from('tbl_apps')
               ->where('user_id',$uid);
       })
       ->count();

    $totaluniqueviews= DB::table('tbl_visits')
        ->select( DB::raw(" count( distinct tbl_visits.ip_address) as uviews "))

        ->whereIn('tbl_visits.app_id', function($query)use ($uid)
        {
            $query->select('tbl_apps.id')
                ->from('tbl_apps')
                ->where('user_id',$uid);
        })
        ->first();

   //dd(DB::getQueryLog());
////print_r($totalviews);

$apps = DB::table("tbl_apps")->select("tbl_apps.*",
  DB::raw("IF(tbl_apps.publish_date IS  NULL , '',tbl_apps.publish_date ) as pdate"),
        DB::raw("(SELECT count(*) FROM tbl_visits WHERE tbl_visits.app_id = tbl_apps.id) as appvisit"),
       DB::raw("(SELECT count( distinct tbl_visits.ip_address) FROM tbl_visits WHERE tbl_visits.app_id = tbl_apps.id ) as  uniquevisit"))->where('user_id', $userObj->id)->paginate(15)->toArray();
  

   $message = " Result Here..";
   //$mainData=array('error' => false,'message' => $message,'totalviews'=>$totalviews,'totaluviews'=>$totaluniqueviews->uviews);
return Response::json([
            'error' => false,
            'message' => $message,
            'totalviews'=>$totalviews,
           'totaluviews'=>$totaluniqueviews->uviews,
          'total' => $apps['total'],
            'per_page' => $apps['per_page'],
            'current_page' => $apps['current_page'],
            'last_page' => $apps['last_page'],
            'from' => $apps['from'],
            'to' => $apps['to'],
            'data' => $apps['data']
        ]);
//return $apps;
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}
}
}



public function editUserapp() 
{
$data = Input::get(); 
$rules = array
(
'token' => 'required',
'appid' => ['required','numeric']
);
$validator = Validator::make($data, $rules);
if ($validator->fails()) 
{
$message="Some thing went wrong..";
$validation_errors=$validator->messages()->toArray();
}
else
{
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
$app_obj = new Apps();
$app = $app_obj->find($data['appid']);
if($app)
{
$message="Result Here...";
$main_controller = new MainController();
$url=$main_controller->getAppsUrl().$app->ref_id."/index.html?version=".substr(md5(microtime()),rand(0,26),7);
$message="Result Here...";
return Response::json(array('error' => false,'message' => $message,'appurl'=>$url,'app'=> $app->toArray()),200);
}
else
{
$message="Invalid App ";
$url=" ";
return Response::json(array('error' => false,'message' => $message,'appurl'=>$url,'app'=> ''),200);
}	
}
else
{
$message=" Your token is expired..";
return Response::json(array('error' => false,'message' => $message),200);
}
}        
}


public function actionDeleteApp() 
{
$data = Input::get(); 
$rules = array
(
'token' => 'required',
'appid' => ['required','numeric']
);
$validator = Validator::make($data, $rules);
if ($validator->fails()) 
{
$message="Some thing went wrong..";
$validation_errors=$validator->messages()->toArray();
}
else
{
$userObj = User::where('app_token', $data['token'])->first();
if ($userObj) 
{
$app_obj = new Apps();
$app = $app_obj->find($data['appid']);
if ($app->user_id == $userObj->id) 
{
$main_controller = new MainController();
// /* Load Cpanel Info */
$main_domain = $main_controller->getMainDomain();            //get main domain name
$cpanel_user = $main_controller->getCpanelUser();       //get cpanel username
$cpanel_pass = $main_controller->getCpanelPassword();   //get cpanel password
$cpanel_skin = $main_controller->getCpanelSkin();       //get cpanel skin
$main_application_dir = $main_controller->getMainApplicationDir();       //main application dir from public_html
$subdomain_dir = $main_application_dir . '/' . $app->ref_id;
$app_dir_path = $main_controller->getAppDirPath($app->ref_id);
$this->deleteSubdomain($app->subdomain, $main_domain, $cpanel_user, $cpanel_pass, $cpanel_skin);
File::deleteDirectory($app_dir_path);
$app->delete();
$message="App deleted sucessfully";
return Response::json(array('error' => false,'message' => $message),200);
} 
else 
{
$message="Some thing went wrong..";
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



}
