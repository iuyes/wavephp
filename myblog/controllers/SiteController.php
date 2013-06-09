<?php
/**
 * 网站默认入口控制层
 */
class SiteController extends Controller
{
    
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 默认函数
     */
    public function actionIndex()
    {
        echo $this->projectPath."<br>";
        
        echo "hello world!<br>";

        $User = new User();

        echo "User model 加载成功！<br>";

        $this->render('index', array('username'=>'许萍'));

    }
    

}

?>