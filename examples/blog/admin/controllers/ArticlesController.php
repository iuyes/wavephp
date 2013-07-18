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
        $data['start'] = 0;
        $data['limit'] = 20;
        $list = $Articles->getArticleList($Common, $data);

        $this->render('index', array('list'=>$list));
    }



}