<?php
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
        $filename = $_SERVER['DOCUMENT_ROOT'].ltrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/').'/models/'.$classname.".php";
        if(file_exists($filename)){
            require $filename;
            if(class_exists($classname)){

            }else{
                exit('没有'.$classname.'这个类！');
            }
        }else{
            exit('没有'.$classname.'.php这个文件！');
        }
    }
    
}

?>