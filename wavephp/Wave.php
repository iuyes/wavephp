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
    public function run($config=null)
    {
        $this->requireFrameworkFile('Route');
        $this->requireFrameworkFile('Controller');
        $Route = new Route();
        $Route->route();
        
        
    }

    

}

?>