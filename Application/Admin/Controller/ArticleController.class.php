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
		$page = 3;
		$start = ($p-1)*$page;
		$count=M("news")->where("status = 1")->order("id desc")->count();
		$data['count']=$count;
		$data['page'] = $count%$page==0?$count/$page:floor($count/$page)+1;
		$data['list']=M("news")->where("status = 1")->order("id desc")->limit("$start,$page")->select();
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