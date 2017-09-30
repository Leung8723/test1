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
    public function index() {
		$conds = array();
		$title = $_GET['id'];
		// print_r($title);exit;
        if($title) {
            $conds['id'] = $title;
        }
        $coatingData = D("Coating")->getCoatingData();
        $this->assign('coating',$coatingData);
        $this->display();
    }

	public function add() {
		if($_POST){
			$length = (count($_POST)-5)/3;
			return $this->coatingAdd($_POST,$length);
        }else{
			$lensNumData = D("Coating")->getNotNullModel();//获取在库非0的全部型号
			$coatingUser = D("Coating")->getCtUser();//获取镀膜担当列表
			$machineList = D("Coating")->getMachineList();//获取镀膜担当列表
			$this->assign('lensnum',$lensNumData);
			$this->assign('ctuser',$coatingUser);
			$this->assign('machine',$machineList);
			$this->display();
		}
	}
	
	//入库模块
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
						'ct_date' => $data['coatingdate'],
						'ct_lot' => $data['lotnum'],
						'ct_user' => $data['ctuser'],
						'start_time' => $data['coatingtime'],
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
            return show(0, '入库失败');
            }
            return show(0, '入库成功');
        }catch(Exception $e){
            return $e->getMessage();
		}
	}
	
	//型号修改保存模块
    public function save($data) {
		$newsId = $data['id'];//获取id
        //unset($data['id']);
        try {
            $id = D("Coating")->updateLensById($newsId,$data);
            if($id === false) {
                return show(0, '更新型号失败');
            }
            return show(1, $_POST['model'].' 更新型号成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
	
    public function edit() {
        $coatingId = $_GET['id'];
        if(!$coatingId) {
            // 执行跳转
            $this->redirect('/admin.php?c=coating');
        }
        $id = D("Coating")->find($coatingId);
        if(!$id) {
            $this->redirect('/admin.php?c=coating');
        }
		$coatingUser = D("Coating")->getCtUser();//获取镀膜担当列表
		$machineList = D("Coating")->getMachineList();//获取镀膜担当列表
		// print_r($id);exit;
		$this->assign('coatingData',$id);
		$this->assign('ctuser',$coatingUser);
		$this->assign('machine',$machineList);
        $this->display();
    }
	
    public function del() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(0, 'ID不存在');
                }
                $res = D("Coating")->updateStatusById($id, $status);
                if ($res) {
                    return show(1, '操作成功');
                } else {
                    return show(0, '操作失败');
                }
            }
            return show(0, '没有提交的内容');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
	
}