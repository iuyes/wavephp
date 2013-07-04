<?php
/**
 * 核心类
 */
class Core
{
    public static $projectPath = '';        //项目路径
    public static $hostInfo = '';           //当前域名
    public static $pathInfo = '';           //除域名外以及index.php
    public static $homeUrl = '';            //除域名外的地址
    public static $baseUrl = '';            //除域名外的根目录地址
    public static $frameworkPath = '';      //框架路径
    public static $database = '';
    public static $session = '';
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

        $this->loadDatabase();
        $this->loadSession();
    }

    /**
     * 数据库连接
     */
    private function loadDatabase()
    {
        if(empty(self::$database)){
            $config = self::$projectPath.'config/main.php';
            if(file_exists($config)){
                require $config;
                if(isset($config['database'])){
                    if(!empty($config['database'])){
                        require self::$frameworkPath.'Db/Mysql.class.php';
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
     * SEESION
     */
    private function loadSession()
    {
        if(empty(self::$session)){
            $config = self::$projectPath.'config/main.php';
            $lifeTime = 3600;
            if(file_exists($config)){
                require $config;
                if(isset($config['session'])){
                    if(!empty($config['session']['timeout']))
                        $lifeTime = $config['session']['timeout'];
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
        self::$session->setState('verifycode', $VerifyCode->getCode(), 30);
    }

}
?>