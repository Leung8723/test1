<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

class AdminController extends CommonController {


    public function index() {
        $admins = D('Admin')->getAdmins();
        $this->assign('admins', $admins);
        $this->display();
    }
	/*
    public function adminslist() {
        $admins = D('Admin')->getAdmins();
		print_r($admins);exit;
		return $admins;
    }*/
    public function add() {
        // 保存数据
        if(IS_POST) {
            if(!isset($_POST['username']) || !$_POST['username']) {
                return show(1, '用户名不能为空');
            }
            if(!isset($_POST['password']) || !$_POST['password']) {
                return show(1, '密码不能为空');
            }
            $_POST['password'] = getMd5Password($_POST['password']);
            // 判定用户名是否存在
            $admin = D("Admin")->getAdminByUsername($_POST['username']);
            if($admin && $admin['status']!=-1) {
                return show(1,'该用户存在');
            }
            // 新增
            $id = D("Admin")->insert($_POST);
            if(!$id) {
                return show(1, '新增失败');
            }
            return show(0, '新增成功');
        }
        $this->display();
    }

    public function setStatus() {
        $data = array(
            'admin_id'=>intval($_POST['id']),
            'status' => intval($_POST['status']),
        );
        return parent::setStatus($_POST,'Admin');
    }

    public function personal() {
        // $res = $this->getLoginUser();
		$id = $_GET['id'];
		if($_POST){
			return $this->save($_POST);
		}else{
			if(!$id){
				$this->redirect('/admin.php?c=enter');
			}
		}
        $user = D("Admin")->getAdminByAdminId($id);
        $this->assign('vo',$user);
        $this->display();
    }

    public function save($res) {
        // $user = $this->getLoginUser();
        // if(!$user) {
            // return show(1,'用户不存在');
        // }
        $data['admin_id'] = $res['admin_id'];
        $data['username'] = $res['username'];
        $data['realname'] = $res['realname'];
		$data['password'] = getMd5Password($res['newpassword']);
        $data['mobile'] = $res['mobile'];
        $data['email'] = $res['email'];
        $data['power'] = 1;
        $data['status'] = 1;
        $data['create_user'] = getLoginRealname();
        $data['update_time'] = time();
		$passwd = $res['oldpassword'];
		$old = getMd5Password($passwd);
		// print_r($data);
		// print_r($id);
		// print_r($old);exit;
        try {
            $res1 = D("Admin")->updateByAdminId($old, $data);
            if($res1 === false) {
                return show(1, '个人信息更新失败');
            }
            return show(0, '个人信息更新成功');
        }catch(Exception $e) {
            return show(1, $e->getMessage());
        }
    }
	//删除模块
    public function del() {
        try {
            if ($_POST) {
                $id = $_POST['admin_id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(1, 'ID不存在');
                }
                $res = D("Admin")->updateStatusById($id, $status);
                if ($res) {
                    return show(0, '锁定成功');
                } else {
                    return show(1, '锁定失败');
                }
            }
            return show(1, '没有提交的内容');
        }catch(Exception $e) {
            return show(1, $e->getMessage());
        }
    }
}