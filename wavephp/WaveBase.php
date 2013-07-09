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
 * Wavephp Application WaveBase Class
 *
 * 基础类
 *
 * @package         Wavephp
 * @author          许萍
 *
 */
class WaveBase
{
    /**
     * 自动加载函数
     *
     * 用于实例化数据库
     * 例如 $User = new User();
     * 会自动加载  项目路径/models/User.php 这个文件
     * 
     */
    public static function loader($classname) 
    {
        $path = $_SERVER['DOCUMENT_ROOT'].ltrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/');
        $config = $path.'/config/main.php';
        if(file_exists($config)){
            require $config;
            if(isset($config['import'])){
                $import = $config['import'];
                foreach ($import as $key => $value) {
                    $filename = $path.str_replace('.*', '', $value).'/'.$classname.'.php';
                    if(file_exists($filename)){
                        require $filename;
                        if(class_exists($classname)){

                        }else{
                            exit('没有'.$classname.'这个类！');
                        }
                        break;
                    }else{
                        exit('没有'.$classname.'.php这个文件！');
                    }
                }
            }
        }
    }
    
}

?>