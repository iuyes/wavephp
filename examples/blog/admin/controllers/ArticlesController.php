<?php
/**
 * 文章控制层
 */
class ArticlesController extends Controller
{
    public $defaultAction = 'Index';
    public $userid;
    public $username;
       
    public function __construct()
    {
        parent::__construct();
        if(Wave::app()->user->getState('userid')) {
            $this->userid = Wave::app()->user->getState('userid');
            $this->username = Wave::app()->user->getState('username');
        }else{
            $this->redirect(Wave::app()->homeUrl);
        }
    }

    /**
     * 文章页
     */
    public function actionIndex()
    {
        $Common = new Common();
        $Articles = new Articles();
        $Terms = new Terms();
        $catlist = $Terms->getTermsList($Common, 'category');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagesize = 15;
        $data = array();
        $data['start'] = ($page-1)*$pagesize;
        $data['limit'] = $pagesize;
        $data['category'] = isset($_GET['category']) ? (int)$_GET['category'] : 0;
        $list = $Articles->getArticleList($Common, $data);
        $count = $Articles->getArticleCount($Common);
        $url = Wave::app()->homeUrl.'/articles/';
        $pagebar = $Common->getAdminPageBar($url, $count, $pagesize, $page);

        $this->render('index', array('list' => $list,
                                'catlist'   => $catlist, 
                                'pagebar'   => $pagebar, 
                                'page'      => $page,
                                'category'  => $data['category']));
    }

    /**
     * 添加、编辑文章页面
     */
    public function actionEdit($id)
    {
        $id = (int)$id;
        $Common = new Common();
        $Articles = new Articles();
        $Terms = new Terms();
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $category = isset($_GET['category']) ? (int)$_GET['category'] : 0;
        $catlist = $Terms->getTermsList($Common, 'category');
        $arr = $Articles->getArticle($Common, $id);

        $this->render('edit', array('arr' => $arr, 
                                    'catlist'   => $catlist, 
                                    'page'      => $page,
                                    'category'  => $category));
    }

    /**
     * 添加、编辑文章
     */
    public function actionModify()
    {
        $Common = new Common();
        $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
        $category = isset($_POST['cate']) ? (int)$_POST['cate'] : 0;
        $data = $Common->getFilter($_POST);
        $aid = (int)$data['aid'];
        unset($data['aid'], $data['page'], $data['cate']);
        $Articles = new Articles();
        if($aid > 0){
            $res = $Articles->modifyArticles($Common, $data, $aid);
            $msg = $res === true ? '编辑文章成功！' : '文章标题已存在！';
        }else{
            $data['add_author'] = $this->userid;
            $res = $Articles->addArticles($Common, $data);
            $msg = $res === true ? '添加文章成功！' : '文章标题已存在！';
        }

        $this->jumpBox($msg, 
        Wave::app()->homeUrl.'/articles/?page='.$page.'&category='.$category, 1);
    }

    /**
     * 删除文章
     */
    public function actionDelete($id)
    {
        $id = (int)$id;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $category = isset($_GET['category']) ? (int)$_GET['category'] : 0;
        if($id > 0){
            $Common = new Common();
            $Articles = new Articles();
            $res = $Articles->deleteArticles($Common, $id);
            $msg = $res === true ? '删除文章成功！' : '删除文章失败！';
        }else{
            $msg = '请选择要删除的文章！';
        }

        $this->jumpBox($msg, 
        Wave::app()->homeUrl.'/articles/?page='.$page.'&category='.$category, 1);
    }

    /**
     * 上传文件
     */
    public function actionUpload()
    {
        $type = isset($_GET['type']) ? $_GET['type'] : 'files';
        $projectPath = Wave::app()->projectPath;
        $uploadPath = $projectPath.'uploadfile/'.$type;
        $Common = new Common();
        $Options = new Options();
        $Multimedias = new Multimedias();
        $baseurl = $Options->getSiteurl($Common).Wave::app()->request->baseUrl;
        if(!is_dir($uploadPath)) mkdir($uploadPath, 0777);
        $fn = $_GET['CKEditorFuncNum'];
        if($type == 'images'){
            $imgTypeArr = array('image/jpeg','image/jpg',
                                'image/gif','image/png',
                                'image/bmp','image/pjepg');
            if(!in_array($_FILES['upload']['type'], $imgTypeArr)){
                exit('图片格式错误！');
            }else{
                $imageSet = $Options->getImagesSet($Common);
                require_once $projectPath.'extension/phpthumb/ThumbLib.inc.php';
                $str = $Multimedias->uploadImg($Common,$type,
                        $uploadPath,$baseurl,$imageSet,$_FILES,$fn);

                exit($str);
            }
        }
    }

}