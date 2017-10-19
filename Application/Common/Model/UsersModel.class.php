<?php
namespace Common\Model;
use Think\Model;

/**
 * 文章内容model操作
 * @author  singwa
 */
class UsersModel extends Model {
    private $_db = '';
    public function __construct() {
        $this->_db = M('user');
    }
	//人员记录信息查询
    public function getUsersData() {
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->select();
		return $res;
    }
	//查找部署信息列表
	public function getDeptList() {
		$deptData = $this->_db->where($map)->field('dept')->order('dept desc')->distinct(true)->select();
		$res = array_column($deptData,'dept');
		return $res;
    }
	//插入人员数据
	public function insertUser($data){
		if(!$data||!is_array($data)){
			throw_exception('人员信息不全!');
		}
		return $this->_db->addAll($data);
	}
	//修改状态,删除&恢复
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
	//删除人员查询
    public function getHiddenData() {
		$data = array(
			'status' => array('neq',1),
		);
		$res = $this->_db->where($data)->order('name asc')->select();
		return $res;
    }
	
	
	//查找相关id数据
	public function find($id) {
        return $this->_db->where('id='.$id)->find();
    }

	//修改人员数据
    public function updateUserById($data) {
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

}