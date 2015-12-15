<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class ArticleController extends BaseController{
    public function ArticleList(){
        $this->display();
    }
	//为数据模型提供数据
	public function ajaxList(){
		$p = I('p');
		$page = 5;
		$start = ($p-1)*$page;
		$count=M("news")->where("status = 1")->order("id desc")->count();
		$data['count']=$count;
		$data['page'] = $count%$page==0?$count/$page:floor($count/$page)+1;
		$column= $_GET['order'][0]['column'];
		$dir = $_GET['order'][0]['dir'];
		if($column==1){
			$ls = "id";
		}else{
			$ls = "time";
		}
		$data['list']=M("news")->where("status = 1")->order("$ls $dir")->limit("$start,$page")->select();
		$this->ajaxReturn($data);
	}
	public function article_add(){
		if(IS_POST){
			
		}else{
			$this->display();
		}
	}
	public function addImg(){
		
	}
}