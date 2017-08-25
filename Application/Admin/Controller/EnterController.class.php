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
        $webSiteData = D("Enter")->getEnterData();
        $this->assign('enters',$webSiteData);
        $this->display();
    }
}