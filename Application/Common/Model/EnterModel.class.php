<?php
namespace Common\Model;
use Think\Model;
/**
 * 入库管理model操作
 * @author 善子先森
 */
class EnterModel extends Model {
    private $_db = '';
    public function __construct() {
        $this->_db = M('enter');
    }
	//入库记录信息查询
    public function getEnterData() {
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->order('id desc')->select();
		return $res;
    }
	//筛选入库数非空型号列表
	public function getNotNullModel() {
		$nowtime=time();
		$starttime=mktime(0,0,0,date("m"),1,date("Y"));
		$map['et_date'] = array('between',array($starttime,$nowtime));
		$map['status'] = array('eq',1);
		$map['et_num'] = array('neq',0);
		$lensdata = $this->_db->where($map)->field('et_model')->order('et_model asc')->distinct(true)->select();
		$res = array_column($lensdata,'et_model');
		return $res;
    }
	//获取所有型号列表
	public function getNewModel() {
        $data = array(
			'status' => array('eq',1),
		);
		return M('lens')->where($data)->field('model')->order('model asc')->distinct(true)->select();
    }
	//查找最后一条入库记录
    public function getLastDate() {
		$data = array(
			'status' => array('eq',1),
		);
		$data1 = $this->_db->where($data)->order('et_date desc')->field('et_date')->limit('1')->select();
		$data2 = $data1[0];
		$res = date("Y-m-d",$data2['et_date']);
		return $res;
    }
	//查找成型入库担当列表
    public function getMdUser() {
		$data = array(
			'dept' => array('eq','成型'),
			'status' => array('eq',1),
		);
		return M('user')->where($data)->field('name')->distinct(true)->select();
    }
	//查找最后一条成型入库担当
    public function getLastMdUser() {
		$data1 = $this->_db->order('id desc')->field('md_user')->limit('1')->select();
		$res = $data1[0]['md_user'];
		
		return $res;
    }
	//修改状态,删除&恢复
    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception('status不能为非数字');
        }
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        $data['status'] = $status;
        return $this->_db->where('id='.$id)->save($data);
    }
	//查找相关id数据
	public function find($id) {
        return $this->_db->where('id='.$id)->find();
    }
	//插入入库数据
	public function insertEnter($data){
		if(!$data||!is_array($data)){
			throw_exception('入库信息不合法');
		}
		return $this->_db->addAll($data);
	}
	//修改入库数据
    public function updateLensById($id, $data) {
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        if(!$data || !is_array($data)) {
			throw_exception('信息不完整');
        }
        return $this->_db->where('id='.$id)->save($data);
    }
	//删除型号查询
    public function getHiddenData() {
		$data = array(
			'status' => array('neq',1),
		);
		$res = $this->_db->where($data)->order('et_model asc')->select();
		return $res;
    }
	//在库表查询
    public function getCountData(){
		$res = M('count')->order('model asc')->select();
		return $res;
    }
    //导出镀膜入出库
    public function getLastMonthData() {
        $lastmonthstart = mktime(0, 0, 0, date('m', strtotime('-1 month')), 1, date("Y"));
        $lastmonthend = mktime(0, 0, 0, date('m', strtotime('0 month')), 1, date("Y"))-1;
        //-1月入库列表
        $etfield = array(
			'status' => array('eq',1),
			'et_date' => array('between',array($lastmonthstart,$lastmonthend)),
		);
        $etdata =  $this->_db->where($etfield)->field("et_model AS model,SUM(et_num) AS etnum,FROM_UNIXTIME(et_date,'%m') AS month,FROM_UNIXTIME(et_date,'%e') AS day")->order('model asc')->group('model')->distinct(true)->select();
        //-1月镀膜列表
        $ctfield = array(
			'status' => array('eq',1),
			'ct_date' => array('between',array($lastmonthstart,$lastmonthend)),
		);
        $ctdata =  M('coating')->where($ctfield)->field("ct_model AS model,SUM(ct_num) AS ctnum,FROM_UNIXTIME(ct_date,'%m') AS month,FROM_UNIXTIME(ct_date,'%e') AS day")->order('model asc')->group('model')->distinct(true)->select();
        
        //-2月最后在库列表查询
        $date1 = mktime(0, 0, 0, date('m', strtotime('-2 month')), 1, date("Y"));
        $date2 = mktime(0, 0, 0, date('m', strtotime('-1 month')), 1, date("Y"))-1;
        //-2月入库列表
		$enterdata = $this->_db->where(array('status'=>array('eq',1),'et_date'=>array('between',array($date1,$date2)),))
        ->field('et_model AS model,SUM(et_num) AS num')->order('model asc')->group('model')->distinct(true)->select();
        //-2月镀膜列表
		$coatingdata = M('coating')->where(array('status'=>array('eq',1),'ct_date'=>array('between',array($date1,$date2)),))
        ->field('ct_model AS model,SUM(ct_num) AS num')->order('model asc')->group('model')->distinct(true)->select();
        
		$diffmodel = array_values(array_unique(array_merge(array_column($enterdata,'model'),array_column($coatingdata,'model'))));
		$diffcount = count($diffmodel);
		foreach($enterdata as $key => $value){
			$arr1[] = $value['model'];
		}
		foreach($coatingdata as $key => $value){
			$arr2[] = $value['model'];
		}
		$arr = array();
		for($i=0;$i<$diffcount;$i++){
			if($diffmodel[$i]== $enterdata[array_search($diffmodel[$i],$arr1)]['model']){
				if($enterdata[array_search($diffmodel[$i],$arr1)]['num'] - $coatingdata[array_search($diffmodel[$i],$arr2)]['num']!=0){
					$arr[$i]['model'] = $diffmodel[$i];
					$arr[$i]['conum'] = $enterdata[array_search($diffmodel[$i],$arr1)]['num'] - $coatingdata[array_search($diffmodel[$i],$arr2)]['num'];
                    $arr[$i]['month'] = date("n", $date2);
                    $arr[$i]['day'] = date("j", $date2);
				}
			}else{
				$arr[$i]['model'] = $diffmodel[$i];
				$arr[$i]['conum'] = 0 - $coatingdata[array_search($diffmodel[$i],$arr2)]['num'];
                $arr[$i]['month'] = date("n", $date2);
                $arr[$i]['day'] = date("j", $date2);
			}
		}
 
        $result = array_merge($etdata,$ctdata,$arr);
        $modelist = count($result);
        
        $res = array();
        foreach ($result as $k => $v) {
            $res[$v['model']][$v['month']][$v['day']][] = $v;
        }
        return $res;
    }
}