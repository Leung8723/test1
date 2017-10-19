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
class CoatingController extends CommonController {
	//镀膜主页
    public function index() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $coatingData = D("Coating")->getCoatingData();
        $this->assign('coating',$coatingData);
        $this->display();
    }
	//添加主页
	public function add() {
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
			$arr = array(
				'ct_model' => $_POST['ct_model'],
				'ct_machine' => $_POST['ct_machine'],
				'ct_date' => strtotime($_POST['ct_date']),
				'ct_lot' => $_POST['ct_lot'],
				'ct_user' => $_POST['ct_user'],
				'start_time' => strtotime($_POST['start_time']),
				'ct_num' => $_POST['ct_num'],
				'create_user' => getLoginRealname(),
				'status' => 1,
				'update_time' => time(),
				'tips' => $_POST['tips']
			);
			$id = $_POST['id'];
			try{
				$res = D("Coating")->updateLensById($id, $arr);
				if($res !== false){
					return show(0, '第'.$id.'条 镀膜信息更新成功!');
				}else{
					return show(1, '镀膜信息更新失败!');
				}
			}catch(Exception $e){
				return show(1, $e->getMessage());
			}
		}else{
			if(!$coatingId) {
				$this->redirect('/admin.php?c=coating');
			}
			$coatingData = D("Coating")->find($coatingId);
			if(!$coatingData) {
				$this->redirect('/admin.php?c=coating');
			}
			$coatingUser = D("Coating")->getCtUser();//获取镀膜担当列表
			$machineList = D("Coating")->getMachineList();//获取镀膜设备列表
			$this->assign('coatingData',$coatingData);
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
	//添加模块---------------------------------------------------------
	public function coatingAdd($data,$length){
        try {
			$arr = array();
			for($i=0;$i<$length;$i++){
				$model='model'.$i;
				$ctnum='ctnum'.$i;
				$tips='tips'.$i;
				if($data[$ctnum]){
					$arr[] = array(
						'id' => NULL,
						'ct_model' => $data[$model],
						'ct_machine' => $data['machine'],
						'ct_date' => strtotime($data['coatingdate']),
						'ct_lot' => $data['lotnum'],
						'ct_user' => $data['ctuser'],
						'start_time' => strtotime($data['coatingtime']),
						'over_time' => NULL,
						'ct_num' => $data[$ctnum],
						'create_user' => getLoginRealname(),
						'spec_t' => NULL,
						'spec_r' => NULL,
						'status' => '1',
						'ck_num' => NULL,
						'create_time' => time(),
						'update_time' => NULL,
						'tips' => $data[$tips]
					);
				}else{
					continue;
				}
			}
			$id = D("Coating")->insertCoating($arr);
            if($id === false){
				return show(1, '镀膜数据添加失败');
            }else{
				return show(0, '镀膜数据添加成功');
			}
        }catch(Exception $e){
            return $e->getMessage();
		}
	}
	//-------------------------------------------------
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