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
        $this->_db = M('color');
    }

    public function getColorType(){
		$res = $this->_db->select('color_type');
		print_r($res);exit;
		return $res;
    }














}