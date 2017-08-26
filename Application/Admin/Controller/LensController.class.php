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

        $webSiteData = D("Lens")->getLensData();
        $this->assign('lens',$webSiteData);
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
                return $this->lensAdd($_POST);//调用保存方法
            }
        }else {
			$lensMaterialType = C("LENS_MATERIAL");
			$lensColorType = C("COLOR_TYPE");
            $this->assign('lensColorType', $lensColorType);
            $this->assign('lensMaterialType', $lensMaterialType);
            $this->display();
        }
		
    }
	//修改型号模块
	public function updateLens(){
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
                return $this->save($_POST);//调用保存方法
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
    public function lensAdd($data) {
        try {
            $id = D("Lens")->insertLens($data);
            if($id === false) {
                return show(0, '添加新型号失败');
            }
            return show(1, $_POST['model'].' 添加新型号成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
	
	//型号修改保存模块
    public function save($data) {
		$newsId = $data['id'];//获取id
        //unset($data['id']);
        try {
            $id = D("Lens")->updateLensById($newsId,$data);
            if($id === false) {
                return show(0, '更新型号失败');
            }
            return show(1, $_POST['model'].' 更新型号成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
	
    public function edit() {
        $newsId = $_GET['id'];
        if(!$newsId) {
            // 执行跳转
            $this->redirect('/admin.php?c=lens');
        }
        $news = D("Lens")->find($newsId);
        if(!$news) {
            $this->redirect('/admin.php?c=lens');
        }
		$lensMaterialType = C("LENS_MATERIAL");
		$lensColorType = C("COLOR_TYPE");
		$this->assign('lensColorType', $lensColorType);
		$this->assign('lensMaterialType', $lensMaterialType);
        $this->assign('lens',$news);
        $this->display();
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
}