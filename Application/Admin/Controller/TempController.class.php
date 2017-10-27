<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/**
 * 温湿度信息管理
 * @author 善子先森
 */
class TempController extends CommonController {
	//温湿度主页
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
	//登记主页
	public function add() {
		if($_POST){
			$arr = array(
				'id' => NULL,
				'temp_date' => strtotime($_POST['temp_date']),
				'place' => $_POST['place'],
				'temp1' => $_POST['temp1'],
				'hum1' => $_POST['hum1'],
				'temp2' => $_POST['temp2'],
				'hum2' => $_POST['hum2'],
				'temp3' => $_POST['temp3'],
				'hum3' => $_POST['hum3'],
				'temp4' => $_POST['temp4'],
				'hum4' => $_POST['hum4'],
				'temp5' => $_POST['temp5'],
				'hum5' => $_POST['hum5'],
				'temp6' => $_POST['temp6'],
				'hum6' => $_POST['hum6'],
				'create_user' => getLoginRealname(),
                'create_time' => time(),
                'update_time' => NULL,
				'status' => '1',
				'tips' => $_POST['tips']
			);
			try {
				$res = D("Temp")->insertTemp($arr);
				if($res) {
                    return show(0, '温湿度登记成功!');
				}else{
                    return show(1, '温湿度登记失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
        }else{
			$place = D("Temp")->getPlaceData();
			$this->assign('place',$place);
			$this->display();
	    }
	}
	//编辑主页
    public function edit() {
		$tempId = $_GET['id'];
		if($_POST){
			$arr = array(
				'temp_date' => strtotime($_POST['temp_date']),
				'place' => $_POST['place'],
				'temp1' => $_POST['temp1'],
				'hum1' => $_POST['hum1'],
				'temp2' => $_POST['temp2'],
				'hum2' => $_POST['hum2'],
				'temp3' => $_POST['temp3'],
				'hum3' => $_POST['hum3'],
				'temp4' => $_POST['temp4'],
				'hum4' => $_POST['hum4'],
				'temp5' => $_POST['temp5'],
				'hum5' => $_POST['hum5'],
				'temp6' => $_POST['temp6'],
				'hum6' => $_POST['hum6'],
				'create_user' => getLoginRealname(),
				'status' => 1,
				'update_time' => time(),
			);
			$id = $_POST['id'];
			try {
				$res = D("Temp")->updateTempById($id, $arr);
				if($res !== false) {
					return show(0, '第'.$_POST['id'].'条 信息更新成功!');
				}else{
					return show(1, '信息更新失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
		}else{
			if(!$tempId) {
				$this->redirect('/admin.php?c=temp');
			}
			$res = D("Temp")->find($tempId);
			if(!$res) {
				$this->redirect('/admin.php?c=temp');
			}
			$place = D("Temp")->getPlaceData();
			$this->assign('place',$place);
			$this->assign('tempData',$res);
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
        $hiddenData = D("Temp")->getHiddenData();
        $this->assign('temp',$hiddenData);
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
                $status = '1';
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