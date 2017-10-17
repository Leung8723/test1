<?php
namespace Common\Model;
use Think\Model;

/**
 * 用户组操作
 * @author  singwa
 */
class AdminModel extends Model {
	private $_db = '';

	public function __construct() {
		$this->_db = M('admin');
	}
   
    public function getAdminByUsername($username='') {
        $res = $this->_db->where('username="'.$username.'"')->find();
        return $res;
    }
    public function getAdminByAdminId($adminId=0) {
        $res = $this->_db->where('admin_id='.$adminId)->find();
        return $res;
    }

    public function updateByAdminId($old, $data) {
		$id = $data['admin_id'];
		$oldpassword = $this->_db->where('admin_id='.$id)->field('password')->select();
		$opassword = $oldpassword[0]['password'];
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
		if($old <> $opassword){
			throw_exception('原始密码不正确');
		}
        return $this->_db->where('admin_id='.$id)->save($data);
    }

    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 1;
        }
		$data['power'] = 1;
        $data['status'] = 1;
        $data['create_user'] = getLoginRealname();
        $data['create_time'] = time();
        return $this->_db->add($data);
    }

    public function getAdmins() {
        $data = array(
            'status' => array('neq',-1),
        );
        return $this->_db->where($data)->order('admin_id desc')->select();
		// return '{"code": 0,"msg": "","count": 1000,"data": '.json_encode($res).'}';
    }

    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("ID不合法");
        }
        $data['status'] = $status;
        return  $this->_db->where('admin_id='.$id)->save($data); // 根据条件更新记录

    }

    public function getLastLoginUsers() {
        $time = mktime(0,0,0,date("m"),date("d"),date("Y"));
        $data = array(
            'status' => 1,
            'lastlogintime' => array("gt",$time),
        );
        $res = $this->_db->where($data)->count();
        return $res['tp_count'];
    }

}
