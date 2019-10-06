<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});
/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
|
*/
Route::post('auth/actionSignup', 'AuthController@actionSignup');
Route::post('auth/actionLogin', 'AuthController@actionLogin');
Route::post('auth/forgotPasssword', 'AuthController@actionForgetPassword');
Route::post('auth/tokenLogin', 'AuthController@tokenAuthentication');

/*
|--------------------------------------------------------------------------
| Common Data
|--------------------------------------------------------------------------
|
*/
Route::get('common/allCategories', 'CommonController@allCategories');

/*
|--------------------------------------------------------------------------
| App operations
|--------------------------------------------------------------------------
|
*/
Route::post('app/createApp','AppsController@showAllThemes');
Route::post('app/createAppAction','AppsController@actionCreateNewApp');
Route::post('app/saveApp','AppsController@saveApp');
Route::post('app/listApps','AppsController@listAlluserapps');
Route::post('app/editApp','AppsController@editUserapp');
Route::post('app/searchApp','AppsController@searchAlluserapps');
Route::post('app/deleteApp','AppsController@actionDeleteApp');


/*
|--------------------------------------------------------------------------
| Builder operations
|--------------------------------------------------------------------------
|
*/
Route::post('builder/galleryupload','BuilderController@actionUploadGallery');
Route::post('builder/gallerydelete','BuilderController@deleteGalleryPhoto');
Route::post('builder/gallerylist','BuilderController@ListGalleryPhoto');
Route::post('builder/galleryupdate','BuilderController@UpdateGalleryPhoto');

Route::post('builder/hideelement','BuilderController@HideElement');
Route::post('builder/getappdetails','BuilderController@getAppDetails');
Route::post('builder/savelogodetails','BuilderController@saveLogoDetails');
Route::post('builder/savevideodetails','BuilderController@saveVideoDetails');
Route::post('builder/savetitledetails','BuilderController@saveTitleDetails');
Route::post('builder/getsubdomain','BuilderController@getSubdomain');


Route::post('builder/audiolist','BuilderController@getUploadedAudio');
Route::post('builder/logoupload','BuilderController@actionUploadLogo');
Route::post('builder/iconupload','BuilderController@actionUploadIcon');
Route::post('builder/videoupload','BuilderController@uploadVideo');
Route::post('builder/videodelete','BuilderController@deleteVideo');
Route::post('builder/createlink','BuilderController@requestCreateSubdomain');
Route::post('builder/view-contact', 'BuilderController@listContacts');
Route::post('builder/save-address', 'BuilderController@addAddress');
Route::post('builder/save-contact', 'BuilderController@addContact');
Route::post('builder/save-social', 'BuilderController@addSociallink');
//Route::post('app/createAppAction','AppsController@actionCreateNewApp');

/*
|--------------------------------------------------------------------------
| Builder operations
|--------------------------------------------------------------------------
|
*/
Route::post('user/userprofile','UserController@getProfileDetails');
/*
|--------------------------------------------------------------------------
| Test operations
|--------------------------------------------------------------------------
|
*/
Route::post('test','TestController@TestCase');
