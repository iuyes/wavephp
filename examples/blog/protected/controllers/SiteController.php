<?php
/**
 * 网站默认入口控制层
 */
class SiteController extends Controller
{
       
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 默认函数
     */
    public function actionIndex()
    {
        $Common = new Common();
        $Articles = new Articles();
        $Terms = new Terms();
        $Users = new Users();
        $catlist = $Terms->getTermsList($Common, 'category');
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagesize = 20;
        $data = array();
        $data['start'] = ($page-1)*$pagesize;
        $data['limit'] = $pagesize;
        $data['category'] = isset($_GET['category']) ? (int)$_GET['category'] : 0;
        $data['tag'] = isset($_GET['tag']) ? $_GET['tag'] : '';
        $author = 0;
        $username = $otherurl = '';
        if(isset($_GET['author'])) {
            $author = (int)$_GET['author'];
            $username = $Users->getUsername($Common, $author);
        }
        $list = $Articles->getArticleList($Common, $data, 1, $author);
        foreach ($list['list'] as $key => $value) {
            $list['list'][$key]['content'] = mb_substr($value['content'],0,250,'utf-8');
        }
        $count = $list['count'];
        
        $url = Wave::app()->homeUrl.'/site/';
        if(!empty($author)) $otherurl = '?author='.$author;
        if(!empty($data['category'])) $otherurl = '?category='.$data['category'];
        if(!empty($data['tag'])) $otherurl = '?tag='.$data['tag'];
        $pagebar = $Common->getPageBar($url, $otherurl, $count, $pagesize, $page);

        $this->render('index', array('list' => $list['list'],
                                'catlist'   => $catlist, 
                                'page'      => $page,
                                'category'  => $data['category'],
                                'username'  => $username,
                                'pagebar'   => $pagebar));
    }

    /**
     * 文章查看页
     */
    public function actionArticle()
    {
        $id = (int)$_GET['p'];
        $Common = new Common();
        $Users = new Users();
        $Articles = new Articles();
        $arr = $Articles->getArticle($Common, $id);
        $add_username = $Users->getUsername($Common, $arr['add_author']);

        $this->layout = 'index';
        $this->render('article', array('arr' => $arr, 'add_username' => $add_username));
    }

    /**
     * 评论
     */
    public function actionComment()
    {
        $this->layout = 'no';
        $this->render('comment');
    }

    /**
     * 右侧slider
     */
    public function actionSidebar()
    {
        $this->layout = 'no';
        $Common = new Common();
        $Articles = new Articles();
        $Terms = new Terms();
        $taglist = $Terms->getTermsList($Common, 'post_tag');
        $catelist = $Terms->getTermsList($Common, 'category');
        $list = $Articles->getArticleRecent($Common, 10);

        $render = array('taglist'   => $taglist,
                        'catelist'  => $catelist,
                        'list'      => $list);
        $this->render('sidebar', $render);
    }

    /**
     * 底部slider
     */
    public function actionSlider()
    {
        $Common = new Common();
        $Terms = new Terms();
        $taglist = $Terms->getTermsList($Common, 'post_tag');
        $catelist = $Terms->getTermsList($Common, 'category');
        
        $this->layout = 'no';
        $render = array('taglist'   => $taglist,
                        'catelist'  => $catelist);
        $this->render('slider', $render);
    }

    /**
     * 验证码
     */
    public function actionVerifyCode()
    {
        echo $this->verifyCode(4);
    }
    
    public function actionLogin()
    {
        Wave::app()->user->setState('username', 'Ellen Xu');
    }

    public function actionLogout()
    {
        Wave::app()->user->logout();
    }

}

?>