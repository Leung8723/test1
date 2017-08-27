<?php
namespace Common\Model;
use Think\Model;

/**
 * 文章内容model操作
 * @author  singwa
 */
class LensModel extends Model {
    private $_db = '';
    public function __construct() {
        $this->_db = M('lens');
    }
	//入库信息查询
    public function getLensData() {
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->order('model asc')->select();
		return $res;
    }
	//删除型号查询
    public function getHiddenLensData() {
		$data = array(
			'status' => array('neq',1),
		);
		$res = $this->_db->where($data)->order('model asc')->select();
		return $res;
    }
	//插入型号模块
    public function insertLens($data) {
        if(!$data || !is_array($data)) {
        }
        $data['create_user'] =  getLoginRealname();
		$data['create_time']  = time();
        $data['update_time'] =  NULL;
        return $this->_db->add($data);
    }
	//查找id对应型号
	public function find($id) {
        return $this->_db->where('id='.$id)->find();
    }
	//修改型号
    public function updateLensById($id,$data) {
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        if(!$data || !is_array($data)) {
			throw_exception('信息不完整');
        }
        $data['create_user'] =  getLoginRealname();
		$data['update_time'] =  time();
        return $this->_db->where('id='.$id)->save($data);
    }
	//删除型号
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
}