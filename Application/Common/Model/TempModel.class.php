<?php
namespace Common\Model;
use Think\Model;
/**
 * 温湿度信息model操作
 * @author 善子先森
 */
class TempModel extends Model {
    private $_db = '';
    public function __construct() {
        $this->_db = M('temp');
    }
	//温湿度记录信息查询
    public function getTempData() {
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->order('id desc')->select();
		return $res;
    }
	//温湿度区域查询
    public function getPlaceData() {
		$data = array(
			'status' => array('neq',0),
		);
		$res = $this->_db->where($data)->field('place')->order('place asc')->distinct(true)->select();
		return $res;
    }
	//插入温湿度数据
	public function insertTemp($data){
		if(!$data||!is_array($data)){
			throw_exception('登记数据不完全');
		}
		return $this->_db->data($data)->add();
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
	//修改温湿度数据
    public function updateTempById($id, $data) {
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        if(!$data || !is_array($data)) {
			throw_exception('信息不完整');
        }
        return $this->_db->where('id='.$id)->save($data);
    }
	//删除数据查询
    public function getHiddenData() {
		$data = array(
			'status' => array('neq',1),
		);
		$res = $this->_db->where($data)->order('id desc')->select();
		return $res;
    }

}