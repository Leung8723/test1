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
	
    public function select($data = array(), $limit = 100) {
        $conditions = $data;
        $list = $this->_db->where($conditions)
		->order('model asc')
		->limit($limit)
		->select();
        return $list;
    }
	
	//入库信息查询
    public function getLensData() {
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
        return $this->_db->where('model='.$id)->find();
    }
	
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
}