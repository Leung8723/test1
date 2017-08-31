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
		$res = $this->_db->where($data)->order('et_date desc,et_time desc,et_model asc')->select();
		return $res;
    }
	//筛选入库数非空型号列表
	public function getNotNullModel() {
		$data = array(
			'status' => array('eq',1),
			'et_num' => array('neq',0),
		);
		$res = $this->_db->where($data)->field('et_model')->order('et_model asc')->distinct(true)->select();
		return $res;
    }
	//查找最后一条入库记录
    public function getLastDate() {
		$data = array(
			'status' => array('eq',1),
		);
		$data1 = $this->_db->where($data)->order('et_model desc')->field('et_date')->limit('1')->select();
		$data2 = $data1[0];
		$res = $data2['et_date'];
		return $res;
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