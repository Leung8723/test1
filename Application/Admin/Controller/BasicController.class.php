<?php
/**
 * 基本设置
 * @author 善子先森
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class BasicController extends CommonController {
	public function index() {
		$result = D("Basic")->select();
		$this->assign('vo', $result);
		$this->assign('type',1);
		$this->display();
	}
    //更改提交
	public function add() {
		if($_POST) {
			if(!$_POST['title']) {
				return show(1, '站点信息不能为空');
			}
			if(!$_POST['keywords']) {
				return show(1, '站点关键词');
			}
			if(!$_POST['description']) {
				return show(1, '站点描述');
			}
			D("Basic")->save($_POST);
			return show(0, '配置成功');
		}else {
			return show(1, '没有提交的数据');
		}
	}
	/**
	 * 缓存管理
	 */
	public function cache() {
		$this->assign('type',2);
		$this->display();
	}



}