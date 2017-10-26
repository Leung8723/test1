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
	public function getNotCheckModel() {
		$data = array(
			'status' => array('eq',1),
			'ct_num' => array('neq','ck_num'),
		);
		$coatingdata = M('coating')->where($data)->select();
		$arr = array_filter(array_merge($coatingdata));
		return $coatingdata;
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
	//删除数据查询
    public function getHiddenData() {
		$data = array(
			'status' => array('neq',1),
		);
		$res = $this->_db->where($data)->order('model asc')->select();
		return $res;
    }	
	//修改检查数据
    public function updateLensById($id, $data) {
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        if(!$data || !is_array($data)) {
			throw_exception('信息不完整');
        }
        return $this->_db->where('id='.$id)->save($data);
    }
	//查找相关id数据
	public function find($id) {
        return $this->_db->where('id='.$id)->find();
    }
	//插入检查数据
	public function insertCheck($data){
		if(!data||!is_array($data)){
			throw_exception('插入镀膜数据不合法');
		}
		return $this->_db->addAll($data);
	}
}