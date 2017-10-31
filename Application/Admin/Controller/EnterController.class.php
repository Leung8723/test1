<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;
/**
 * 入库信息管理
 * @author 善子先森
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
			try {
				$arr = array();
				for($i=0;$i<$length;$i++){
					$model='model'.$i;
					$etnum='etnum'.$i;
					$tips='tips'.$i;
					if($_POST[$etnum]>0){
						$arr[] = array(
							'id' => NULL,
							'et_model' => $_POST[$model],
							'et_date' => strtotime($_POST['enterdate']),
							'et_time' => strtotime($_POST['entertime']),
							'et_num' => $_POST[$etnum],
							'create_user' => getLoginRealname(),
							'md_user' => $_POST['mduser'],
							'status' => '1',
							'create_time' => time(),
							'update_time' => NULL,
							'tips' => $_POST[$tips]
						);
					}else{
						continue;
					}
				}
				$res = D("Enter")->insertEnter($arr);
				if($res){
					return show(0,'入库成功');
				}else{
					return show(1,'入库失败');
				}
			}catch(Exception $e){
				return $e->getMessage();
			}
        }else{
			$lensModelData = D("Enter")->getNotNullModel();//获取月间入库的型号列表
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
	//编辑主页
    public function edit() {
		$enterId = $_GET['id'];
		if($_POST){
			$arr = array(
				'et_date' => strtotime($_POST['et_date']),
				'et_time' => strtotime($_POST['et_time']),
				'md_user' => $_POST['md_user'],
				'et_model' => $_POST['et_model'],
				'et_num' => $_POST['et_num'],
				'create_user' => getLoginRealname(),
				'status' => 1,
				'update_time' => time(),
				'tips' => $_POST['tips']
			);
            $id = $_POST['id'];
			try {
				$res = D("Enter")->updateLensById($id, $arr);
				if($res !== false) {
					return show(0, '第'.$_POST['id'].'条 镀膜信息更新成功!');
				}else{
					return show(1, '镀膜信息更新失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
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
	//新型号入库
	public function addnew() {
		if($_POST){
			try {
				$arr[] = array(
					'id' => NULL,
					'et_model' => $_POST['model'],
					'et_date' => strtotime($_POST['enterdate']),
					'et_time' => strtotime($_POST['entertime']),
					'et_num' => $_POST['etnum'],
					'create_user' => getLoginRealname(),
					'md_user' => $_POST['mduser'],
					'status' => '1',
					'create_time' => time(),
					'update_time' => NULL,
					'tips' => $_POST['tips']
				);
				$res = D("Enter")->insertEnter($arr);
				if($res){
					return show(0,'入库成功');
				}else{
					return show(1,'入库失败');
				}
			}catch(Exception $e){
				return $e->getMessage();
			}
        }else{
			$lensModelData = D("Enter")->getNewModel();//获取月间未入库过得全部型号列表
			$enterLastDate = D("Enter")->getLastDate();//获取最后入库日期
			$enterMdUser = D("Enter")->getMdUser();//获取成型入库担当列表
            // print_r($enterMdUser);exit;
			$this->assign('enterlens',$lensModelData);
			$this->assign('lastlens',$enterLastDate);
			$this->assign('mdusers',$enterMdUser);
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
        $countLensData = D("Enter")->getCountData();
        $this->assign('count',$countLensData);
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
                $status = '1';
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
    //表单单元格改数
    public function updatenum() {
        $ctnum = $_POST['data']['et_num'];
        $tips = $_POST['data']['tips'];
        $id = $_POST['data']['id'];
        if($ctnum||$tips) {
			$arr = array(
				'id' => $_POST['data']['id'],
				'et_num' => $_POST['data']['et_num'],
				'create_user' => getLoginRealname(),
                'update_time' => time(),
                'tips' => $_POST['data']['tips'],
			);
			try {
				$res = D("Enter")->updateLensById($id, $arr);
				if($res !== false) {
					return show(0, '第'.$arr['id'].'条 入库数据更新成功!');
				}else{
					return show(1, '入库数据更新失败!');
				}
			}catch(Exception $e) {
				return show(1, $e->getMessage());
			}
        }
        return show(1, '没有更改数量或备注信息!');
    }
    //镀膜入出库的导出
    public function getSheet(){
        
        require "/ThinkPHP/Library/Vendor/PHPExcel/PHPExcel.php";
        Vendor('Classes.PHPExcel');
        $objPHPExcel = new \PHPExcel();
        $objSheet = $objPHPExcel->getActiveSheet();
        $objSheet->setTitle("人员现况");
        $data1 = D("Enter")->exportEnterForExcel();
        $data2 = D("Coating")->exportCoatingForExcel();
        print_r($data1);exit;
        $objPHPExcel->setActiveSheetIndex()->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//全局水平居中
        $objPHPExcel->setActiveSheetIndex()->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);//全局垂直居中
        $objPHPExcel->getActiveSheet()->mergeCells('A1:I1');//合并单元格
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);//设置标题行高
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('8');//设置列宽
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('13');
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth('12');
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth('10');
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth('10');
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth('10');
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth('18');
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth('18');
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth('18');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('宋体')->setSize(12)->setBold(true);//设置标题字体/大小/加粗
        $objPHPExcel->getActiveSheet()->mergeCells('A2:I2');//合并单元格
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);//设置单元格左对齐
        $objPHPExcel->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);//设置单元格左对齐
        $objPHPExcel->getActiveSheet()->getStyle('I3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置单元格水平居中
        $objPHPExcel->getActiveSheet()->getStyle('A3:I8')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        $objSheet->setCellValue("A1",date("m",$data[1]['et_date'])."月镀膜入出库")->setCellValue("A2","报告生成时间:".date("Y-m-d H:i:s",time()))->setCellValue("A3","ID")->setCellValue("B3","入库型号")->setCellValue("C3","入库日期")->setCellValue("D3","入库数量")
                ->setCellValue("E3","操作人")->setCellValue("F3","入库担当")->setCellValue("G3","创建时间")->setCellValue("H3","修改时间")
                ->setCellValue("I3","备注");
        $j=4;
        foreach($data1 as $key=>$val){
            $objSheet->setCellValue("A".$j,$val['id'])->setCellValue("B".$j,$val['et_model'])->setCellValue("C".$j,date("Y-m-d",$val['et_date']))->setCellValue("D".$j,$val['et_num'])
                    ->setCellValue("E".$j,$val['create_user'])->setCellValue("F".$j,$val['md_user'])->setCellValue("G".$j,date("Y-m-d H:i:s",$val['create_time']))->setCellValue("H".$j,date("Y-m-d H:i:s",$val['update_time']))
                    ->setCellValue("I".$j,$val['tips']);
            $j++;
        }
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");
        $objWriter->save("./upload/export/".date("m",$val['et_date'])."-CCD Lens Enter&Coating-".date("YmdHis",time()).".xlsx");
    }
}