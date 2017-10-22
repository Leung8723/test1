<?php
namespace Common\Model;
use Think\Model;
/**
 * 单品检查信息model操作
 * @author 善子先森
 */
class CheckModel extends Model {
    private $_db = '';
    public function __construct() {
        $this->_db = M('check');
    }
	//镀膜记录信息查询
    public function getCheckData() {
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->order('model asc')->select();
		return $res;
    }
	//筛选入库数非空型号列表
	public function getNotNullModel() {
		$data = array(
			'status' => array('eq',1),
		);
		$enterdata = M('enter')->where($data)->field('et_model,SUM(et_num) AS etnum')->order('et_model asc')->group('et_model')->distinct(true)->select();
		$coatingdata = $this->_db->where($data)->field('ct_model,SUM(ct_num) AS ctnum')->order('ct_model asc')->group('ct_model')->distinct(true)->select();
		$entercount = count($enterdata);
		$coatingcount = count($coatingdata);
		$arr1 = array();
		for($i=0;$i<$entercount;$i++){
			for($k=0;$k<$coatingcount;$k++){
				if($enterdata[$i]['et_model']==$coatingdata[$k]['ct_model']){
					$arr1[$i]['model'] = $enterdata[$i]['et_model'];
					$arr1[$i]['num'] = $enterdata[$i]['etnum']- $coatingdata[$k]['ctnum'];
				}else{
					$num = abs($coatingcount - $entercount)-1;
					$arr1[$i+$num]['model'] = $coatingdata[$k]['ct_model'];
					$arr1[$i+$num]['num'] = 0-$coatingdata[$k]['ctnum'];
				}
			}
		}
		$arr = array_filter(array_merge($arr1));
		return $arr;
    }
	//查找镀膜担当列表
    public function getCkUser() {
		$data = array(
			'dept' => array('eq','单品'),
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
	//插入检查数据
	public function insertCoating($data){
		if(!data||!is_array($data)){
			throw_exception('插入镀膜数据不合法');
		}
		return $this->_db->addAll($data);
	}
	//修改检查数据
    public function updateLensById($data) {
		$id = $data['id'];
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        if(!$data || !is_array($data)) {
			throw_exception('信息不完整');
        }
        $data['status'] =  '1';
        $data['create_user'] =  getLoginRealname();
		$data['update_time'] =  time();
        return $this->_db->where('id='.$id)->save($data);
    }
	//删除数据查询
    public function getHiddenData() {
		$data = array(
			'status' => array('neq',1),
		);
		$res = $this->_db->where($data)->order('ct_model asc')->select();
		return $res;
    }	

}