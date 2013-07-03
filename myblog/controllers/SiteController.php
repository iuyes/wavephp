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
        $arr = Wave::app()->database->db->getOne("select user from user");
        print_r($arr);

        echo "<br>";

        $arr2 = Wave::app()->database->db2->getOne("select * from joke_user");
        print_r($arr2);

        echo "<br>";

        echo Wave::app()->projectPath."<br>";

        echo Wave::app()->hostInfo."<br>";

        echo Wave::app()->pathInfo."<br>";

        echo Wave::app()->homeUrl."<br>";

        echo Wave::app()->baseUrl."<br>";
        
        echo "hello world!<br>";

        // spl_autoload_unregister(array('WaveBase','loader'));

        $User = new User();

        echo "User model 加载成功！<br>";

        // $this->layout='index';
        $this->render('index', array('username'=>'许萍'));

        // echo "<pre>";
        // print_r(get_included_files());

    }

    /**
     * 验证码
     */
    public function actionVerifyCode()
    {
        echo $this->verifyCode(4);
    }
    


}

?>