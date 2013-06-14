<?php
/**
 * 核心类
 */
class Core
{
    public static $projectPath = '';
    public static $pathInfo = '';
    public static $frameworkPath = '';
    public static $database = '';
    public static $autoload = true;

    /**
     * 初始化
     */
    public function __construct()
    {
        //项目路径
        if(empty(self::$projectPath)) 
            self::$projectPath = $_SERVER['DOCUMENT_ROOT'].ltrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/');
        
        //框架路径
        if(empty(self::$frameworkPath))
            self::$frameworkPath = dirname(__FILE__).'/';
        
        //url除去index.php之前的以及index.php
        if(empty(self::$pathInfo))
            self::$pathInfo = isset($_SERVER['PATH_INFO']) ? strtolower($_SERVER['PATH_INFO']) : '';

        //数据库连接
        if(empty(self::$database)){
            $config = self::$projectPath.'config/main.php';
            if(file_exists($config)){
                require $config;
                if(isset($config['database'])){
                    if(!empty($config['database'])){
                        include_once self::$frameworkPath.'Db/Mysql.class.php';
                        $ndb = array();
                        foreach ($config['database'] as $key => $value) {
                            $ndb[$key] = new Mysql($value);
                        }
                        self::$database = (object) $ndb;
                        unset($ndb);
                    }
                }
            }
        }
    }

    /**
     * 一些公共参数，供项目调用的
     *
     * 例如在项目中使用数据库 $this->app()->database->db->getOne("select * from user");
     *
     * @return object array
     *
     */
    public function app()
    {
        $parameter = array();
        $parameter['projectPath'] = self::$projectPath;
        $parameter['frameworkPath'] = self::$frameworkPath;
        $parameter['pathInfo'] = self::$pathInfo;
        $parameter['database'] = self::$database;
        return (object) $parameter;
    }

    /**
     * 加载模版
     */
    public function render($filename, $data)
    {
        $classname = get_class($this);
        $folder = strtolower(str_replace('Controller', '', $classname));
        require self::$projectPath.'views/'.$folder.'/'.$filename.'.php'; 
    }

    /**
     * 清理
     */
    public function clear()
    {
        self::$projectPath = '';
        self::$frameworkPath = '';
        self::$pathInfo = '';
        self::$database = '';
    }

    /**
     * 框架内加载文件
     *
     * @param string file 文件名
     *
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
     *
     * @param string file 文件名
     *
     */
    public function requireProjectFile($file=null)
    {
        if (!empty($file)) {
            require self::$projectPath.$file.'.php';
        }else{
            exit('no file');
        }
    }

    /**
     * 验证码
     *
     * @param int $num 验证码个数
     * 
     * @return string
     *
     */
    public function Verifycode($num)
    {
        $this->requireFrameworkFile('Library/Verifycode.class');

        return '123456';

    }

}
?>