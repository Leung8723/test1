<?php

/* 1.文章管理中的添加功能开发==>>>使用uploadify插件和ThinkPHP上传类异步处理图片上传功能 */
	//a).使用ThinkPHP自带的图片上传类
		//自带目录: www\ThinkPHP\Library\Think\Upload.class.php
		//uploadify插件(http://www.uploadify.com/demos/)
	//b).创建www\Public\js\admin\image.js脚本(参照官方示例文档):
		$(function() {
			$('#file_upload').uploadify({
				//用的那个flash交互动画:
				'swf'      : SCOPE.ajax_upload_swf,
				//最终POST的数据:
				'uploader' : SCOPE.ajax_upload_image_url,
				'buttonText': '上传图片',
				'fileTypeDesc': 'Image Files',
				'fileObjName' : 'file',
				//允许上传的文件后缀:
				'fileTypeExts': '*.gif; *.jpg; *.png',
				'onUploadSuccess' : function(file,data,response) {
					// response true ,false
					if(response) {
						var obj = JSON.parse(data); //由JSON字符串转换为JSON对象
						console.log(data);
						$('#' + file.id).find('.data').html(' 上传完毕');
						$("#upload_org_code_img").attr("src",obj.data);
						$("#file_upload_image").attr('value',obj.data);
						$("#upload_org_code_img").show();
					}else{
						alert('上传失败');
					}
				},
			});
		});
	//c).在www\Application\Admin\View\Content\add.html中定义POST的URL脚本
		<script>
		  var SCOPE = {
			'save_url' : '/admin.php?c=content&a=add',
			'jump_url' : '/admin.php?c=content',
			'ajax_upload_image_url' : '/admin.php?c=image&a=ajaxuploadimage',
			'ajax_upload_swf' : '/Public/js/party/uploadify.swf',
		  };
		</script>
	//d).找到www\Application\Admin\Controller\ImageController.class.php控制器,新建方法:
		public function ajaxuploadimage() {
			$upload = D("UploadImage");
			$res = $upload->imageUpload();
			if($res===false) {
				return show(0,'上传失败','');
			}else{
				return show(1,'上传成功',$res);
			}
		}
	//e).Model层创建imageUpload方法,目录:www\Application\Common\Model\UploadImageModel.class.php
		class UploadImageModel extends Model {
			private $_uploadObj = '';
			private $_uploadImageData = '';
			const UPLOAD = 'upload';
			public function __construct() {
				$this->_uploadObj = new  \Think\Upload();//实例化类
				$this->_uploadObj->rootPath = './'.self::UPLOAD.'/';
				$this->_uploadObj->subName = date(Y) . '/' . date(m) .'/' . date(d);//按年月日文件夹存放文件
			}	
			public function imageUpload() {
				$res = $this->_uploadObj->upload();
				if($res) {
					return '/' .self::UPLOAD . '/' . $res['file']['savepath'] . $res['file']['savename'];//file对应image.js文件'fileObjName'参数
				}else{
					return false;
				}
			}
		}

/* 2.文章管理中的添加功能开发==>>>使用Kindeditor插件完成编辑器内部图片异步上传功能开发:(http://kindeditor.net/) */
/*		www\Application\Admin\View\Content\add.html	*/
	//a).加载第三方插件
		<script src="/Public/js/kindeditor/kindeditor-all.js"></script>
	//b).添加textarea输入框,定义一个id
		<textarea class="input js-editor" id="editor_singcms" name="content" rows="20" ></textarea>//id对应下条window.editor
	//c).在该HTML页面添加以下脚本
		<script>
		  KindEditor.ready(function(K) {
			window.editor = K.create('#editor_singcms',{//对应上条id
			  uploadJson : '/admin.php?c=image&a=kindupload',//对应接口==>>>跳转ImageController.class.php
			  afterBlur : function(){this.sync();}, 
			});
		  });
		</script>
	//d).针对编辑器图片上传接口在www\Application\Admin\Controller\ImageController.class.php中调试:
		public function kindupload(){
			$upload = D("UploadImage");
			$res = $upload->upload();
			if($res === false) {
				return showKind(1,'上传失败');//返回接口数据给JS
			}
			return showKind(0,$res);
		}
	//e).添加公共函数:www\Application\Common\Common\function.php
		function showKind($status,$data) {
			header('Content-type:application/json;charset=UTF-8');
			if($status==0) {
				exit(json_encode(array('error'=>0,'url'=>$data)));
			}
			exit(json_encode(array('error'=>1,'message'=>'上传失败')));
		}

/* 3.文章管理中的添加功能开发==>>>将数据库中数据传递到文章模板页面 */
	//添加功能通过异步方式处理
	//文章content存储在副表中
	//a).在model层www\Application\Admin\Controller\MenuController.class.php添加方法
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
	//b).在控制器层调用a)中添加的方法www\Application\Admin\Controller\ContentController.class.php:
		$webSiteMenu = D("Menu")->getBarMenus();
		$titleFontColor = C("TITLE_FONT_COLOR");//C方法调用config.php中标题颜色配置
		$copyFrom = C("COPY_FROM");
		$this->assign('webSiteMenu', $webSiteMenu);//赋值给模板
		$this->assign('titleFontColor', $titleFontColor);
		$this->assign('copyfrom', $copyFrom);
		$this->display();
	//c).配置文件www\Application\Admin\Conf\config.php
		return array(
			'TITLE_FONT_COLOR' => array(
				'#5674ed' => '蓝色',
				'#ed568b' => '红色',
			),
			'COPY_FROM' => array(
				0 => '本站',
				1 => '新浪网',
				2 => '央视网',
				3 => '网易',
				4 => '搜狐',
			),
		);
	//d).在www\Application\Admin\View\Content\add.html模板中遍历标题颜色
		<select class="form-control" name="title_font_color">
		  <option value="">==请选择颜色==</option>
			<foreach name="titleFontColor" item="color">
			  <option value="{$key}">{$color}</option>
			</foreach>
		</select>
	//e).在add.html模板中遍历栏目
		<select class="form-control" name="catid">
		  <foreach name="webSiteMenu" item="sitenav">
			<option value="{$sitenav.menu_id}">{$sitenav.name}</option>
		  </foreach>
		</select>
	//f).在add.html模板中遍历来源信息
		<select class="form-control" name="copyfrom">
		  <foreach name="copyfrom" item="cfrom">
			<option value="{$key}">{$cfrom}</option>
		  </foreach>
		</select>

/* 4.文章管理中的添加功能开发==>>>将文章相关数据提交到服务器 */
	//a).在控制器层www\Application\Admin\Controller\ContentController.class.php添加数据审核逻辑
		public function add(){
			if($_POST) {
				if(!isset($_POST['title']) || !$_POST['title']) {
					return show(0,'标题不存在');
				}
				if(!isset($_POST['small_title']) || !$_POST['small_title']) {
					return show(0,'短标题不存在');
				}
				if(!isset($_POST['catid']) || !$_POST['catid']) {
					return show(0,'文章栏目不存在');
				}
				if(!isset($_POST['keywords']) || !$_POST['keywords']) {
					return show(0,'关键字不存在');
				}
				if(!isset($_POST['content']) || !$_POST['content']) {
					return show(0,'content不存在');
				}
				if($_POST['news_id']) {
					return $this->save($_POST);
				}
				$newsId = D("News")->insert($_POST);
				if($newsId) {
					$newsContentData['content'] = $_POST['content'];
					$newsContentData['news_id'] = $newsId;
					$cId = D("NewsContent")->insert($newsContentData);//插入副表当中建立,insert参照d)中方法
					if($cId){
						return show(1,'新增成功');
					}else{
						return show(1,'主表插入成功，副表插入失败');
					}
				}else{
					return show(0,'新增失败');
				}
			}else {
				$webSiteMenu = D("Menu")->getBarMenus();
				$titleFontColor = C("TITLE_FONT_COLOR");
				$copyFrom = C("COPY_FROM");
				$this->assign('webSiteMenu', $webSiteMenu);
				$this->assign('titleFontColor', $titleFontColor);
				$this->assign('copyfrom', $copyFrom);
				$this->display();
			}
		}
	//b).在www\Application\Common\Model\NewsModel.class.php添加写入数据方法
		public function insert($data = array()) {
			if(!is_array($data) || !$data) {
				return 0;
			}
			$data['create_time']  = time();
			$data['username'] =  getLoginUsername();//参照c)函数
			return $this->_db->add($data);
		}
	//c).建立函数www\Application\Common\Common\function.php获取登录用户的用户名
		function getLoginUsername() {
			return $_SESSION['adminUser']['username'] ? $_SESSION['adminUser']['username']: '';
		}
	//d).在www\Application\Common\Model\NewsContentModel.class.php中添加方法:
		public function insert($data=array()){
			if(!$data || !is_array($data)) {
				return 0;
			}
			$data['create_time'] = time();
			if(isset($data['content']) && $data['content']) {
				$data['content'] = htmlspecialchars($data['content']);//html预定义字符HTML实体
			}
			return $this->_db->add($data);
		}

/* 5.文章管理中的添加功能开发==>>>列表功能开发 */
	//a).栏目分类展现
		//①www\Application\Admin\Controller\ContentController.class.php
		public function index() {
			$conds = array();
			$title = $_GET['title'];
			if($title) {
				$conds['title'] = $title;
			}
			if($_GET['catid']) {
				$conds['catid'] = intval($_GET['catid']);
			}
			$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
			$pageSize = 10;
			$news = D("News")->getNews($conds,$page,$pageSize);
			$count = D("News")->getNewsCount($conds);
			$res  =  new \Think\Page($count,$pageSize);
			$pageres = $res->show();
			$positions = D("Position")->getNormalPositions();
			$this->assign('pageres',$pageres);
			$this->assign('news',$news);
			$this->assign('positions', $positions);
			$this->assign('webSiteMenu',D("Menu")->getBarMenus());
			$this->display();
		}		
		//②在www\Application\Admin\View\Content\index.html中循环遍历栏目分类信息
		<select class="form-control" name="catid">
			<option value='' >全部分类</option>
			<foreach name="webSiteMenu" item="sitenav">
				<option value="{$sitenav.menu_id}" >{$sitenav.name}</option>
			</foreach>
		</select>
	//b).文章列表数据列出来
		//①在模型www\Application\Common\Model\NewsModel.class.php中添加2个方法
		public function getNews($data,$page,$pageSize=10) {
			$conditions = $data;
			if(isset($data['title']) && $data['title']) {
				$conditions['title'] = array('like','%'.$data['title'].'%');//模糊搜索
			}
			if(isset($data['catid']) && $data['catid'])  {
				$conditions['catid'] = intval($data['catid']);
			}
			$conditions['status'] = array('neq',-1);
			$offset = ($page - 1) * $pageSize;
			$list = $this->_db->where($conditions)
				->order('listorder desc ,news_id desc')
				->limit($offset,$pageSize)
				->select();
			return $list;
		}
		public function getNewsCount($data = array()){
			$conditions = $data;
			if(isset($data['title']) && $data['title']) {
				$conditions['title'] = array('like','%'.$data['title'].'%');
			}
			if(isset($data['catid']) && $data['catid'])  {
				$conditions['catid'] = intval($data['catid']);
			}
			$conditions['status'] = array('neq',-1);
			return $this->_db->where($conditions)->count();
		}
		public function find($id) {
			$data = $this->_db->where('news_id='.$id)->find();
			return $data;
		}
		//②在控制层www\Application\Admin\Controller\ContentController.class.php中添加业务逻辑
		public function index() {
			$conds = array();
			$title = $_GET['title'];
			if($title) {
				$conds['title'] = $title;
			}
			if($_GET['catid']) {
				$conds['catid'] = intval($_GET['catid']);
			}
			$page = $_REQUEST['p'] ? $_REQUEST['p'] : 1;
			$pageSize = 10;
			$news = D("News")->getNews($conds,$page,$pageSize);
			$count = D("News")->getNewsCount($conds);
			$res  =  new \Think\Page($count,$pageSize);//ThinkPHP自带分页类
			$pageres = $res->show();
			$positions = D("Position")->getNormalPositions();
			$this->assign('pageres',$pageres);
			$this->assign('news',$news);
			$this->assign('positions', $positions);
			$this->assign('webSiteMenu',D("Menu")->getBarMenus());
			$this->display();
		}
		//③在www\Application\Admin\View\Content\index.html中填充文章数据
		  <div class="row">
			<div class="col-lg-6">
			  <h3></h3>
			  <div class="table-responsive">
				<form id="singcms-listorder">
				  <table class="table table-bordered table-hover singcms-table">
					<thead>
					<tr>
					  <th id="singcms-checkbox-all" width="10"><input type="checkbox"/></th>
					  <th width="14">排序</th><!--6.7-->
					  <th>id</th>
					  <th>标题</th>
					  <th>栏目</th>
					  <th>来源</th>
					  <th>封面图</th>
					  <th>时间</th>
					  <th>状态</th>
					  <th>操作</th>
					</tr>
					</thead>
					<tbody>
					<volist name="news" id="new">
					  <tr>
						<td><input type="checkbox" name="pushcheck" value="{$new.news_id}"></td>
						<td><input size=4 type='text'  name='listorder[{$new.news_id}]' value="{$new.listorder}"/></td><!--6.7-->
						<td>{$new.news_id}</td>//id
						<td>{$new.title}</td>//标题
						<td>{$new.catid|getCatName=$webSiteMenu,###}</td>//栏目名:getCatName参照下面④处函数
						<td>{$new.copyfrom|getCopyFromById}</td>//来源:getCopyFromById参数下面④处函数
						<td>{$new.thumb|isThumb}</td>//缩略图:isThumb参照下面④处函数
						<td>{$new.create_time|date="Y-m-d H:i",###}</td>//时间格式化
						<td><span  attr-status="<if condition="$new['status'] eq 1">0<else/>1</if>"  attr-id="{$new.news_id}" class="sing_cursor singcms-on-off" id="singcms-on-off" >{$new.status|status}</span></td>//状态信息
						<td><span class="sing_cursor glyphicon glyphicon-edit" aria-hidden="true" id="singcms-edit" attr-id="{$new.news_id}" ></span>
						  <a href="javascript:void(0)" id="singcms-delete"  attr-id="{$new.news_id}"  attr-message="删除">
							<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
						  </a>
						  <a target="_blank" href="/index.php?c=detail&a=view&id={$new.news_id}" class="sing_cursor glyphicon glyphicon-eye-open" aria-hidden="true"  ></a>
						</td>
					  </tr>
					</volist>
					</tbody>
				  </table>
				  <nav>
				  <ul >
					{$pageres}
				  </ul>
				</nav>
				  <div>
					<button  id="button-listorder" type="button" class="btn btn-primary dropdown-toggle" ><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span>更新排序</button>
				  </div>
				</form>
				<div class="input-group">
				  <select class="form-control" name="position_id" id="select-push">
					<option value="0">请选择推荐位进行推送</option>
					<foreach name="positions" item="position">
					  <option value="{$position.id}">{$position.name}</option>
					</foreach>
				  </select>
				  <button id="singcms-push" type="button" class="btn btn-primary">推送</button>
				</div>
			  </div>
			</div>
		//④在www\Application\Common\Common\function.php新建函数
		function getCatName($navs, $id) {//获取分类名称
			foreach($navs as $nav) {
				$navList[$nav['menu_id']] = $nav['name'];
			}
			return isset($navList[$id]) ? $navList[$id] : '';
		}
		function getCopyFromById($id) {//获取来源信息
			$copyFrom = C("COPY_FROM");
			return $copyFrom[$id] ? $copyFrom[$id] : '';
		}
		function isThumb($thumb) {//获取缩略图是否存在
			if($thumb) {
				return '<span style="color:red">有</span>';
			}
			return '无';
		}

/* 6.文章管理中的添加功能开发==>>>文章编辑功能开发 */
	//a).控制器添加edit方法www\Application\Admin\Controller\ContentController.class.php
		public function edit() {
			$newsId = $_GET['id'];
			if(!$newsId) {
				$this->redirect('/admin.php?c=content');// 执行跳转
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
			$this->display();//对应edit模板
		}
	//b).在Model层添加find方法,www\Application\Common\Model\NewsModel.class.php
		public function find($id) {
			$data = $this->_db->where('news_id='.$id)->find();
			return $data;
		}
	//c).在Model层添加find方法,www\Application\Common\Model\NewsContentModel.class.php
		public function find($id) {
			return $this->_db->where('news_id='.$id)->find();
		}
	//d).在模板中填充数据,www\Application\Admin\View\Content\edit.html
	  <form class="form-horizontal" id="singcms-form">
		<div class="form-group">
		  <label for="inputname" class="col-sm-2 control-label">标题:</label>
		  <div class="col-sm-5">
			<input value="{$news.title}" type="text" name="title" class="form-control" id="inputname" placeholder="请填写标题">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputname" class="col-sm-2 control-label">短标题:</label>
		  <div class="col-sm-5">
			<input value="{$news.small_title}" type="text" name="small_title" class="form-control" id="inputname" placeholder="请填写短标题">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputname" class="col-sm-2 control-label">缩图:</label>
		  <div class="col-sm-5">
			<input id="file_upload"  type="file" multiple="true" >
			<img style="display: none" id="upload_org_code_img" src="{$news.thumb}" width="150" height="150">
			<input id="file_upload_image" name="thumb" type="hidden" multiple="true" value="{$news.thumb}">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputname" class="col-sm-2 control-label">标题颜色:</label>
		  <div class="col-sm-5">
			<select class="form-control" name="title_font_color">
			  <option value="">==请选择颜色==</option>
				<foreach name="titleFontColor" item="color">
				  <option value="{$key}" <if condition="$key eq $news['title_font_color']">selected="selected"</if>>{$color}</option>
				</foreach>
			</select>
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputname" class="col-sm-2 control-label">所属栏目:</label>
		  <div class="col-sm-5">
			<select class="form-control" name="catid">

			  <foreach name="webSiteMenu" item="sitenav">
				<option value="{$sitenav.menu_id}" <if condition="$sitenav['menu_id'] eq $news['catid']">selected="selected"</if>>{$sitenav.name}</option>
			  </foreach>
			</select>
		  </div>
		</div>

		<div class="form-group">
		  <label for="inputname" class="col-sm-2 control-label">来源:</label>
		  <div class="col-sm-5">
			<select class="form-control" name="copyfrom">
			  <foreach name="copyfrom" item="cfrom">

				<option value="{$key}" <if condition="$key eq $news['copyfrom']">selected="selected"</if>>{$cfrom}</option>
			  </foreach>
			</select>
		  </div>
		</div>

		<div class="form-group">
		  <label for="inputPassword3" class="col-sm-2 control-label">内容:</label>
		  <div class="col-sm-5">
			<textarea class="input js-editor" id="editor_singcms" name="content" rows="20" >{$news.content}</textarea>
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputPassword3" class="col-sm-2 control-label">描述:</label>
		  <div class="col-sm-9">
			<input value="{$news.description}" type="text" class="form-control" name="description" id="inputPassword3" placeholder="描述">
		  </div>
		</div>
		<div class="form-group">
		  <label for="inputPassword3" class="col-sm-2 control-label">关键字:</label>
		  <div class="col-sm-5">
			<input value="{$news.keywords}" type="text" class="form-control" name="keywords" id="inputPassword3" placeholder="请填写关键词">
		  </div>
		</div>
		<input type="hidden" name="news_id" value="{$news.news_id}"/>//主键id

		<div class="form-group">
		  <div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default" id="singcms-button-submit">提交</button>
		  </div>
		</div>
	  </form>
	//............↓缩略图存在时显示,不存在时隐藏
	<script>
	  var thumb = "{$news.thumb}";
	  if(thumb) {
		$("#upload_org_code_img").show();
	  }
	</script>
	
/* 7.文章管理中的添加功能开发==>>>保存更改后的信息 */
	//在www\Application\Common\Model\NewsModel.class.php添加方法
    public function updateById($id, $data) {
        if(!$id || !is_numeric($id) ) {
            throw_exception("ID不合法");
        }
        if(!$data || !is_array($data)) {
            throw_exception('更新数据不合法');
        }
        return $this->_db->where('news_id='.$id)->save($data);
    }

	//在www\Application\Admin\Controller\ContentController.class.php添加方法
    public function save($data) {
        $newsId = $data['news_id'];//获取id
        unset($data['news_id']);
        try {
            $id = D("News")->updateById($newsId, $data);
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

/* 8.文章管理中的添加功能开发==>>>删除和状态修改模块开发 */
	//在www\Application\Admin\Controller\ContentController.class.php添加方法
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
	//www\Application\Common\Model\NewsModel.class.php
    public function updateStatusById($id, $status) {
        if(!is_numeric($status)) {
            throw_exception('status不能为非数字');
        }
        if(!$id || !is_numeric($id)) {
            throw_exception('id不合法');
        }
        $data['status'] = $status;
        return $this->_db->where('news_id='.$id)->save($data);
    }
	//www\Public\js\admin\common.js
	$('.singcms-table #singcms-on-off').on('click', function(){
		var id = $(this).attr('attr-id');
		var status = $(this).attr("attr-status");
		var url = SCOPE.set_status_url;
		data = {};
		data['id'] = id;
		data['status'] = status;
		layer.open({
			type : 0,
			title : '是否提交？',
			btn: ['yes', 'no'],
			icon : 3,
			closeBtn : 2,
			content: "是否确定更改状态",
			scrollbar: true,
			yes: function(){
				todelete(url, data);// 执行相关跳转
			},
		});
	});

/* 9.文章管理中的添加功能开发==>>>文章排序功能模块开发 */
	//在控制层www\Application\Admin\Controller\ContentController.class.php中创建方法
    public function listorder() {
        $listorder = $_POST['listorder'];
        $jumpUrl = $_SERVER['HTTP_REFERER'];
        $errors = array();
        try {
            if ($listorder) {
                foreach ($listorder as $newsId => $v) {
                    $id = D("News")->updateNewsListorderById($newsId, $v);// 执行更新
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
	//www\Application\Common\Model\NewsModel.class.php
    public function updateNewsListorderById($id, $listorder) {
        if(!$id || !is_numeric($id)) {
            throw_exception('ID不合法');
        }
        $data = array('listorder'=>intval($listorder));
        return $this->_db->where('news_id='.$id)->save($data);
    }