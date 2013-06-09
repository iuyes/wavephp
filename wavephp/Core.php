<?php
/**
 * 核心类
 */
class Core
{
    public static $projectPath = '';
    public static $pathInfo = '';
    public static $frameworkPath = '';
    public static $db = '';

    /**
     * 初始化
     */
    public function __construct()
    {
        if(empty(self::$projectPath)) 
            self::$projectPath = $_SERVER['DOCUMENT_ROOT'].ltrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/');
        
        if(empty(self::$frameworkPath))
            self::$frameworkPath = dirname(__FILE__).'/';
        
        if(empty(self::$pathInfo))
            self::$pathInfo = isset($_SERVER['PATH_INFO']) ? strtolower($_SERVER['PATH_INFO']) : '';

        if(empty(self::$db)){
            $config = self::$projectPath.'config/main.php';
            if(file_exists($config)){
                require $config;
                if(isset($config['database'])){
                    if(!empty($config['database'])){
                        include_once self::$frameworkPath.'db/Mysql.class.php';
                        $ndb = array();
                        foreach ($config['database'] as $key => $value) {
                            $ndb[$key] = new Mysql($value);
                        }
                        self::$db = (object) $ndb;
                        unset($ndb);
                    }
                }
            }
        }
    }

    /**
     * 清理
     */
    public function clear()
    {
        self::$projectPath = '';
        self::$frameworkPath = '';
        self::$pathInfo = '';
        self::$db = '';
    }

    /**
     * 框架内加载文件
     */
    public function requireFrameworkFile($file=null)
    {
        if (!empty($file)) {
            require self::$frameworkPath.$file.'.php';
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
            require self::$projectPath.$file.'.php';
        }else{
            exit('no file');
        }
    }

}
?>