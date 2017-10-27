<?php
namespace Common\Model;
use Think\Model;
/**
 * 菜单信息model操作
 * @author 善子先森
 */
class MenuModel extends  Model {
    private $_db = '';
    public function __construct() {
        $this->_db = M('menu');
    }
    //添加菜单
    public function insert($data = array()) {
        if(!$data || !is_array($data)) {
            return 0;
        }
        return $this->_db->add($data);
    }
    //查询菜单列表
    public function getMenusData() {
		$data = array(
			'status' => array('eq',1),
		);
        return $this->_db->where($data)->order('listorder desc')->select();
    }
    //查询对应id信息
    public function find($id){
        if(!$id || !is_numeric($id)) {
            return array();
        }
        return $this->_db->where('menu_id='.$id)->find();
    }
	//删除列表查询
    public function getHiddenMenuData() {
		$data = array(
			'status' => array('neq',1),
		);
		return $this->_db->where($data)->order('menu_id asc')->select();
    }
    //编辑信息
    public function updateMenuById($data) {
        $id = $data['menu_id'];
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新的数据不合法');
        }
        return $this->_db->where('menu_id='.$id)->save($data);
    }
	//更新状态
    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception("status不能为非数字");
        }
        if(!$id || !is_numeric($id)) {
            throw_exception("id不合法");
        }
        $data['status'] = $status;
        return $this->_db->where('menu_id='.$id)->save($data);
     }
	//更新排序
    public function updateMenuListorderById($listorder) {
        $id = $listorder['menu_id'];
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        return $this->_db->where('menu_id='.$id)->save($listorder);
    }
    //菜单读取
    public function getAdminMenus() {
        $data = array(
            'status' => array('eq',1),
            'type' => 1,
        );
        return $this->_db->where($data)->order('listorder desc,menu_id desc')->select();
    }
    //
    public function getBarMenus() {
        $data = array(
            'status' => 1,
            'type' => 0,
        );
        $res = $this->_db->where($data)
            ->order('listorder desc,menu_id desc')
            ->select();
        return $res;
    }
}