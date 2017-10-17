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
class TempController extends CommonController {
	//镀膜主页
    public function index() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $tempData = D("Temp")->getTempData();
        $this->assign('temp',$tempData);
        $this->display();
    }
	//添加主页
	public function add() {
		if($_POST){
			return $this->tempAdd($_POST,$length);
        }else{
			$this->display();
		}
	}
	//待用功能
	public function addnew() {
		if($_POST){
			$length = (count($_POST)-5)/3;
			return $this->coatingAdd($_POST,$length);
        }else{
			$lensNumData = D("Coating")->getNotNullModel();//获取在库非0的全部型号
			$coatingUser = D("Coating")->getCtUser();//获取镀膜担当列表
			$machineList = D("Coating")->getMachineList();//获取镀膜设备列表
			$this->assign('lensnum',$lensNumData);
			$this->assign('ctuser',$coatingUser);
			$this->assign('machine',$machineList);
			$this->display();
		}
	}
	//编辑主页
    public function edit() {
		$coatingId = $_GET['id'];
		if($_POST){
			return $this->coatingSave($_POST);
		}else{
			if(!$coatingId) {
				$this->redirect('/admin.php?c=coating');
			}
			$id = D("Coating")->find($coatingId);
			if(!$id) {
				$this->redirect('/admin.php?c=coating');
			}
			$coatingUser = D("Coating")->getCtUser();//获取镀膜担当列表
			$machineList = D("Coating")->getMachineList();//获取镀膜设备列表
			$this->assign('coatingData',$id);
			$this->assign('coatingUser',$coatingUser);
			$this->assign('machineList',$machineList);
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
        $hiddenLensData = D("Coating")->getHiddenData();
        $this->assign('coating',$hiddenLensData);
        $this->display();
    }
	//添加模块
	public function tempAdd($data){
        try {
			$id = D("Temp")->insertTemp($data);
            if($id === false){
				return show(1, '温湿度登记失败');
            }else{
				return show(0, '温湿度登记成功');
			}
        }catch(Exception $e){
            return $e->getMessage();
		}
	}
	//编辑模块
    public function coatingSave($data) {
        try {
            $id = D("Coating")->updateLensById($data);
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
                $res = D("Coating")->updateStatusById($id, $status);
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
                $status = $_POST['status'];
                if (!$id) {
                    return show(1, 'ID不存在');
                }
                $res = D("Coating")->updateStatusById($id, $status);
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