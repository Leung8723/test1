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
class LensController extends CommonController {

    public function index() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
/* 
        if($_GET['catid']) {
            $conds['catid'] = intval($_GET['catid']);
        }
*/
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 1;
        $webSiteData = D("Enter")->getEnterData();
		$count = D("Enter")->getEnterCount($conds);
        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();
        $this->assign('pageres',$pageres);
        $this->assign('enters',$webSiteData);
        $this->display();
    }
	//添加型号模块
    public function add(){
        if($_POST) {
            if(!isset($_POST['model']) || !$_POST['model']) {
                return show(0,'型号名不存在');
            }
            if(!isset($_POST['specs']) || !$_POST['specs']|| !is_numeric($_POST['specs'])) {
                return show(0,'规格未填写或为非数字');
            }
            if(is_null($_POST['color']) ){
                return show(0,'色相基准未选择');
            }
            if(is_null(!$_POST['material'])) {
                return show(0,'材质不能为空');
            }
            if($_POST['model']) {
                return $this->lensSave($_POST);//调用保存方法
            }
        }else {
			$lensMaterialType = C("LENS_MATERIAL");
			$lensColorType = C("COLOR_TYPE");
            $this->assign('lensColorType', $lensColorType);
            $this->assign('lensMaterialType', $lensMaterialType);
            $this->display();
        }
		
    }

	//型号添加保存模块
    public function lensSave($data) {
        try {
            $id = D("Enter")->insertLens($data);
            if($id === false) {
                return show(0, '添加新型号失败');
            }
            return show(1, $_POST['model'].' 添加新型号成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }

    public function setStatus() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(0, 'ID不存在');
                }
                $res = D("News")->updateStatusById($id, $status);
                if ($res) {
                    return show(1, '操作成功');
                } else {
                    return show(0, '操作失败');
                }
            }
            return show(0, '没有提交的内容');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
/*
    public function listorder() {
        $listorder = $_POST['listorder'];
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $errors = array();
        try {
            if ($listorder) {
                foreach ($listorder as $newsId => $v) {
                    // 执行更新
                    $id = D("News")->updateNewsListorderById($newsId, $v);
                    if ($id === false) {
                        $errors[] = $newsId;
                    }
                }
                if ($errors) {
                    return show(0, '排序失败-' . implode(',', $errors), array('jump_url' => $jumpUrl));
                }
                return show(1, '排序成功', array('jump_url' => $jumpUrl));
            }
        }catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        return show(0,'排序数据失败',array('jump_url' => $jumpUrl));
    }
*/
}