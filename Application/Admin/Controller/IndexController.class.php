<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class IndexController extends BaseController {
    public function index(){
    	$this->display();
    }
    public function login(){
    	if($_POST){
    		$user = I("username");
    		$pass = I("password");
    		$online = I("online");
    		if(!$this->check_verify($_POST['code'])){
    			echo -1;die;
    		}
    		if($this->check_user($user,$pass)){
    			echo 1;
    			if($online!=""){
    				cookie("username",$_SESSION['username'],3600*24);
    			}
    		}else {
    			echo -2;
    		}
    	}else{
    		$this->display();
    	}
    }
    public function loginout(){
    	$_SESSION['username']=null;
    	cookie("username",null);
    	redirect(U("Index/login"));
    }
    public function welcome(){
    	$this->display();
    }
    public function code(){
    	$Verify =     new \Think\Verify();
    	// 验证码字体使用 ThinkPHP/Library/Think/Verify/ttfs/5.ttf
    	$Verify->useZh = false; 
    	$Verify->entry();
    }
    function check_verify($code, $id = ''){
    	$verify = new \Think\Verify(); 
    	return $verify->check($code, $id);
    }
    function check_user($user,$pass){
    	$pass=md5($pass);
    	$res = M("user")->where("username='$user' and password = '$pass'")->find();
    	if($res){
    		$_SESSION['username']=$res['username'];
    	}
    	return $res;
    }
    public function out(){
    	$data = M("news")->limit("20")->select();
    	$this->goods_export($data);
    }
    //memcache测试
    public function testMemcache(){
        $res = M("news")->select();
        if(S("test")){
            $test = S("test");
            dump($test);
        }else{
            S("test",$res);
        }
    }
    public function WebSocketClient(){
        $this->display("webSocket");
    }
    //导出数据方法
    protected function goods_export($goods_list)
    {
    	foreach ($goods_list as $k=>$goods_info){
    		$data[$k][id]=$goods_info['id'];
    		$data[$k][id] = $goods_info['id'];
    		$data[$k][title] = $goods_info['title'];
    		$data[$k][PNO] = $goods_info['type'];
    		$data[$k][old_PNO] = $goods_info['status'];
    		$data[$k][price]  = $goods_info['count'];
    		$data[$k][add_time] = $goods_info['time'];
    	}
    
    	//print_r($goods_list);
    	//print_r($data);exit;
    
    	foreach ($data as $field=>$v){
    		if($field == 'id'){
    			$headArr[]='产品ID';
    		}
    
    		if($field == 'title'){
    			$headArr[]='产品名称';
    		}
    		if($field == 'type'){
    			$headArr[]='类型';
    		}
    
    		if($field == 'status'){
    			$headArr[]='状态';
    		}
    
    		if($field == 'count'){
    			$headArr[]='次数';
    		}
    
    		if($field == 'time'){
    			$headArr[]='添加时间';
    		}
    	}
    
    	$filename="news_list";
    
    	$this->getExcel($filename,$headArr,$data);
    }
    
    private function  getExcel($fileName,$headArr,$data){
    	//print_r($headArr);die;
    	//导入PHPExcel类库，因为PHPExcel没有用命名空间，只能inport导入
        import("Org.Util.PHPExcel");
        import("Org.Util.PHPExcel.Writer.Excel5");
        import("Org.Util.PHPExcel.IOFactory.php");
        $date = date("Y_m_d",time());
        $fileName .= "_{$date}.xls";
        //创建PHPExcel对象，注意，不能少了\
        $objPHPExcel = new \PHPExcel();
        $objProps = $objPHPExcel->getProperties();
        //设置表头
        $key = ord("A");
        //print_r($headArr);exit;
        foreach($headArr as $v){
            $colum = chr($key);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $objPHPExcel->setActiveSheetIndex(0) ->setCellValue($colum.'1', $v);
            $key += 1;
        }
        $column = 2;
        $objActSheet = $objPHPExcel->getActiveSheet();
        //print_r($data);exit;
        foreach($data as $key => $rows){ //行写入
            $span = ord("A");
            foreach($rows as $keyName=>$value){// 列写入
                $j = chr($span);
                $objActSheet->setCellValue($j.$column, $value);
                $span++;
            }
            $column++;
        }
        $fileName = iconv("utf-8", "gb2312", $fileName);
        //重命名表
        //$objPHPExcel->getActiveSheet()->setTitle('test');
        //设置活动单指数到第一个表,所以Excel打开这是第一个表
        $objPHPExcel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename=\"$fileName\"");
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output'); //文件通过浏览器下载
        exit;
    }
}