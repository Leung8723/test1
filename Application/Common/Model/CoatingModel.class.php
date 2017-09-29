<?php
namespace Common\Model;
use Think\Model;

/**
 * 文章内容model操作
 * @author  singwa
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
		$res = $this->_db->where($data)->order('ct_date desc,start_time desc,ct_model asc')->select();
		return $res;
    }
	//筛选入库数非空型号列表
	public function getNotNullModel() {
		$data = array(
			'status' => array('eq',1),
		);
		$lensdata = M('enter')->where($data)->field('et_model,SUM(et_num) AS etnum')->order('et_model asc')->group('et_model')->distinct(true)->select();
		// $res = array_column($lensdata,'et_num','et_model');
		return $lensdata;
    }
	//查找镀膜担当列表
    public function getCtUser() {
		$data = M('ctuser')->field('ct_name')->distinct(true)->select();
		//$res = array_column($data,'ct_name');
		return $data;
    }
	//查找镀膜机列表
	public function getMachineList() {
		$machine = M('machine')->order('nickname asc')->distinct(true)->select();
		//res = array_column($machine,'nickname','name');
		return $machine;
    }
	
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
	
	public function find($id) {
        return $this->_db->where('id='.$id)->find();
    }
	public function insertCoating($data){
		if(!data||!is_array($data)){
			throw_exception('入库信息不合法');
		}
		return $this->_db->addAll($data);
	}
	
	
	
	
	
	
}











