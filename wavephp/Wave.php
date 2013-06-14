<?php
require dirname(__FILE__).'/Core.php';

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
        $this->requireFrameworkFile('Model');
        $this->requireFrameworkFile('WaveBase');

        $Route = new Route();

        spl_autoload_register(array('WaveBase', 'loader'));

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

?>