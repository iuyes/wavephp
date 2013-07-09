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
    public static $frameworkPath    = '';      //框架路径
    public static $projectPath      = '';      //项目路径
    public static $projectName      = '';      //项目名称
    public static $modelName        = '';      //需要加载的模型文件夹名
    public static $hostInfo         = '';      //当前域名
    public static $pathInfo         = '';      //除域名外以及index.php
    public static $homeUrl          = '';      //除域名外的地址
    public static $baseUrl          = '';      //除域名外的根目录地址
    public static $import           = '';      //需要加载的文件夹
    public static $config           = '';      //配置项目
    public static $database         = '';      //数据库连接对象
    public static $memcache         = '';      //memcache 缓存对象
    public static $session          = '';      //SESSION 对象
    public static $defaultControl   = '';      //默认控制层

    /**
     * 初始化
     */
    public function __construct($config = null)
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
            if(!empty($config)) self::$config = $config;
        }

        if(empty(self::$projectName)){
            self::$projectName = !empty($config['projectName']) 
            ? $config['projectName'] : 'protected';
        }

        if(empty(self::$modelName)){
            self::$modelName = !empty($config['modelName']) 
            ? $config['modelName'] : 'protected';
        }

        if(empty(self::$import)){
            self::$import = !empty($config['import']) ? $config['import'] : '';
        }

        if(empty(self::$defaultControl)){
            self::$defaultControl = !empty($config['defaultController']) 
            ? $config['defaultController'] : 'site';
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
     * 一些公共参数，供项目调用的
     *
     * 例如在项目中输出除域名外的根目录地址 Wave::app()->homeUrl;
     *
     * @return object array
     *
     */
    public static function app()
    {
        $parameter = $request = array();
        $parameter['frameworkPath']     = self::$frameworkPath;
        $parameter['projectPath']       = self::$projectPath;
        $parameter['projectName']       = self::$projectName;
        $parameter['modelName']         = self::$modelName;
        $parameter['homeUrl']           = self::$homeUrl;
        $parameter['database']          = self::$database;
        $parameter['memcache']          = self::$memcache;
        $parameter['user']              = self::$session;
        $parameter['import']            = self::$import;
        $parameter['defaultControl']    = self::$defaultControl;
        $request['hostInfo']            = self::$hostInfo;
        $request['pathInfo']            = self::$pathInfo;
        $request['baseUrl']             = self::$baseUrl;
        $parameter['request']           = (object) $request;
        unset($request);

        return (object) $parameter;
    }

    /**
     * 清理
     */
    public function clear()
    {
        self::$frameworkPath    = '';
        self::$projectPath      = '';
        self::$projectName      = '';
        self::$modelName        = '';
        self::$config           = '';
        self::$database         = '';
        self::$memcache         = '';
        self::$session          = '';
        self::$hostInfo         = '';
        self::$pathInfo         = '';
        self::$homeUrl          = '';
        self::$baseUrl          = '';
        self::$import           = '';
        self::$defaultControl   = '';
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

}
?>