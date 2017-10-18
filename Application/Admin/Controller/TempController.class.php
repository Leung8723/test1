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
		// if($_POST){

			// return $this->tempAdd($arr);
        // }else{
			$place = D("Temp")->getPlaceData();
			$this->assign('place',$place);
			$this->display();
		// }
	}
	
	
	
	//编辑主页
    public function edit() {
		$coatingId = $_GET['id'];
		if($_POST){
			return $this->coatingSave($_POST);
		}else{
			if(!$coatingId) {
				$this->redirect('/admin.php?c=temp');
			}
			$id = D("Temp")->find($coatingId);
			if(!$id) {
				$this->redirect('/admin.php?c=temp');
			}
			$place = D("Temp")->getPlaceData();
			$this->assign('place',$place);
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
        $hiddenLensData = D("Temp")->getHiddenData();
        $this->assign('coating',$hiddenLensData);
        $this->display();
    }
	
	//添加模块
	public function tempAdd(){
        try {
			$arr = array();
			// $arr['temp1'] = $data['temp1'];
			// $arr['hum1'] = $data['hum1'];
			$arr['temp_date'] = strtotime($_GET['temp_date']);
			for($i=1;$i<7;$i++){
				if($_GET['temp'.$i]=NULL){
					$arr['temp'.$i] = NULL;
				}elseif($_GET['hum'.$i]=NULL){
					$arr['hum'.$i] = NULL;
				}else{
					$arr['temp'.$i]=$_GET['temp'.$i];
					$arr['hum'.$i]=$_GET['hum'.$i];
				}
			}
			$arr['create_user'] = getLoginRealname();
			$arr['create_time'] = time();
			$arr['status'] = '1';
			// print_r($arr);exit;
			$id = D("Temp")->insertTemp($arr);
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
    public function tempSave($data) {
        try {
            $id = D("Temp")->updateTempById($data);
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
                $res = D("Temp")->updateStatusById($id, $status);
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
                $res = D("Temp")->updateStatusById($id, $status);
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