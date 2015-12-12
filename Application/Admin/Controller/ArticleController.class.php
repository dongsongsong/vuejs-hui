<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class ArticleController extends BaseController{
    public function ArticleList(){
        $this->display();
    }
    //返回当前页和总条数
    public function ArticleAjax(){
        if(IS_AJAX){
            $count=M("news")->where("status = 1")->count();
            if($count%10==0){
                $data['pages']=$count/10;
            }else {
                $data['pages']=floor($count/10)+1;
            }
            $this->ajaxReturn($data);
        }
    }
	//为数据模型提供数据
	public function ajaxList(){
		$p = I('p');
		$page = 10;
		$start = ($p-1)*$page+1;
		$count=M("news")->where("status = 1")->order("id desc")->count();
		$data['count'] = $count%$page==0?$count/$page:floor($count/$page)+1;
		$data['list']=M("news")->where("status = 1")->order("id desc")->limit("$start,$page")->select();
		$this->ajaxReturn($data);
	}
}