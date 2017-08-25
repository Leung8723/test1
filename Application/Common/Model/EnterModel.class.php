<?php
namespace Common\Model;
use Think\Model;

/**
 * 文章内容model操作
 * @author  singwa
 */
class EnterModel extends Model {
    private $_db = '';
    public function __construct() {
        $this->_db = M('enter');
    }

	//入库信息查询
    public function getEnterData() {
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->order('enter_id desc')->select();
		return $res;
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