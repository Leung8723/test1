<?php
/**
 * 后台Index相关
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Exception;

/**
 * 文章内容管理
 */
class EnterController extends CommonController {

    public function index() {
		$conds = array();
		$title = $_GET['id'];
        if($title) {
            $conds['id'] = $title;
        }
/* 
        if($_GET['catid']) {
            $conds['catid'] = intval($_GET['catid']);
        }
*/
        $page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
        $pageSize = 1;
        $webSiteData = D("Enter")->getEnterData();
		$count = D("Enter")->getEnterCount($conds);
        $res  =  new \Think\Page($count,$pageSize);
        $pageres = $res->show();
        $this->assign('pageres',$pageres);
        $this->assign('enters',$webSiteData);
        $this->display();
    }
	//添加型号模块
    public function add(){
        if($_POST) {
            if(!isset($_POST['title']) || !$_POST['title']) {
                return show(0,'型号名不存在');
            }
            if(!isset($_POST['specs']) || !$_POST['specs']|| !is_numeric($_POST['specs'])) {
                return show(0,'规格未填写或为非数字');
            }
            if(!isset($_POST['color']) || !$_POST['color']) {
                return show(0,'色相基准未选择');
            }
            if($_POST['title']) {
                return $this->save($_POST);//调用保存方法
            }
            $newsId = D("Enter")->insert($_POST);
            if($newsId) {
                $newsContentData['news_id'] = $newsId;
                $cId = D("NewsContent")->insert($newsContentData);
                if($cId){
                    return show(1,'新增成功');
                }else{
                    return show(1,'主表插入成功，副表插入失败');
                }
            }else{
                return show(0,'新增失败');
            }
        }else {
            $lensColorType = D("Enter")->getColorType();
			$lensMaterialType = D("Enter")->getMaterialType();
            $this->assign('lensColorType', $lensColorType);
            $this->assign('lensMaterialType', $lensMaterialType);
            $this->display();
        }
		
    }
	//入库信息模块
    public function enter() {
		/*
        $newsId = $_GET['id'];
        if(!$newsId) {
            // 执行跳转
            $this->redirect('/admin.php?c=content');
        }
        $news = D("News")->find($newsId);
        if(!$news) {
            $this->redirect('/admin.php?c=content');
        }
        $newsContent = D("NewsContent")->find($newsId);
        if($newsContent) {
            $news['content'] = $newsContent['content'];
        }

        $webSiteMenu = D("Menu")->getBarMenus();
        $this->assign('webSiteMenu', $webSiteMenu);
        $this->assign('titleFontColor', C("TITLE_FONT_COLOR"));
        $this->assign('copyfrom', C("COPY_FROM"));

        $this->assign('news',$news);
        $this->display();
		*/
        $webSiteData = D("Enter")->getEnterData();

        //$res  =  new \Think\Page($count,$pageSize);
        //$pageres = $res->show();
        //$this->assign('pageres',$pageres);
        $this->assign('enters',$webSiteData);
        $this->display();
    }
	//型号添加保存模块
    public function lensSave($data) {
        $newsId = $data['id'];
        unset($data['id']);

        try {
            $id = D("Enter")->updateLensById($newsId, $data);
            $newsContentData['content'] = $data['content'];
            $condId = D("NewsContent")->updateNewsById($newsId, $newsContentData);
            if($id === false || $condId === false) {
                return show(0, '更新失败');
            }
            return show(1, '更新成功');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }

    }
    public function setStatus() {
        try {
            if ($_POST) {
                $id = $_POST['id'];
                $status = $_POST['status'];
                if (!$id) {
                    return show(0, 'ID不存在');
                }
                $res = D("News")->updateStatusById($id, $status);
                if ($res) {
                    return show(1, '操作成功');
                } else {
                    return show(0, '操作失败');
                }
            }
            return show(0, '没有提交的内容');
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }
/*
    public function listorder() {
        $listorder = $_POST['listorder'];
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $errors = array();
        try {
            if ($listorder) {
                foreach ($listorder as $newsId => $v) {
                    // 执行更新
                    $id = D("News")->updateNewsListorderById($newsId, $v);
                    if ($id === false) {
                        $errors[] = $newsId;
                    }
                }
                if ($errors) {
                    return show(0, '排序失败-' . implode(',', $errors), array('jump_url' => $jumpUrl));
                }
                return show(1, '排序成功', array('jump_url' => $jumpUrl));
            }
        }catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        return show(0,'排序数据失败',array('jump_url' => $jumpUrl));
    }
*/
}