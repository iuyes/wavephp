<?php
/**
 * 控制层
 */
class Controller extends Core
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 加载模版
     */
    public function render($filename, $data)
    {
        echo $filename."<br>";
    }

    
}


?>