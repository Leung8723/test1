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

	public function add() {
		if($_POST) {
			$length = (count($_POST)-2)/3;
			// print_r($_POST);exit;
			return $this->enterAdd($_POST,$length);
        }else {
			$lensModelData = D("Enter")->getNotNullModel();//获取入库过得全部型号
			$enterLastDate = D("Enter")->getLastDate();//获取最后入库日期
			$this->assign('enterlens',$lensModelData);
			$this->assign('lastlens',$enterLastDate);
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
				if($data[$etnum]){
					$arr[] = array(
						'enter_id' => NULL,
						'et_model' => $data[$model],
						'et_date' => $data['date'],
						'et_time' => time(),
						'et_num' => $data[$etnum],
						'create_user' => getLoginRealname(),
						'md_user' => $data['md_user'],
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
            if($id === false) {
            return '入库失败';
            }
            return '入库成功';
        }catch(Exception $e){
            return $e->getMessage();
		}
	}
	
	
	
	
	
	
	
	
}