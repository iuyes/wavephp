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

        if(!empty($this->pathInfo)){
            $this->pathInfo = $this->filterStr($this->pathInfo);
            $this->pathInfo = ltrim($this->pathInfo, '/');
            $pathInfoArr = explode('/', $this->pathInfo);
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

        $controller = $this->projectPath.'controllers/'.$c.'.php';
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
        echo 'Unable to resolve the request "'.$this->pathInfo.'".';
    }

}

?>