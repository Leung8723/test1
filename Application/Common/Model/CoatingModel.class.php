<?php
namespace Common\Model;
use Think\Model;
/**
 * 镀膜信息model操作
 * @author 善子先森
 */
class CoatingModel extends Model {
    private $_db = '';
    public function __construct() {
        $this->_db = M('coating');
    }
	//镀膜记录信息查询
    public function getCoatingData() {
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->order('id desc')->select();
		return $res;
    }
	//筛选入库数非空型号列表
	public function getNotNullModel() {
		$data = array(
			'status' => array('eq',1),
		);
		$enterdata = M('enter')->where($data)->field('et_model AS model,SUM(et_num) AS num')->order('model asc')->group('model')->distinct(true)->select();
		$coatingdata = $this->_db->where($data)->field('ct_model AS model,SUM(ct_num) AS num')->order('model asc')->group('model')->distinct(true)->select();
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
					$arr[$i]['num'] = $enterdata[array_search($diffmodel[$i],$arr1)]['num'] - $coatingdata[array_search($diffmodel[$i],$arr2)]['num'];
					$arr[$i]['count_user'] = getLoginRealname();
					$arr[$i]['last_time'] = time();
					$arr[$i]['tips'] = NULL;
				}
			}else{
				$arr[$i]['model'] = $diffmodel[$i];
				$arr[$i]['num'] = 0 - $coatingdata[array_search($diffmodel[$i],$arr2)]['num'];
				$arr[$i]['count_user'] = getLoginRealname();
				$arr[$i]['last_time'] = time();
				$arr[$i]['tips'] = NULL;
			}
		}
		$sql = 'TRUNCATE `sk_count`';
		M()->execute($sql);
		M('count')->addAll($arr);
        return array_merge($arr);
    }
	//查找镀膜担当列表
    public function getCtUser() {
		$data = array(
			'dept' => array('eq','镀膜'),
			'status' => array('eq',1),
		);
		$arr = M('user')->where($data)->field('name')->distinct(true)->select();
		return $arr;
    }
	//查找镀膜机列表
	public function getMachineList() {
		$machine = M('machine')->order('nickname asc')->distinct(true)->select();
		return $machine;
    }
	//修改状态,删除&恢复
    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception('status不能为非数字');
        }
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        $data['id'] = $id;
        $data['status'] = $status;
        return $this->_db->where('id='.$id)->save($data);
    }
	//查找相关id数据
	public function find($id) {
        return $this->_db->where('id='.$id)->find();
    }
	//插入镀膜数据
	public function insertCoating($data){
		if(!data||!is_array($data)){
			throw_exception('插入镀膜数据不合法');
		}
		return $this->_db->addAll($data);
	}
	//修改镀膜数据
    public function updateLensById($id, $arr) {
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        if(!$arr || !is_array($arr)) {
			throw_exception('信息不完整');
        }
        return $this->_db->where('id='.$id)->save($arr);
    }
	//删除型号查询
    public function getHiddenData() {
		$data = array(
			'status' => array('neq',1),
		);
		$res = $this->_db->where($data)->order('id desc')->select();
		return $res;
    }
}