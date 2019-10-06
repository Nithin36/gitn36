<?php


class ContentController extends BaseController {





    public function PrivacyAndPolicy() {

        $message="Result Here...";
        $content1="content1";
        $content2="content2";
        return Response::json(array('error' => false,'message' => $message,'content1' => $content1,'content2' => $content2),200);
    }



}
