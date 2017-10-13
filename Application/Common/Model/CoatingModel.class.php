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
	//删除型号查询
    public function getHiddenData() {
		$data = array(
			'status' => array('neq',1),
		);
		$res = $this->_db->where($data)->order('ct_model asc')->select();
		return $res;
    }	

}