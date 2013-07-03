<?php
/**
 * 核心类
 */
class Core
{
    public static $projectPath = '';
    public static $hostInfo = '';
    public static $pathInfo = '';
    public static $homeUrl = '';
    public static $baseUrl = '';
    public static $frameworkPath = '';
    public static $database = '';
    public $layout = 'main';

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

        //当前域名
        if(empty(self::$hostInfo))
            self::$hostInfo = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : '';
        
        //除域名外以及index.php
        if(empty(self::$pathInfo))
            self::$pathInfo = isset($_SERVER['PATH_INFO']) ? strtolower($_SERVER['PATH_INFO']) : '/site/index';

        //除域名外的地址
        if(empty(self::$homeUrl))
            self::$homeUrl = isset($_SERVER['SCRIPT_NAME']) ? strtolower($_SERVER['SCRIPT_NAME']) : '';

        //除域名外的根目录地址
        if(empty(self::$baseUrl))
            self::$baseUrl = isset($_SERVER['SCRIPT_NAME']) ? strtolower(str_replace('index.php', '', $_SERVER['SCRIPT_NAME'])) : '';

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
     * 加载模版
     * 
     * @param string $filename      文件名
     * @param array  $variables     数据
     *
     */
    public function render($filename, $variables)
    {
        $classname = get_class($this);
        $folder = strtolower(str_replace('Controller', '', $classname));
        //数组变量转换
        extract($variables, EXTR_SKIP);
        ob_start();
        require self::$projectPath.'views/'.$folder.'/'.$filename.'.php';
        $content = ob_get_contents();
        ob_end_clean();
        if($this->layout === 'main'){
            require self::$projectPath.'views/layout/main.php'; 
        }else{
            require self::$projectPath.'views/layout/'.$this->layout.'.php';
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
        self::$database = '';
    }

    /**
     * 框架内加载文件
     *
     * @param string $file 文件名
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
     * @param string $file 文件名
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
    public function verifyCode($num)
    {
        $this->requireFrameworkFile('Library/Verifycode.class');

        return '123456';

    }

}
?>