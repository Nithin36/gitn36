<?php

class MainController extends BaseController {


    public static function getRequestUrl() {
        return str_replace(url() . '/', "", Request::url());
    }

    public static function getAppDirPath($app_dir) {
        return __DIR__ . '/../../../apps/' . $app_dir;
    }

    public function getFromEmail() {
        return "support@floatalbums.com";
    }

    public static function getRootUrl() {
        return Request::root();
    }
    public static function getExactUrl() {
    
        // return " http://floatalbums.com";
        return "http://builder.floatalbums.com";
       // return "https://www.google.co.in";

    }

    public function sendMail($view, $data, $to, $subject) {
        Mail::send($view, $data, function($message)use ($to, $subject) {
                    $message->from($this->getFromEmail(), 'Floatalbums');
                    $message->to($to)->subject($subject);
                });
    }

    /* function for getting the cpanel user name */
    public static function getCpanelUser(){
        return "floatalbums";
    }
    
    /* function for getting the cpanel password */
    public static function getCpanelPassword(){
        return "V=w_;-5%i[{8";
    }
    
    /* function for getting the cpanel skin */
    public static function getCpanelSkin(){
        return "paper_lantern";
    }
    
    /* function for getting the main domain name of the builder */
    public static function getMainDomain(){
        return "floatalbums.com";
    }
    
    /* funtion for getting main application dir from public_html from cpanel */
    public static function getMainApplicationDir() {
        return "public_html/builder/apps";
    }
    
    public static function getCurrency(){
//        return "<i class='fa fa-rupee'></i>";
        return "$";
    }
    
    public static function getIndCurrency(){
        return "<i class='fa fa-rupee'></i>";     
    }
    
    public static function getCurrencylayerKey(){
        return "53cbf79c6cd82be0e6d5689e2a16872d";
    }
    public static function getPayumoneyDetails(){
        $data = [];
        $data['merchant_id'] = '5961950';
        $data['salt'] = 'iB650ttQD5';
        $data['api_key'] = 'tRrBgjvY';
        //$data['account_id'] = '512326';
        $data['ref_code'] = 'TestPayU';
        return $data;
    }

    public static function getPaypalBusinessEmail(){
        // return "forlancer01@gmail.com";
        return "jm1098@gmail.com";
        // return "anoopnair1098@gmail.com";
        // return "omkarsagare184@gmail.com";
        // return "nidhinthomaskurien@gmail.com";
    }

public function getMainUrl()
{
return "http://builder.floatalbums.com/";
}
public function getAppsUrl()
{
return $this->getMainUrl()."apps/";
}
public function getUploadbaseurl()
{
	return "/home/floatalbums/public_html/";
}

public function getUploadGalleryUrl()
{
	
return $this->getUploadbaseurl()."local/compressed_gallery_images2/";
}

public function getUploadAppsUrl()
{
	
return $this->getUploadbaseurl()."apps/";
}

}
