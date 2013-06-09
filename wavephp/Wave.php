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
        // var_dump(parent::$db);die;
        if(!empty(parent::$db)) {
            foreach (parent::$db as $key => $value) {
                parent::$db->$key->close();
            }
        }
        $this->clear();
    }
    
}

/**
 * 自动加载函数
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