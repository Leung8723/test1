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
        //$this->_db = M('enter');
    }
	
    public function select($data = array(), $limit = 100) {
        $conditions = $data;
        $list = $this->_db->where($conditions)
		->order('enter_id desc')
		->limit($limit)
		->select();
        return $list;
    }
	/*
    public function insert($data = array()) {
		$this->_db = M('lens');
        if(!is_array($data) || !$data) {
            return 0;
        }
        $data['create_user'] =  getLoginRealname();
		$data['create_time']  = time();
        $data['update_time'] =  '';
        return $this->_db->add($data);
    }
	*/
	
	//入库信息查询
    public function getEnterData() {
		$this->_db = M('enter');
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->order('enter_id desc')->select();
		return $res;
    }

	//入库信息分页
    public function getEnterCount($data = array()){
		$this->_db = M('enter');
        $conditions = $data;
        if(isset($data['id']) && $data['id']) {
            $conditions['id'] = array('like','%'.$data['id'].'%');
        }
        return $this->_db->count();
    }
	
	//插入型号模块
    public function insertLens($data) {
		$this->_db = M('lens');
        if(!$data || !is_array($data)) {
        }
        $data['create_user'] =  getLoginRealname();
		$data['create_time']  = time();
        $data['update_time'] =  NULL;
        return $this->_db->add($data);
    }
	
    public function find($id) {
        $data = $this->_db->where('et_model='.$id)->find();
        return $data;
    }
	
    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception('status不能为非数字');
        }
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        $data['status'] = $status;
        return $this->_db->where('enter_id='.$id)->save($data);
    }
}