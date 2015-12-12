<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if(empty(cookie("username"))){
            $username = "游客".rand(1001,10000);
            cookie("username",$username,30*24*3600);
        }
        $this->username = cookie('username');

        $this->display();
    }
    public function UploadImage(){
        import("Org.Util.UploadFile");
        $upload = new \UploadFile();
        dump($upload);
    }
}