<?php
/**
 * PHP 5.0 以上
 * 
 * @package         Wavephp
 * @author          许萍
 * @copyright       Copyright (c) 2013
 * @link            https://github.com/xpmozong/wavephp
 * @since           Version 1.0
 *
 */

/**
 * Wavephp Application Core Class
 *
 * 核心类
 *
 * @package         Wavephp
 * @author          许萍
 *
 */
class Core
{
    public static $projectPath = '';        //项目路径
    public static $hostInfo = '';           //当前域名
    public static $pathInfo = '';           //除域名外以及index.php
    public static $homeUrl = '';            //除域名外的地址
    public static $baseUrl = '';            //除域名外的根目录地址
    public static $frameworkPath = '';      //框架路径
    public static $config = '';             //配置项目
    public static $database = '';           //数据库连接对象
    public static $memcache = '';           //memcache 缓存对象
    public static $session = '';            //SESSION 对象
    public $layout = 'main';

    /**
     * 初始化
     */
    public function __construct()
    {
        if(empty(self::$projectPath)) 
            self::$projectPath = 
            $_SERVER['DOCUMENT_ROOT'].ltrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/');
        
        if(empty(self::$frameworkPath))
            self::$frameworkPath = dirname(__FILE__).'/';

        if(empty(self::$hostInfo))
            self::$hostInfo = 
            isset($_SERVER['HTTP_HOST']) 
            ? strtolower($_SERVER['HTTP_HOST']) : '';
        
        if(empty(self::$pathInfo))
            self::$pathInfo = 
            isset($_SERVER['PATH_INFO']) 
            ? strtolower($_SERVER['PATH_INFO']) : '/site/index';

        if(empty(self::$homeUrl))
            self::$homeUrl = 
            isset($_SERVER['SCRIPT_NAME']) 
            ? strtolower($_SERVER['SCRIPT_NAME']) : '';

        if(empty(self::$baseUrl))
            self::$baseUrl = 
            isset($_SERVER['SCRIPT_NAME']) 
            ? strtolower(str_replace('index.php', '', $_SERVER['SCRIPT_NAME'])) : '';

        if(empty(self::$config)){
            $main = self::$projectPath.'config/main.php';
            if(file_exists($main)){
                require $main;
                self::$config = $config;
            }
        }

        $this->loadDatabase();
        $this->loadMemcache();
        $this->loadSession();
    }

    /**
     * 数据库连接
     */
    private function loadDatabase()
    {
        if(empty(self::$database)){
            if(!empty(self::$config)){
                if(isset(self::$config['database'])){
                    if(!empty(self::$config['database'])){
                        require self::$frameworkPath.'Db/Mysql.class.php';
                        $ndb = array();
                        foreach (self::$config['database'] as $key => $value) {
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
     * memcache 连接
     */
    private function loadMemcache()
    {
        if(empty(self::$memcache)){
            if(!empty(self::$config)){
                if(isset(self::$config['memcache'])){
                    if(!empty(self::$config['memcache'])){
                        $cache = array();
                        foreach (self::$config['memcache'] as $key => $value) {
                            $cache[$key] = new Memcache();
                            $cache[$key]->connect($value['host'], $value['port']) 
                            or die ("Could not connect ".$value['host']);
                        }
                        self::$memcache = (object) $cache;
                        unset($cache);
                    }
                }
            }
        }
    }

    /**
     * SEESION
     */
    private function loadSession()
    {
        if(empty(self::$session)){
            $lifeTime = 3600;
            if(!empty(self::$config)){
                if(isset(self::$config['session'])){
                    if(!empty(self::$config['session']['timeout']))
                        $lifeTime = self::$config['session']['timeout'];
                }
            }
            require self::$frameworkPath.'Web/Session.class.php';
            self::$session = new Session($lifeTime);
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
        require self::$projectPath.'views/layout/'.$this->layout.'.php';
    }

    /**
     * 清理
     */
    public function clear()
    {
        self::$projectPath = '';
        self::$hostInfo = '';
        self::$pathInfo = '';
        self::$homeUrl = '';
        self::$baseUrl = '';
        self::$frameworkPath = '';
        self::$config = '';
        self::$database = '';
        self::$memcache = '';
        self::$session = '';
    }

    /**
     * 框架内加载文件
     *
     * @param string $file      文件名
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
     * @param string $file      文件名
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
     * @param int $num          验证码个数
     * @param int $width        验证码宽度
     * @param int $height       验证码高度
     * 
     * @return string
     *
     */
    public function verifyCode($num = 4, $width = 130, $height = 50)
    {
        $this->requireFrameworkFile('Library/VerifyCode.class');
        $VerifyCode = new VerifyCode(self::$frameworkPath);      //实例化一个对象
        $VerifyCode->codelen = $num;
        $VerifyCode->width = $width;
        $VerifyCode->height = $height;
        $VerifyCode->doimg();
        self::$session->setState('verifycode', $VerifyCode->getCode(), 300);
    }

}
?>