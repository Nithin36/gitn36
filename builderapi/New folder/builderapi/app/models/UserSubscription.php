<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserSubscription extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait,
        RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tbl_user_subscription';
    

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    public $timestamps = false;

    public function isUserAppLimitExceed($id,$applimit){        
        $apps_obj = new Apps();
        $app_count = $apps_obj->where('user_id',$id)->count();
        if($applimit > $app_count){
            return true;
        }        
        return false;
    }
}
