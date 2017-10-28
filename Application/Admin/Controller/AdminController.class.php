<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/**
 * 用户信息管理
 * @author 善子先森
 */
class AdminController extends CommonController {
	//用户主页
    public function index() {
        $admins = D('Admin')->getAdmins();
        $this->assign('admins', $admins);
        $this->display();
    }
	//添加用户主页
    public function add() {
        if(IS_POST) {
            if(!isset($_POST['username']) || !$_POST['username']) {
                return show(1, '用户名不能为空');
            }
            if(!isset($_POST['password']) || !$_POST['password']) {
                return show(1, '密码不能为空');
            }
            $_POST['password'] = getMd5Password($_POST['password']);
            $admin = D("Admin")->getAdminByUsername($_POST['username']);// 判定用户名是否存在
            if($admin && $admin['status']!=-1) {
                return show(1,'该用户存在');
            }
            $id = D("Admin")->insert($_POST);
            if(!$id) {
                return show(1, '新增失败');
            }
            return show(0, '新增成功');
        }
        $this->display();
    }
	//用户信息设置主页
    public function personal() {
		$id = $_GET['id'];
		if($_POST){
			$data['admin_id'] = $_POST['admin_id'];
			$data['username'] = $_POST['username'];
			$data['realname'] = $_POST['realname'];
			$data['password'] = getMd5Password($_POST['newpassword']);
			$data['mobile'] = $_POST['mobile'];
			$data['skline'] = $_POST['skline'];
			$data['email'] = $_POST['email'];
			$data['power'] = 1;
			$data['status'] = 1;
			$data['create_user'] = getLoginRealname();
			$data['update_time'] = time();
			$passwd = $_POST['oldpassword'];
			$old = getMd5Password($passwd);
			try {
				$res1 = D("Admin")->updateByAdminId($old, $data);
				if($res1 !== false) {
					return show(0, '个人信息更新成功');
				}
				return show(1, '个人信息更新失败');
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
		}else{
			if(!$id){
				$this->redirect('/admin.php?c=admin');
			}
		}
        $user = D("Admin")->getAdminByAdminId($id);
        $this->assign('vo',$user);
        $this->display();
    }
	//删除列表主页
	public function hidden() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $hiddenData = D("Admin")->getHiddenData();
        $this->assign('hiddens',$hiddenData);
        $this->display();
    }
	//删除模块
    public function del() {
        try {
            if ($_POST) {
                $id = $_POST['admin_id'];
                $status = '0';
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
	//删除项目恢复模块
    public function restatus() {
        try {
            if ($_POST) {
                $id = $_POST['admin_id'];
                $status = '1';
                if (!$id) {
                    return show(1, 'ID不存在');
                }
                $res = D("Admin")->updateStatusById($id, $status);
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
        $id = $_POST['data']['admin_id'];
        if($num) {
			$arr = array(
				'admin_id' => $id,
				'realname' => $_POST['data']['realname'],
				'username' => $_POST['data']['username'],
				'mobile' => $_POST['data']['mobile'],
				'skline' => $_POST['data']['skline'],
				'email' => $_POST['data']['email'],
				'create_user' => getLoginRealname(),
                'update_time' => time(),
			);
			try {
				$res = D("Admin")->updateAdminById($id, $arr);
				if($res !== false) {
					return show(0, '第'.$arr['admin_id'].'条 数据更新成功!');
				}else{
					return show(1, '数据更新失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
        }
        return show(1, '没有更改数据信息!');
    }
}