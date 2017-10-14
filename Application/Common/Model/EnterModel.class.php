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
		$nowtime=time();
		$starttime=mktime(0,0,0,date("m"),1,date("Y"));
		$map['et_date'] = array('between',array($starttime,$nowtime));
		$map['status'] = array('eq',1);
		$map['et_num'] = array('neq',0);
		$lensdata = $this->_db->where($map)->field('et_model')->order('et_model asc')->distinct(true)->select();
		$res = array_column($lensdata,'et_model');
		return $res;
    }
	//获取所有型号列表
	public function getNewModel() {
		$res = M('lens')->where()->field('model')->order('model asc')->distinct(true)->select();
		return $res;
    }
	//查找最后一条入库记录
    public function getLastDate() {
		$data = array(
			'status' => array('eq',1),
		);
		$data1 = $this->_db->where($data)->order('et_date desc')->field('et_date')->limit('1')->select();
		$data2 = $data1[0];
		$res = date("Y-m-d",$data2['et_date']);
		return $res;
    }
	//查找成型入库担当列表
    public function getMdUser() {
		$res = M('mduser')->field('md_name')->distinct(true)->select();
		return $res;
    }
	//查找最后一条成型入库担当
    public function getLastMdUser() {
		$data1 = $this->_db->order('enter_id desc')->field('md_user')->limit('1')->select();
		$res = $data1[0]['md_user'];
		
		return $res;
    }
	//更新 删除/显示状态
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
	//插入记录
	public function insertEnter($data){
		if(!$data||!is_array($data)){
			throw_exception('入库信息不合法');
		}
		return $this->_db->addAll($data);
	}
	
	
	
	
	
	
}











