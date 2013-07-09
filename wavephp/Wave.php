<?php
require dirname(__FILE__).'/Core.php';
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
 * Wavephp Application Wave Class
 *
 * 框架入口
 *
 * @package         Wavephp
 * @author          许萍
 *
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
        $parameter = $request = array();
        $parameter['projectPath'] = parent::$projectPath;
        $parameter['homeUrl'] = parent::$homeUrl;
        $parameter['database'] = parent::$database;
        $parameter['memcache'] = parent::$memcache;

        $request['hostInfo'] = parent::$hostInfo;
        $request['pathInfo'] = parent::$pathInfo;
        $request['baseUrl'] = parent::$baseUrl;
        $parameter['request'] = (object) $request;
        unset($request);

        $parameter['user'] = parent::$session;

        return (object) $parameter;
    }


    
}

?>