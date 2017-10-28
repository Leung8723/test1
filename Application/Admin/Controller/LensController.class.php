<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/**
 * 型号管理
 * @author 善子先森
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
                return show(1,'型号名不存在');
            }
            if(!isset($_POST['specs']) || !$_POST['specs']|| !is_numeric($_POST['specs'])) {
                return show(1,'规格未填写或为非数字');
            }
            if(is_null($_POST['color']) ){
                return show(1,'色相基准未选择');
            }
            if(is_null(!$_POST['material'])) {
                return show(1,'材质不能为空');
            }
            if($_POST['model']) {
				try {
					$id = D("Lens")->insertLens($_POST);
					if($id !== false) {
						return show(0, $_POST['model'].' 添加新型号成功');
					}
					return show(1, '添加新型号失败');
				}catch(Exception $e) {
					return show(1, $e->getMessage());
				}
            }
        }else {
            $materialList = D('Lens')->getMaterialList();
            $colorList = D('Lens')->getColorList();
            $this->assign('colors', $colorList);
            $this->assign('materials', $materialList);
            $this->display();
        }
    }
	//编辑主页
    public function edit() {
        $newsId = $_GET['id'];
        if($_POST) {
            if(!isset($_POST['model']) || !$_POST['model']) {
                return show(1,'型号名不存在');
            }
            if(!isset($_POST['specs']) || !$_POST['specs']|| !is_numeric($_POST['specs'])) {
                return show(1,'规格未填写或为非数字');
            }
            if(is_null($_POST['color']) ){
                return show(1,'色相基准未选择');
            }
            if(is_null(!$_POST['material'])) {
                return show(1,'材质不能为空');
            }
            if($_POST['model']) {
				$id = $_POST['id'];
				try {
                    $arr = array(
                        'id' => $_POST['model'],
                        'model' => $_POST['model'],
                        'material' => $_POST['material'],
                        'specs' => $_POST['specs'],
                        'color' => $_POST['color'],
                        'create_user' => getLoginRealname(),
                        'update_time' => time(),
                    );
					$res = D("Lens")->updateLensById($id,$arr);
					if($res !== false) {
						return show(0, $_POST['model'].' 更新型号成功');
					}
					return show(1, '更新型号失败');
				}catch(Exception $e) {
					return show(1, $e->getMessage());
				}
            }
        }else {
            if(!$newsId) {
                $this->redirect('/admin.php?c=lens');
            }
            $news = D("Lens")->find($newsId);
            if(!$news) {
                $this->redirect('/admin.php?c=lens');
            }
            $materialList = D('Lens')->getMaterialList();
            $colorList = D('Lens')->getColorList();
            $this->assign('colors', $colorList);
            $this->assign('materials', $materialList);
            $this->assign('lens',$news);
            $this->display();
        }
    }
	//删除列表主页
	public function hidden() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $webSiteData = D("Lens")->getHiddenLensData();
        $this->assign('lens',$webSiteData);
        $this->display();
    }
	//删除模块
    public function del() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = '0';
                if (!$id) {
                    return show(1, 'ID不存在');
                }
                $res = D("Lens")->updateStatusById($id, $status);
                if($res){
                    return show(0, '操作成功');
                }else{
                    return show(1, '操作失败');
                }
            }
            return show(1, '没有提交的内容');
        }catch(Exception $e) {
            return show(1, $e->getMessage());
        }
    }
	//删除项目恢复模块
    public function restatus() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = '1';
                if (!$id) {
                    return show(1, 'ID不存在');
                }
                $res = D("Lens")->updateStatusById($id, $status);
                if($res){
                    return show(0, '恢复成功');
                }else{
                    return show(1, '恢复失败');
                }
            }
            return show(1, '没有提交的内容');
        }catch(Exception $e) {
            return show(1, $e->getMessage());
        }
    }
    //表中更改数据
    public function updatenum() {
        $num = $_POST['value'];
        $tips = $_POST['data']['tips'];
        $id = $_POST['data']['id'];
        if($num||$tips) {
			$arr = array(
				'id' => $id,
				'specs' => $_POST['data']['specs'],
				'create_user' => getLoginRealname(),
                'update_time' => time(),
                'tips' => $tips,
			);
			try {
				$res = D("Lens")->updateLensById($id, $arr);
				if($res !== false) {
					return show(0, '第'.$arr['id'].'条 数据更新成功!');
				}else{
					return show(1, '数据更新失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
        }
        return show(1, '没有更改规格或备注信息!');
    }
}