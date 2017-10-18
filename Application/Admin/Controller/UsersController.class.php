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
		$enterId = $_GET['id'];
		if($_POST){
			return $this->enterSave($_POST);
		}else{
			if(!$enterId) {
				$this->redirect('/admin.php?c=enter');
			}
			$res = D("Users")->find($enterId);
			if(!$res) {
				$this->redirect('/admin.php?c=enter');
			}
			$mdUser = D("Users")->getMdUser();//获取成型担当列表
			$this->assign('enterData',$res);
			$this->assign('mdUser',$mdUser);
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
        $hiddenLensData = D("Users")->getHiddenData();
        $this->assign('enters',$hiddenLensData);
        $this->display();
    }
	//添加人员模块
	public function userAdd($data,$length){
        try {
			$arr[] = array(
				'id' => NULL,
				'et_model' => $data[$model],
				'et_date' => strtotime($data['enterdate']),
				'et_time' => strtotime($data['entertime']),
				'et_num' => $data[$etnum],
				'create_user' => getLoginRealname(),
				'md_user' => $data['mduser'],
				'status' => '1',
				'create_time' => time(),
				'update_time' => NULL,
				'tips' => $data[$tips]
			);
			$id = D("Users")->insertEnter($arr);
            if($id){
				return show(0,'入库成功');
            }else{
				return show(1,'入库失败');
			}
        }catch(Exception $e){
            return $e->getMessage();
		}
	}
	//编辑模块
    public function userSave($data) {
        try {
            $id = D("Users")->updateLensById($data);
            if($id === false) {
                return show(1, '镀膜信息更新失败!');
            }else{
				return show(0, '第'.$_POST['id'].'条 镀膜信息更新成功!');
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