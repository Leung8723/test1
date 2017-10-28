<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/**
 * 人员信息管理
 * @author 善子先森
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
			try {
				$arr[] = array(
					'id' => NULL,
					'workid' => $_POST['workid'],
					'name' => $_POST['name'],
					'sexual' => $_POST['sexual'],
					'cardid' => $_POST['cardid'],
					'dept' => $_POST['dept'],
					'mobile' => $_POST['mobile'],
					'joindate' => strtotime($_POST['joindate']),
					'create_user' => getLoginRealname(),
					'create_time' => time(),
					'update_time' => NULL,
					'status' => '1',
					'tips' => $_POST['tips']
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
        }else{
			$deptData = D("Users")->getDeptList();//获取部署列表
			$this->assign('dept',$deptData);
			$this->display();
		}
	}
	//编辑信息主页
    public function edit() {
		$userId = $_GET['id'];
		if($_POST){
			try {
                $id = $_POST['id'];
                $arr = array(
                    'id' => $id,
                    'name' => $_POST['name'],
                    'workid' => $_POST['workid'],
                    'sexual' => $_POST['sexual'],
                    'cardid' => $_POST['cardid'],
                    'mobile' => $_POST['mobile'],
                    'dept' => $_POST['dept'],
                    'joindate' => strtotime($_POST['joindate']),
                    'create_user' => getLoginRealname(),
                    'update_time' => time(),
                    'tips' => $_POST['tips'],
                );
				$res = D("Users")->updateUserById($id, $arr);
				if($res !== false) {
					return show(0, $_POST['name'].'的个人信息更新成功!');
				}else{
					return show(1, '镀膜信息更新失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
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
	//删除模块
    public function del() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = '0';
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
                $status = '1';
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
    //表中更改数据
    public function updatenum() {
        $num = $_POST['value'];
        $tips = $_POST['data']['tips'];
        $id = $_POST['data']['id'];
        if($num||$tips) {
			$arr = array(
				'id' => $id,
				'name' => $_POST['data']['name'],
				'workid' => $_POST['data']['workid'],
				'cardid' => $_POST['data']['cardid'],
				'mobile' => $_POST['data']['mobile'],
				'create_user' => getLoginRealname(),
                'update_time' => time(),
                'tips' => $tips,
			);
			try {
				$res = D("Users")->updateUserById($id, $arr);
				if($res !== false) {
					return show(0, $arr['name'].'的个人信息更新成功!');
				}else{
					return show(1, '信息更新失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
        }
        return show(1, '没有更改个人或备注信息!');
    }
}