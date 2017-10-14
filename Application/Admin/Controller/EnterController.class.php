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
	//入库主页
	public function add() {
		if($_POST){
			$length = (count($_POST)-3)/3;
			// print_r($_POST);print_r($length);exit;
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
	//新型号入库
	public function addnew() {
		if($_POST){
			return $this->enterAdd($_POST);
        }else{
			$lensModelData = D("Enter")->getNewModel();//获取月间未入库过得全部型号列表
			$enterLastDate = D("Enter")->getLastDate();//获取最后入库日期
			$enterMdUser = D("Enter")->getMdUser();//获取成型入库担当列表
			$lastMdUser = D("Enter")->getLastMdUser();//获取成型入库担当列表
			// print_r($lastMdUser);exit;
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
						'enter_id' => NULL,
						'et_model' => $data[$model],
						'et_date' => $data['enterdate'],
						'et_time' => $data['entertime'],
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
	
	//型号修改保存模块
    public function save($data) {
		$newsId = $data['id'];//获取id
        //unset($data['id']);
        try {
            $id = D("Lens")->updateLensById($newsId,$data);
            if($id === false) {
                return show(0, '更新型号失败');
            }
            return show(1, $_POST['model'].' 更新型号成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
	
    public function edit() {
        $newsId = $_GET['id'];
        if(!$newsId) {
            // 执行跳转
            $this->redirect('/admin.php?c=lens');
        }
        $news = D("Lens")->find($newsId);
        if(!$news) {
            $this->redirect('/admin.php?c=lens');
        }
		$lensMaterialType = C("LENS_MATERIAL");
		$lensColorType = C("COLOR_TYPE");
		$this->assign('lensColorType', $lensColorType);
		$this->assign('lensMaterialType', $lensMaterialType);
        $this->assign('lens',$news);
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
                $res = D("Lens")->updateStatusById($id, $status);
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