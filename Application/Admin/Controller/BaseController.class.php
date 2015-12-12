<?php
namespace Admin\Controller;
use Think\Controller;
class BaseController extends Controller{
	public function __construct(){
		parent::__construct();
		if(ACTION_NAME!="login"&&ACTION_NAME!="code"&&ACTION_NAME!="check_verify"){
			$this->check();
		}
	}
	public function check(){
		if(cookie("username")==""&&$_SESSION['username']==""){
			$this->error("您还未登陆!",U("Index/login"));
		}else{
			$this->username = $_SESSION['username']?$_SESSION['username']:cookie("username");
		}
	}
}