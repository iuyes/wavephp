<?php
    header('Content-Type:text/html;charset=utf-8');
    // error_reporting(0);
    
    require '../wavephp/Wave.php';
    $config = dirname(__FILE__).'/config/main.php';

    function __autoload($classname) {
        $filename = dirname(__FILE__).'/models/'.$classname.".php";
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

    $wave = new Wave();
    $wave->run($config);

?>