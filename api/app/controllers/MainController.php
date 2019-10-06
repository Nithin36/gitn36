<?php

class MainController extends BaseController {



    public function getFromEmail() {
        return "noreplay@appreview4u.com";
    }



    public function sendMail($view, $data, $to, $subject) {
        Mail::send($view, $data, function($message)use ($to, $subject) {
                    $message->from($this->getFromEmail(), 'Floatalbums');
                    $message->to($to)->subject($subject);
                });
    }


    

}
