<?php
namespace Common\Model;
use Think\Model;
/**
 * 入库管理model操作
 * @author 善子先森
 */
class EnterModel extends Model {
    private $_db = '';
    public function __construct() {
        $this->_db = M('enter');
    }
	//入库记录信息查询
    public function getEnterData() {
		$data = array(
			'status' => array('eq',1),
		);
		$res = $this->_db->where($data)->order('id desc')->select();
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
        $data = array(
			'status' => array('eq',1),
		);
		return M('lens')->where($data)->field('model')->order('model asc')->distinct(true)->select();
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
		$data = array(
			'dept' => array('eq','成型'),
			'status' => array('eq',1),
		);
		return M('user')->where($data)->field('name')->distinct(true)->select();
    }
	//查找最后一条成型入库担当
    public function getLastMdUser() {
		$data1 = $this->_db->order('id desc')->field('md_user')->limit('1')->select();
		$res = $data1[0]['md_user'];
		
		return $res;
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
	//查找相关id数据
	public function find($id) {
        return $this->_db->where('id='.$id)->find();
    }
	//插入入库数据
	public function insertEnter($data){
		if(!$data||!is_array($data)){
			throw_exception('入库信息不合法');
		}
		return $this->_db->addAll($data);
	}
	//修改入库数据
    public function updateLensById($id, $data) {
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        if(!$data || !is_array($data)) {
			throw_exception('信息不完整');
        }
        return $this->_db->where('id='.$id)->save($data);
    }
	//删除型号查询
    public function getHiddenData() {
		$data = array(
			'status' => array('neq',1),
		);
		$res = $this->_db->where($data)->order('et_model asc')->select();
		return $res;
    }
	//在库表查询
    public function getCountData(){
		$res = M('count')->order('model asc')->select();
		return $res;
    }
    //导出镀膜入出库
    public function exportEnterForExcel() {
        $starttime=mktime(0,0,0,date("m"),1,date("Y"));
        $nowtime = time();
        $field = array(
			'status' => array('eq',1),
			'et_date' => array('between',array($starttime,$nowtime)),
		);
        $field2 = array(
			'status' => array('eq',1),
			'ct_date' => array('between',array($starttime,$nowtime)),
		);
        $data =  M('enter')->where($field)->field('et_model AS model,SUM(et_num) AS num,et_date AS date')->order('model asc')->group('model,date')->distinct(true)->select();
        $data2 =  M('Coating')->where($field2)->field('ct_model AS model,SUM(ct_num) AS num,ct_date AS date')->order('model asc')->group('model,date')->distinct(true)->select();
        return $data2;
    }
}