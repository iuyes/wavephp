<?php
/**
 * 核心类
 */
class Core
{
    public $projectPath = '';
    public $pathInfo = '';
    public $frameworkPath = '';

    function __construct()
    {
        $this->projectPath = $_SERVER['DOCUMENT_ROOT'].ltrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/');
        $this->frameworkPath = dirname(__FILE__).'/';
        $this->pathInfo = isset($_SERVER['PATH_INFO']) ? strtolower($_SERVER['PATH_INFO']) : '';
    }

    /**
     * 框架内加载文件
     */
    public function requireFrameworkFile($file=null)
    {
        if (!empty($file)) {
            require $this->frameworkPath.$file.'.php';
        }else{
            exit('no file');
        }
    }

    /**
     * 项目内加载文件
     */
    public function requireProjectFile($file=null)
    {
        if (!empty($file)) {
            require $this->projectPath.$file.'.php';
        }else{
            exit('no file');
        }
    }

    

}
?>