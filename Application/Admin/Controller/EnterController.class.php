<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

/**
 * 文章内容管理
 */
class EnterController extends CommonController {
    public function index() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $enterdata = D("Enter")->getEnterData();
        $this->assign('enters',$enterdata);
        $this->display();
    }

	public function add() {
		if($_POST) {
			$length = (count($database)-1)/3;
			//print_r($length);exit;
			return $this->enterAdd($_POST,$length);
        }else {
			$lensModelData = D("Enter")->getNotNullModel();//获取入库过得全部型号
			$enterLastDate = D("Enter")->getLastDate();//获取最后入库日期
			$this->assign('enterlens',$lensModelData);
			$this->assign('lastlens',$enterLastDate);
			$this->display();
		}
	}
	
	public function enterAdd($data,$length){
        try {
            $id = D("Enter")->insertEnter($data,$length);
            if($id === false) {
                return show(0, '产品入库失败');
            }
            return show(1, '产品入库成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
		}
	}
}