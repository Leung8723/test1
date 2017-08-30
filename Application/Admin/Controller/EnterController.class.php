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
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        //$lensModelData = D("Lens")->getLensData();//获取全部存在型号
        $lensModelData = D("Enter")->getNotNullModel();//获取入库过得全部型号
        $enterLastDate = D("Enter")->getLastDate();//获取最后入库日期
        $this->assign('enterlens',$lensModelData);
        $this->assign('lastlens',$enterLastDate);
		//print_r($lensModelData);exit;
        $this->display();
    }
}