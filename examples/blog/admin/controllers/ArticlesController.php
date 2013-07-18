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
        $data['start'] = 0;
        $data['limit'] = 20;
        $list = $Articles->getArticleList($Common, $data);

        $this->render('index', array('list'=>$list,'catlist'=>$catlist));
    }

    /**
     * 添加、编辑文章页面
     */
    public function actionModifyPage($id)
    {
        $id = (int)$id;
        $Common = new Common();
        $Articles = new Articles();
        $Terms = new Terms();
        $catlist = $Terms->getTermsList($Common, 'category');
        $arr = array();
        $arr['term_id'] = 0;

        $this->render('modifypage', array('arr'=>$arr, 'catlist'=>$catlist));
    }

}