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
        $arr = $this->app()->database->db->getOne("select user from user");
        // echo "<pre>";
        print_r($arr);

        echo "<br>";

        $arr2 = $this->app()->database->db2->getOne("select * from joke_user");
        print_r($arr2);

        echo "<br>";

        echo $this->app()->projectPath."<br>";

        echo $this->app()->hostInfo."<br>";

        echo $this->app()->pathInfo."<br>";

        echo $this->app()->homeUrl."<br>";

        echo $this->app()->baseUrl."<br>";
        
        echo "hello world!<br>";

        // spl_autoload_unregister(array('WaveBase','loader'));

        $User = new User();

        echo "User model 加载成功！<br>";

        // $this->layout='index';
        $this->render('index', array('username'=>'许萍'));

        // echo "<pre>";
        // print_r(get_included_files());

        // echo $this->verifyCode(4);

    }
    

}

?>