<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/**
 * 镀膜信息管理
 * @author 善子先森
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
            try{
                $arr = array();
                for($i=0;$i<$length;$i++){
                    $model = 'model'.$i;
                    $ctnum = 'num'.$i;
                    $tips = 'tips'.$i;
                    if($_POST[$ctnum]>0){
                        $arr[]= array(
                            'id' => NULL,
                            'ct_model' => $_POST[$model],
                            'ct_machine' => $_POST['machine'],
                            'ct_date' => strtotime($_POST['coatingdate']),
                            'ct_lot' => $_POST['lotnum'],
                            'ct_user' => $_POST['ctuser'],
                            'start_time' => strtotime($_POST['coatingtime']),
                            'over_time' => NULL,
                            'ct_num' => $_POST[$ctnum],
                            'create_user' => getLoginRealname(),
                            'spec_t' => NULL,
                            'spec_r' => NULL,
                            'ck_num' => NULL,
                            'status' => '1',
                            'create_time' => time(),
                            'update_time' => NULL,
                            'tips' => $_POST[$tips]
                        );
                    }else{
                        continue;
                    }
                }
				$res = D("Coating")->insertCoating($arr);
				if($res){
					return show(0, '镀膜数据添加成功!');
				}else{
					return show(1, '镀膜数据添加失败!');
				}
			}catch(Exception $e){
				return show(1, $e->getMessage());
			}
        }else{
			$lensNumData = D("Coating")->getNotNullModel();//获取在库非0的全部型号
			$coatingUser = D("Coating")->getCtUser();//获取镀膜担当列表
			$machineList = D("Coating")->getMachineList();//获取镀膜设备列表
            // print_r($lensNumData);exit;
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
	//删除模块
    public function del() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = '0';
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
                $status = '1';
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
    //表中更改数据
    public function updatenum() {
        $num = $_POST['value'];
        $tips = $_POST['data']['tips'];
        $id = $_POST['data']['id'];
        if($num||$tips) {
			$arr = array(
				'id' => $id,
				'ct_num' => $_POST['data']['ct_num'],
				'create_user' => getLoginRealname(),
                'update_time' => time(),
                'tips' => $tips,
			);
			try {
				$res = D("Coating")->updateLensById($id, $arr);
				if($res !== false) {
					return show(0, '第'.$arr['id'].'条 镀膜数据更新成功!');
				}else{
					return show(1, '镀膜数据更新失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
        }
        return show(1, '没有更改数量或备注信息!');
    }
}