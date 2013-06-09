<?php
/**
 * route控制类 
 */
class Route extends Core
{
    /**
     * 初始化
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 过滤危险字符
     *
     * @return String
     *
     */
    private function filterStr($str)
    {
        return preg_replace('/(\~)|(\!)|(\@)|(\#)|(\$)|(\%)|(\^)|(\&)|(\*)|(\()|(\))|(\-)|(\+)|(\[)|(\])|(\')|(\")|(\<)|(\>)|(\?)|(\.)|(\|)/', '', $str);
    }

    /**
     * route 处理
     */
    public function route()
    {
        $callarray = array();
        $rpathInfo = parent::$pathInfo;
        if(!empty($rpathInfo)){
            $rpathInfo = $this->filterStr($rpathInfo);
            $rpathInfo = ltrim($rpathInfo, '/');
            $pathInfoArr = explode('/', $rpathInfo);
            $c = ucfirst($pathInfoArr[0]).'Controller';
            $f = !empty($pathInfoArr[1]) ? 'action'.ucfirst($pathInfoArr[1]) : 'actionIndex';
            if(count($pathInfoArr) > 2){
                array_shift($pathInfoArr);
                array_shift($pathInfoArr);
                $callarray = array_filter($pathInfoArr);
            }
        }else{
            $c = 'SiteController';
            $f = 'actionIndex';
        }

        $controller = parent::$projectPath.'controllers/'.$c.'.php';
        if(file_exists($controller)){
            $this->requireProjectFile('controllers/'.$c);
            if(class_exists($c)){
                $cc = new $c;
                if(method_exists($cc, $f)){
                    if(!empty($callarray)){
                        call_user_func_array(array($cc,$f), $callarray);
                    }else{
                        $cc->$f();
                    }
                }else{
                   $this->error404(); 
                }
            }else{
                $this->error404(); 
            }
        }else{
            $this->error404();
        }
        
    }

    /**
     * url错误返回404
     */
    public function error404()
    {
        echo "<h2>Error 404</h2>";
        echo 'Unable to resolve the request "'.parent::$pathInfo.'".';
    }

}

?>