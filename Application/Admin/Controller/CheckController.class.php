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
			$arr = array(
                'id' => NULL,
				'model' => $_POST['model'],
				'lot' => $_POST['lot'],
				'user' => $_POST['user'],
				'num' => $_POST['num'],
				'goods' => $_POST['goods'],
				'bads' => $_POST['bads'],
				'liangdian' => $_POST['liangdian'],
				'yiwu' => $_POST['yiwu'],
				'cuowei' => $_POST['cuowei'],
				'henji' => $_POST['henji'],
				'qipao' => $_POST['qipao'],
				'fm' => $_POST['fm'],
				'paopan' => $_POST['paopan'],
				'loss' => $_POST['loss'],
				'wuqian' => $_POST['wuqian'],
				'zhuangfan' => $_POST['zhuangfan'],
				'banyue' => $_POST['banyue'],
				'xiaoyi' => $_POST['xiaoyi'],
				'caixian' => $_POST['caixian'],
				'gate' => $_POST['gate'],
				'huahen' => $_POST['huahen'],
				'heidian' => $_POST['heidian'],
				'chengxing' => $_POST['chengxing'],
				'yahen' => $_POST['yahen'],
				'dumo' => $_POST['dumo'],
				'fabai' => $_POST['fabai'],
				'xihua' => $_POST['xihua'],
				'caiyi' => $_POST['caiyi'],
				'chengdian' => $_POST['chengdian'],
				'others' => $_POST['others'],
				'create_user' => getLoginRealname(),
				'cteate_time' => time(),
                'status' => 1,
				'tips' => $_POST['tips']
			);
			try {
				$res = D("Check")->insertCheck($arr);
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
			// print_r($lensNumData);exit;
			$checkUser = D("Check")->getCkUser();//获取检查担当列表
			$this->assign('lensnum',$lensNumData);
			$this->assign('ckuser',$checkUser);
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
			$arr = array(
				'model' => $_POST['model'],
				'lot' => $_POST['lot'],
				'user' => $_POST['user'],
				'num' => $_POST['num'],
				'goods' => $_POST['goods'],
				'bads' => $_POST['bads'],
				'liangdian' => $_POST['liangdian'],
				'yiwu' => $_POST['yiwu'],
				'cuowei' => $_POST['cuowei'],
				'henji' => $_POST['henji'],
				'qipao' => $_POST['qipao'],
				'fm' => $_POST['fm'],
				'paopan' => $_POST['paopan'],
				'loss' => $_POST['loss'],
				'wuqian' => $_POST['wuqian'],
				'zhuangfan' => $_POST['zhuangfan'],
				'banyue' => $_POST['banyue'],
				'xiaoyi' => $_POST['xiaoyi'],
				'caixian' => $_POST['caixian'],
				'gate' => $_POST['gate'],
				'huahen' => $_POST['huahen'],
				'heidian' => $_POST['heidian'],
				'chengxing' => $_POST['chengxing'],
				'yahen' => $_POST['yahen'],
				'dumo' => $_POST['dumo'],
				'fabai' => $_POST['fabai'],
				'xihua' => $_POST['xihua'],
				'caiyi' => $_POST['caiyi'],
				'chengdian' => $_POST['chengdian'],
				'others' => $_POST['others'],
				'create_user' => getLoginRealname(),
				'update_time' => time(),
                'status' => 1,
				'tips' => $_POST['tips']
			);
			$id = $_POST['id'];
			try {
				$id = D("Check")->updateLensById($id, $arr);
				if($id !== false) {
                    return show(0, '第'.$_POST['id'].'条 检查信息更新成功!');
				}else{
					return show(1, '检查信息更新失败!');
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
    //表中更改检查数量
    public function updatenum() {
        $num = $_POST['value'];
        $tips = $_POST['data']['tips'];
        $id = $_POST['data']['id'];
        if($num||$tips) {
			$arr1 = array(
				'liangdian' => $_POST['data']['liangdian'],
				'yiwu' => $_POST['data']['yiwu'],
				'cuowei' => $_POST['data']['cuowei'],
				'henji' => $_POST['data']['henji'],
                
				'qipao' => $_POST['data']['qipao'],
				'fm' => $_POST['data']['fm'],
				'paopan' => $_POST['data']['paopan'],
				'loss' => $_POST['data']['loss'],
                
				'wuqian' => $_POST['data']['wuqian'],
				'zhuangfan' => $_POST['data']['zhuangfan'],
				'banyue' => $_POST['data']['banyue'],
				'xiaoyi' => $_POST['data']['xiaoyi'],
                
				'caixian' => $_POST['data']['caixian'],
				'gate' => $_POST['data']['gate'],
				'huahen' => $_POST['data']['huahen'],
				'heidian' => $_POST['data']['heidian'],
                
				'chengxing' => $_POST['data']['chengxing'],
				'yahen' => $_POST['data']['yahen'],
				'dumo' => $_POST['data']['dumo'],
				'fabai' => $_POST['data']['fabai'],
                
				'xihua' => $_POST['data']['xihua'],
				'caiyi' => $_POST['data']['caiyi'],
				'chengdian' => $_POST['data']['chengdian'],
				'others' => $_POST['data']['others'],
			);
            $arr2 = array();
            $goods = $_POST['data']['num'] - array_sum($arr1);
            $bads = array_sum($arr1);
            $arr2 = array(
				'id' => $id,
                'goods' => $goods,
                'bads' => $bads,
				'create_user' => getLoginRealname(),
                'update_time' => time(),
                'tips' => $_POST['data']['tips'],
            );
            $arr = array_merge($arr1, $arr2); 
			try {
				$res = D("Check")->updateLensById($id, $arr);
				if($res !== false) {
					return show(0, '第'.$arr['id'].'条 检查数据更新成功!');
				}else{
					return show(1, '检查数据更新失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
        }
        return show(1, '没有更改不良项目或备注信息!');
    }
}