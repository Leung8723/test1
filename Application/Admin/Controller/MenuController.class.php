<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/**
 * 菜单管理相关
 * @auth 善子先森
 */
class MenuController extends CommonController {
	
	public function index() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $menus = D("Menu")->getMenusData();
        $this->assign('menu',$menus);
    	$this->display();
    }
	
    public function add(){
        if($_POST) {
            if(!isset($_POST['name']) || !$_POST['name']) {
                return show(0,'菜单名不能为空');
            }
            if(!isset($_POST['m']) || !$_POST['m']) {
                return show(0,'模块名不能为空');
            }
            if(!isset($_POST['c']) || !$_POST['c']) {
                return show(0,'控制器不能为空');
            }
            if(!isset($_POST['f']) || !$_POST['f']) {
                return show(0,'方法名不能为空');
            }
            if($_POST['menu_id']) {
                return $this->save($_POST);
            }
            $menuId = D("Menu")->insert($_POST);
            if($menuId) {
                return show(1,'新增成功',$menuId);
            }
            return show(0,'新增失败',$menuId);
        }else {
            $this->display();
        }
        //echo "welcome to singcms";
    }
	
    public function edit() {
        $menuId = $_GET['id'];
        $menu = D("Menu")->find($menuId);
        $this->assign('menu', $menu);
        $this->display();
    }
	//删除列表主页
	public function hidden() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $hiddenData = D("Menu")->getHiddenMenuData();
        $this->assign('hidden',$hiddenData);
        $this->display();
    }
	
	
	
	
	
	
    public function save($data) {
        $menuId = $data['menu_id'];
        unset($data['menu_id']);
        try {
            $id = D("Menu")->updateMenuById($menuId, $data);
            if($id === false) {
                return show(0,'更新失败');
            }
            return show(1,'更新成功');
        }catch(Exception $e) {
            return show(0,$e->getMessage());
        }
    }
	//删除模块
    public function del() {
        try {
            if ($_POST) {
                $id = $_POST['menu_id'];
                $status = 0;
                if (!$id) {
                    return show(1, 'ID不存在');
                }
                $res = D("Menu")->updateStatusById($id, $status);
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
                $id = $_POST['menu_id'];
                $status = 1;
                if (!$id) {
                    return show(1, 'ID不存在');
                }
                $res = D("Menu")->updateStatusById($id, $status);
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
	
	
	
	
	
	
	
    public function setStatus() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                // 执行数据更新操作
                $res = D("Menu")->updateStatusById($id, $status);
                if ($res) {
                    return show(1, '操作成功');
                } else {
                    return show(0, '操作失败');
                }
            }
        }catch(Exception $e) {
            return show(0,$e->getMessage());
        }
        return show(0,'没有提交的数据');
    }
	
    public function listorder() {
        $listorder = $_POST['listorder'];
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $errors = array();
        if($listorder) {
            try {
                foreach ($listorder as $menuId => $v) {
                    // 执行更新
                    $id = D("Menu")->updateMenuListorderById($menuId, $v);
                    if ($id === false) {
                        $errors[] = $menuId;
                    }
                }
            }catch(Exception $e) {
                return show(0,$e->getMessage(),array('jump_url'=>$jumpUrl));
            }
            if($errors) {
                return show(0,'排序失败-'.implode(',',$errors),array('jump_url'=>$jumpUrl));
            }
            return show(1,'排序成功',array('jump_url'=>$jumpUrl));
        }
        return show(0,'排序数据失败',array('jump_url'=>$jumpUrl));
    }
}