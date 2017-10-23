<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/**
 * 单品检查信息管理
 * @author 善子先森
 */
class CheckController extends CommonController {
	//单品检查主页
    public function index() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $checkData = D("Check")->getCheckData();
        $this->assign('check',$checkData);
        $this->display();
    }
	//按镀膜lot添加主页
	public function add() {
		if($_POST){
			try {
				$res = D("Check")->insertCheck($_POST);
				if($res === false){
					return show(1, '检查数据添加失败');
				}else{
					return show(0, '检查数据添加成功');
				}
			}catch(Exception $e){
				return $e->getMessage();
			}
        }else{
			$lensNumData = D("Check")->getNotCheckModel();//获取在库非0的全部型号
			print_r($lensNumData);exit;
			$checkUser = D("Check")->getCkUser();//获取检查担当列表
			$this->assign('lensnum',$lensNumData);
			$this->assign('ckuser',$checkUser);
			$this->assign('machine',$machineList);
			$this->display();
		}
	}
	//按型号添加主页
	public function addnew() {
		if($_POST){
			$length = (count($_POST)-5)/3;
			return $this->coatingAdd($_POST,$length);
        }else{
			$lensNumData = D("Coating")->getNotCheckModel();//获取在库非0的全部型号
			$checkUser = D("Check")->getCkUser();//获取检查担当列表
			$machineList = D("Coating")->getMachineList();//获取镀膜设备列表
			$this->assign('lensnum',$lensNumData);
			$this->assign('ckuser',$checkUser);
			$this->assign('machine',$machineList);
			$this->display();
		}
	}
	//编辑主页
    public function edit() {
		$checkId = $_GET['id'];
		if($_POST){
			try {
				$id = D("Check")->updateLensById($_POST);
				if($id === false) {
					return show(1, '检查信息更新失败!');
				}else{
					return show(0, '第'.$_POST['id'].'条 检查信息更新成功!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
		}else{
			if(!$checkId) {
				$this->redirect('/admin.php?c=check');
			}
			$res = D("Check")->find($checkId);
			if(!$res) {
				$this->redirect('/admin.php?c=check');
			}
			$checkUser = D("Check")->getCkUser();//获取镀膜担当列表
			$this->assign('checkData',$res);
			$this->assign('checkUser',$checkUser);
			$this->display();
		}
    }
	//删除列表
	public function hidden() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $hiddenLensData = D("Check")->getHiddenData();
        $this->assign('check',$hiddenLensData);
        $this->display();
    }
	//添加模块
	public function coatingAdd($data,$length){

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
                $res = D("Check")->updateStatusById($id, $status);
                if($res){
                    return show(0, '删除成功');
                }else{
                    return show(1, '删除失败');
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
                $res = D("Check")->updateStatusById($id, $status);
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