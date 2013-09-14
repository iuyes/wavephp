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
     * 后台首页
     */
    public function actionIndex()
    {
        if(Wave::app()->user->getState('userid')){
            $infoarr = array();
            $Common = new Common();
            $Articles = new Articles();
            $Terms = new Terms();
            $infoarr['article_count'] = $Articles->getArticleCount($Common);
            $infoarr['cate_count'] = $Terms->getTermsCount($Common, 'category');
            $infoarr['tag_count'] = $Terms->getTermsCount($Common, 'post_tag');
            $this->render('index', array('infoarr'=>$infoarr));
        }else{
            $this->redirect(Wave::app()->homeUrl.'/site/login');
        }
    }
    
    /**
     * 登录界面
     */
    public function actionLogin()
    {
        if(Wave::app()->user->getState('userid')){
            $this->redirect(Wave::app()->homeUrl);
        }else{
            $this->layout = 'login';
            $this->render('login');
        }
    }

    /**
     * 登录
     */
    public function actionLoging()
    {
        $Common = new Common();
        $data = $Common->getFilter($_POST);
        if(empty($data['user_login']))
            $Common->exportResult(false, '请输入用户名！');

        if(empty($data['user_pass']))
            $Common->exportResult(false, '请输入密码！');
        
        $Users = new Users();
        $user = $Users->getUser($Common, $data['user_login']);
        $password = $Users->hashPassword($data['user_pass']);
        if(empty($user)){
            $Common->exportResult(false, '用户名不存在！');
        }elseif($user['user_pass'] === $password){
            Wave::app()->user->setState('userid', $user['id']);
            Wave::app()->user->setState('username', $data['user_login']);
            $Common->exportResult(true, '登录成功！');
        }else{
            $Common->exportResult(false, '密码错误！');
        }
    }

    /**
     * 退出
     */
    public function actionLogout()
    {
        Wave::app()->user->logout();
        $this->redirect(Wave::app()->homeUrl);
    }

}

?>