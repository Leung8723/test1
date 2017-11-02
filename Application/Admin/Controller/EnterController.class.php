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
        $objSheet->setTitle("日间现况");
        $data = D("Enter")->getLastMonthData();
        //遍历所有数据
        $res = array();
        foreach($data as $a=>$b){
            foreach($b as $c=>$d){
                foreach($d as $e=>$f){
                    foreach($f as $g=>$h){
                        $res[]=$h;
                    }
                }
            }
        }

        
        $objPHPExcel->setActiveSheetIndex()->getDefaultStyle()->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//全局水平居中
        $objPHPExcel->setActiveSheetIndex()->getDefaultStyle()->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);//全局垂直居中
        $objSheet->mergeCells('A1:AH1');//合并单元格
        $objSheet->getRowDimension('A1:AI1')->setRowHeight(30);//设置标题行高
        $objSheet->getRowDimension('A3:AI3')->setRowHeight(20);//设置标题行高
        $objSheet->getRowDimension('A4:AI4')->setRowHeight(20);//设置标题行高
        $objSheet->getColumnDimension('A')->setWidth('13');//设置列宽
        $objSheet->getColumnDimension('B')->setWidth('11');//设置列宽
        $objSheet->getColumnDimension('C:Z')->setWidth('10');
        $objSheet->getColumnDimension('AA')->setWidth('10');
        $objSheet->getColumnDimension('AB')->setWidth('10');
        $objSheet->getColumnDimension('AC')->setWidth('10');
        $objSheet->getColumnDimension('AD')->setWidth('10');
        $objSheet->getColumnDimension('AE')->setWidth('10');
        $objSheet->getColumnDimension('AF')->setWidth('10');
        $objSheet->getColumnDimension('AG')->setWidth('10');
        $objSheet->getColumnDimension('AH')->setWidth('15');
        $objSheet->getColumnDimension('AI')->setWidth('15');
        $objSheet->getStyle('A1')->getFont()->setName('宋体')->setSize(16)->setBold(true);//设置标题字体/大小/加粗
        $objSheet->mergeCells('A2:D2');//合并单元格-报告生成时间
        $objSheet->mergeCells('A3:A4');//合并单元格-型号
        $objSheet->mergeCells('B3:B4');//合并单元格-型号
        $objSheet->mergeCells('C3:AG3');//合并单元格-月间统计标题
        $objSheet->mergeCells('AH3:AH4');//合并单元格-合计
        $objSheet->mergeCells('AI3:AI4');//合并单元格-备注
        $objSheet->getStyle('A2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);//设置单元格左对齐
        $objSheet->getStyle('AI')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY);//设置单元格左对齐
        $objSheet->getStyle('AI3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);//设置单元格水平居中
        
        $objSheet->getStyle('A1:AI2')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objSheet->getStyle('A1:AI2')->getFill()->getStartColor()->setARGB('FFFFFF');
        $objSheet->getStyle('A3:AI4')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
        $objSheet->getStyle('A3:AI4')->getFill()->getStartColor()->setARGB('B0C4DE');
        
        $objSheet->setCellValue("A1",$res[0]['month']."月镀膜入出库")->setCellValue("A2","报告生成时间:".date("Y-m-d H:i:s",time()))->setCellValue("A3","型号")
                ->setCellValue("B3","分类")->setCellValue("C3","月间明细")->setCellValue("AH3","合计")->setCellValue("AI3","备注")->setCellValue("C4","1")->setCellValue("D4","2")
                ->setCellValue("E4","3")->setCellValue("F4","4")->setCellValue("G4","5")->setCellValue("H4","6")->setCellValue("I4","7")->setCellValue("J4","8")
                ->setCellValue("K4","9")->setCellValue("L4","10")->setCellValue("M4","11")->setCellValue("N4","12")->setCellValue("O4","13")->setCellValue("P4","14")
                ->setCellValue("Q4","15")->setCellValue("R4","16")->setCellValue("S4","17")->setCellValue("T4","18")->setCellValue("U4","19")->setCellValue("V4","20")
                ->setCellValue("W4","21")->setCellValue("X4","22")->setCellValue("Y4","23")->setCellValue("Z4","24")->setCellValue("AA4","25")->setCellValue("AB4","26")
                ->setCellValue("AC4","27")->setCellValue("AD4","28")->setCellValue("AE4","29")->setCellValue("AF4","30")->setCellValue("AG4","31");
        // $a = \PHPExcel_Cell::columnIndexFromString($objSheet->getHighestColumn());
        // print_r($a);exit;
        $j=5;
        foreach($data as $k=>$v){
            $cellsdata = "A".$j.":A".($j+3);
            $objSheet->mergeCells($cellsdata);
            $objSheet->setCellValue('A'.$j,$k)
                ->setCellValue("B".$j,"前日在库")->setCellValue("B".($j+1),"入库数量")
                ->setCellValue("B".($j+2),"镀膜数量")->setCellValue("B".($j+3),"在库数量");
            /*   //表格边框              
            $bordercells = "A".($j-2).":AI".($j+3);
            $styleArray = array(
                'borders' => array(
                    'outline' => array(
                        'style' => \PHPExcel_Style_Border::BORDER_THIN,
                    ),
                ),
            );
            $objSheet->getStyle($bordercells)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            
            for($i=0;$i<4;$i++){
                if($i=0){
                    $borderline1 = "A".($j+$i-1).":AI".($j+$i-1);
                    $borderline2 = "A".($j+$i-2).":AI".($j+$i-2);
                    $objSheet->getStyle($borderline1)->applyFromArray($styleArray);
                    $objSheet->getStyle($borderline2)->applyFromArray($styleArray);
                }
                $borderline3 = "A".($j+$i).":AI".($j+$i);
                $objSheet->getStyle($borderline3)->applyFromArray($styleArray);
            }
            // $objSheet->getStyle($bordercells)->applyFromArray($styleArray);
             */
            $j = $j + 4;
        }
        // $objSheet->setCellValueByColumnAndRow(2,5,"1");
        // $objSheet->setCellValueByColumnAndRow(2,6,"2");
        // $objSheet->setCellValueByColumnAndRow(2,7,"3");
        // $objSheet->setCellValueByColumnAndRow(2,8,"4");
 /*        
        $f=5;
        foreach($data as $ke=>$va){

            //写入数据
            $datanum = count($res);
            for($i=0;$i<$datanum;$i++){
                if($res[$i]['model']=$ke){
                    if(!$res[$i]['conum']){
                        $lastday = $objSheet->getCellByColumnAndRow($res[$i]['day'],$f+3);
                        $objSheet->setCellValueByColumnAndRow($res[$i]['day'],$f+3,$lastday);
                        $objSheet->setCellValueByColumnAndRow($res[$i]['day']+1,$f+1,$res[$i]['etnum']);
                        $objSheet->setCellValueByColumnAndRow($res[$i]['day']+1,$f+2,$res[$i]['ctnum']);
                        $objSheet->setCellValueByColumnAndRow($res[$i]['day']+1,$f+3,$res[$i]['conum']+$res[$i]['etnum']-$res[$i]['ctnum']);
                    }else{
                        $objSheet->setCellValueByColumnAndRow(2,$f,$res[$i]['conum']);
                        $objSheet->setCellValueByColumnAndRow($res[$i]['day']+1,$f+1,$res[$i]['etnum']);
                        $objSheet->setCellValueByColumnAndRow($res[$i]['day']+1,$f+2,$res[$i]['ctnum']);
                        $objSheet->setCellValueByColumnAndRow($res[$i]['day']+1,$f+3,$res[$i]['conum']+$res[$i]['etnum']-$res[$i]['ctnum']);
                    }
                }
            $f = $f+4;
            }
        }
*/
        $lastday = $objSheet->getCellByColumnAndRow($res[0]['day'],8);
        $objSheet->setCellValueByColumnAndRow(10,6,$lastday);
        // print_r($lastday);exit;
        
        
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");
        $objWriter->save("./upload/export/".$res[0]['month']."-CCD Lens Enter&Coating-".getLoginUsername().time().".xlsx");
    }
}