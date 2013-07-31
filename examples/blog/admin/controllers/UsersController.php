<?php
/**
 * 用户控制层
 */
class UsersController extends Controller
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
     * 获得登录信息
     */
    public function actionInfo()
    {
        $Common = new Common();

        $Common->exportResult(true, $this->username);
    }

}