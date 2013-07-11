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
        echo Wave::app()->user->getState('userid')."<br>";
        echo Wave::app()->user->getState('username');
    }
    
    /**
     * 登录界面
     */
    public function actionLogin()
    {
        $userid = Wave::app()->user->getState('userid');
        if(empty($userid))
            $this->render('login');
        else
            echo Wave::app()->homeUrl;
    }

    /**
     * 登录
     */
    public function actionLoging()
    {
        $Common = new Common();
        $data = $_POST;
        if(empty($data['user_login']))
            $Common->exportResult(false, '请输入用户名！');

        if(empty($data['user_pass']))
            $Common->exportResult(false, '请输入密码！');
        
        $Users = new Users();
        $data = $Common->getFilter($data);
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
    }

}

?>