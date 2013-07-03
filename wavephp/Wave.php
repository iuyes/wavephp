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
        $parameter = array();
        $parameter['projectPath'] = parent::$projectPath;
        $parameter['hostInfo'] = self::$hostInfo;
        $parameter['pathInfo'] = self::$pathInfo;
        $parameter['homeUrl'] = self::$homeUrl;
        $parameter['baseUrl'] = self::$baseUrl;
        $parameter['database'] = self::$database;
        return (object) $parameter;
    }
    
}

?>