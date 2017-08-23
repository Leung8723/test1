<?php
namespace Common\Model;
use Think\Model;

/**
 * 文章内容model操作
 * @author  singwa
 */
class enterModel extends Model {
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
	
    public function insert($data = array()) {
        if(!is_array($data) || !$data) {
            return 0;
        }
        $data['create_time']  = time();
        $data['username'] =  getLoginUsername();
        return $this->_db->add($data);
    }
	
	//入库信息查询
    public function getEnterData() {
		$this->_db = M('enter');
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->order('enter_id desc')->select();
		return $res;
    }
	
	//获取色相类型列表
    public function getColorType(){
		$this->_db = M('color');
		$arraydata = $this->_db->field('color_type')->select();
		foreach($arraydata as $k=>$val){ 
			$data = $data.$val['color_type'].':';
		}
		$res = explode(":", $data);
		array_pop($res); 
		return $res;
    }
	
	//获取材质类型列表,需提前添加
    public function getMaterialType(){
		$this->_db = M('lens');
		$arraydata = $this->_db->Distinct(true)->field('material')->select();
		foreach($arraydata as $k=>$val){ 
			$data = $data.$val['material'].':';
		}
		$res = explode(":", $data);
		array_pop($res);
		return $res;
    }
	//入库信息分页
    public function getEnterCount($data = array()){
		$this->_db = M('lens');
        $conditions = $data;
        if(isset($data['id']) && $data['id']) {
            $conditions['id'] = array('like','%'.$data['id'].'%');
        }
        return $this->_db->count();
    }
	
    public function find($id) {
        $data = $this->_db->where('enter_id='.$id)->find();
        return $data;
    }
    public function updateById($id, $data) {
        if(!$id || !is_numeric($id) ) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        return $this->_db->where('enter_id='.$id)->save($data);
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