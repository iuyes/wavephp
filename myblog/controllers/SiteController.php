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
        $arr = $this->app()->database->db->getOne("select * from user");
        echo "<pre>";
        print_r($arr);

        $arr2 = $this->app()->database->db2->getOne("select * from joke_user");
        print_r($arr2);

        echo $this->app()->projectPath."<br>";
        
        echo "hello world!<br>";

        $User = new User();

        echo "User model 加载成功！<br>";

        $this->render('index', array('username'=>'许萍'));

        echo $this->Verifycode(4);

    }
    

}

?>