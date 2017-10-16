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
class EnterController extends CommonController {
	//入库主页
    public function index() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $enterdata = D("Enter")->getEnterData();
        $this->assign('enters',$enterdata);
        $this->display();
    }
	//添加主页
	public function add() {
		if($_POST){
			$length = (count($_POST)-3)/3;
			return $this->enterAdd($_POST,$length);
        }else{
			$lensModelData = D("Enter")->getNotNullModel();//获取月间入库的型号列表
			$enterLastDate = D("Enter")->getLastDate();//获取最后入库日期
			$enterMdUser = D("Enter")->getMdUser();//获取成型入库担当列表
			$lastMdUser = D("Enter")->getLastMdUser();//获取成型入库担当列表
			// print_r($enterLastDate);exit;
			$this->assign('enterlens',$lensModelData);
			$this->assign('lastlens',$enterLastDate);
			$this->assign('mduser',$enterMdUser);
			$this->assign('lastmduser',$lastMdUser);
			$this->display();
		}
	}
	//编辑主页
    public function edit() {
		$enterId = $_GET['id'];
		if($_POST){
			return $this->enterSave($_POST);
		}else{
			if(!$enterId) {
				$this->redirect('/admin.php?c=enter');
			}
			$res = D("Enter")->find($enterId);
			if(!$res) {
				$this->redirect('/admin.php?c=enter');
			}
			$mdUser = D("Enter")->getMdUser();//获取成型担当列表
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
        $hiddenLensData = D("Enter")->getHiddenData();
        $this->assign('enters',$hiddenLensData);
        $this->display();
    }
	//在库列表主页
	public function lenscount() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
        $countLensData = D("Enter")->getCountData();
		// M('count')->where("1=1")->delete();
        $this->assign('count',$countLensData);
        $this->display();
    }
	//新型号入库
	public function addnew() {
		if($_POST){
			return $this->enterNewAdd($_POST);
        }else{
			$lensModelData = D("Enter")->getNewModel();//获取月间未入库过得全部型号列表
			$enterLastDate = D("Enter")->getLastDate();//获取最后入库日期
			$enterMdUser = D("Enter")->getMdUser();//获取成型入库担当列表
			$lastMdUser = D("Enter")->getLastMdUser();//获取成型入库担当列表
			
			$this->assign('enterlens',$lensModelData);
			$this->assign('lastlens',$enterLastDate);
			$this->assign('mduser',$enterMdUser);
			$this->assign('lastmduser',$lastMdUser);
			$this->display();
		}
	}
	//入库模块
	public function enterAdd($data,$length){
        try {
			$arr = array();
			for($i=0;$i<$length;$i++){
				$model='model'.$i;
				$etnum='etnum'.$i;
				$tips='tips'.$i;
				if($data[$etnum]>0){
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
				}else{
					continue;
				}
			}
			$id = D("Enter")->insertEnter($arr);
            if($id){
				return show(0,'入库成功');
            }else{
				return show(1,'入库失败');
			}
        }catch(Exception $e){
            return $e->getMessage();
		}
	}
	//addnew入库模块
	public function enterNewAdd($data){
        try {
			$arr[] = array(
				'id' => NULL,
				'et_model' => $data['model'],
				'et_date' => strtotime($data['enterdate']),
				'et_time' => strtotime($data['entertime']),
				'et_num' => $data['etnum'],
				'create_user' => getLoginRealname(),
				'md_user' => $data['mduser'],
				'status' => '1',
				'create_time' => time(),
				'update_time' => NULL,
				'tips' => $data['tip']
			);
			$id = D("Enter")->insertEnter($arr);
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
    public function enterSave($data) {
        try {
            $id = D("Enter")->updateLensById($data);
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
                $res = D("Enter")->updateStatusById($id, $status);
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
                $res = D("Enter")->updateStatusById($id, $status);
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