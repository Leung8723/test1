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

    public function add() {

        // 保存数据
        if(IS_POST) {

            if(!isset($_POST['username']) || !$_POST['username']) {
                return show(0, '用户名不能为空');
            }
            if(!isset($_POST['password']) || !$_POST['password']) {
                return show(0, '密码不能为空');
            }
            $_POST['password'] = getMd5Password($_POST['password']);
            // 判定用户名是否存在
            $admin = D("Admin")->getAdminByUsername($_POST['username']);
            if($admin && $admin['status']!=-1) {
                return show(0,'该用户存在');
            }

            // 新增
            $id = D("Admin")->insert($_POST);
            if(!$id) {
                return show(0, '新增失败');
            }
            return show(1, '新增成功');
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
		$res = $_GET['id'];
        $user = D("Admin")->getAdminByAdminId($res);
        $this->assign('vo',$user);
        $this->display();
    }

    public function save() {
        $user = $this->getLoginUser();
        if(!$user) {
            return show(1,'用户不存在');
        }
        $id = $_POST['admin_id'];
        $data['username'] = $_POST['username'];
        $data['realname'] = $_POST['realname'];
		$data['password'] = getMd5Password($_POST['newpassword']);
        $data['mobile'] = $_POST['mobile'];
        $data['email'] = $_POST['email'];
        $data['power'] = 1;
        $data['status'] = 1;
        $data['create_user'] = getLoginRealname();
        $data['update_time'] = time();
		$passwd = $_POST['oldpassword'];
		$old = getMd5Password($passwd);
        try {
            $res = D("Admin")->updateByAdminId($id, $old, $data);
            if($res === false) {
                return show(1, '个人信息更新失败');
            }
            return show(0, '个人信息更新成功');
        }catch(Exception $e) {
            return show(1, $e->getMessage());
        }
    }

}