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
        // Wave::app()->user->setState('username', 'Ellen Xu');
        $this->render('login');
    }

    public function actionLogout()
    {
        Wave::app()->user->logout();
    }

    public function actionExportCode()
    {
        echo Wave::app()->user->getState('verifycode');
    }

}

?>