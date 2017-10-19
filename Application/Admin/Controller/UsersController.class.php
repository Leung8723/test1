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
class UsersController extends CommonController {
	//人员管理主页
    public function index() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $usersData = D("Users")->getUsersData();
        $this->assign('users',$usersData);
        $this->display();
    }
	//添加人员主页
	public function add() {
		if($_POST){
			print_r($_POST);exit;
			return $this->userAdd($_POST);

        }else{
			$deptData = D("Users")->getDeptList();//获取部署列表
			// print_r($deptData);exit;
			$this->assign('dept',$deptData);
			$this->display();
		}
	}
	//编辑信息主页
    public function edit() {
		$userId = $_GET['id'];
		if($_POST){
			return $this->userSave($_POST);
		}else{
			if(!$userId) {
				$this->redirect('/admin.php?c=users');
			}
			$res = D("Users")->find($userId);
			if(!$res) {
				$this->redirect('/admin.php?c=users');
			}
			$deptData = D("Users")->getDeptList();//获取成型担当列表
			$this->assign('userData',$res);
			$this->assign('dept',$deptData);
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
        $hiddenData = D("Users")->getHiddenData();
        $this->assign('users',$hiddenData);
        $this->display();
    }
	//添加人员模块
	public function userAdd($data){
        try {
			$arr[] = array(
				'id' => NULL,
				'workid' => $data['workid'],
				'name' => $data['name'],
				'sexual' => $data['sexual'],
				'cardid' => $data['cardid'],
				'dept' => $data['dept'],
				'mobile' => $data['mobile'],
				'joindate' => strtotime($data['joindate']),
				'create_user' => getLoginRealname(),
				'create_time' => time(),
				'update_time' => NULL,
				'status' => '1',
				'tips' => $data['tips']
			);
			$id = D("Users")->insertUser($arr);
            if($id){
				return show(0,'人员信息添加成功');
            }else{
				return show(1,'人员信息添加失败');
			}
        }catch(Exception $e){
            return $e->getMessage();
		}
	}
	
	//编辑模块
    public function userSave($data) {
        try {
            $id = D("Users")->updateUserById($data);
            if($id === false) {
                return show(1, '镀膜信息更新失败!');
            }else{
				return show(0, $data['name'].'的个人信息更新成功!');
			}
        }catch(Exception $e) {
            return show(1, $e->getMessage());
        }
    }
	//删除模块
    public function del() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(1, 'ID不存在');
                }
                $res = D("Users")->updateStatusById($id, $status);
                if ($res) {
                    return show(0, '删除成功');
                } else {
                    return show(1, '删除失败');
                }
            }
            return show(0, '没有提交的内容');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
	//删除项目恢复模块
    public function restatus() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(1, 'ID不存在');
                }
                $res = D("Users")->updateStatusById($id, $status);
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
}