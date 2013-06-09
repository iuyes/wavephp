<?php
require 'Core.php';

/**
 * 框架入口
 */
class Wave extends Core
{
    /**
     * 初始化
     */
    public function __construct()
    {  
        parent::__construct();
    }

    /**
     * 开始
     */
    public function run()
    {
        $this->requireFrameworkFile('Route');
        $this->requireFrameworkFile('Controller');
        $Route = new Route();
        $Route->route();

        //关闭数据库连接
        if(!empty(parent::$database)) {
            foreach (parent::$database as $key => $value) {
                parent::$database->$key->close();
            }
        }
        $this->clear();
    }
    
}


/**
 * 自动加载函数
 *
 * 用于实例化数据库
 * 例如 $User = new User();
 * 会自动加载  项目路径/models/User.php 这个文件
 * 
 */
function __autoload($classname) {
    $filename = $_SERVER['DOCUMENT_ROOT'].ltrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/').'/models/'.$classname.".php";
    if(file_exists($filename)){
        require $filename;
        if(class_exists($classname)){

        }else{
            exit('没有'.$classname.'这个类！');
        }
    }else{
        exit('没有'.$classname.'.php这个文件！');
    }
}

?>