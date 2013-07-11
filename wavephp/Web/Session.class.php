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
 * Wavephp Application Session Class
 *
 * SESSION类
 *
 * @package         Wavephp
 * @subpackage      Web
 * @author          许萍
 *
 */
class Session
{
    public $prefix      = '';       //session前缀
    public $lifeTime    = 86400;    //生存周期
    
    public function __construct($pre, $timeout)
    {
        $this->prefix = $pre.'_';
        $this->lifeTime = $timeout;
    }

    /**
     * 设置SESSION
     *  
     * @param string $key   session关键字
     * @param string $val   session值
     *
     */
    public function setState($key, $val, $timeout = null)
    {
        if(!isset($_SESSION)) session_start(); 

        if(!empty($timeout))
            $_SESSION[$this->prefix.$key.'_timeout'] = time()+$timeout;
        else
            $_SESSION[$this->prefix.$key.'_timeout'] = time()+$this->lifeTime;
  
        $_SESSION[$this->prefix.$key] = $val;
    }

    /**
     * 得到SESSION
     * 
     * @param string $key   session关键字
     *
     * @return string       session值
     *
     */
    public function getState($key)
    {
        if(!isset($_SESSION)) session_start();

        if(isset($_SESSION[$this->prefix.$key])){
            if(time() > $_SESSION[$this->prefix.$key.'_timeout']){
                unset($_SESSION[$this->prefix.$key.'_timeout']);
                unset($_SESSION[$this->prefix.$key]);
                $txt = '';
            }
            else
                $txt = $_SESSION[$this->prefix.$key];
        }else{
            $txt = '';
        }
        return $txt;
    }

    /**
     * 清除SESSION
     */
    public function logout()
    {
        if(!isset($_SESSION)) session_start();
        
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$this->prefix.$key.'_timeout']);
            unset($_SESSION[$this->prefix.$key]);
        }
        session_destroy();
    }

}

?>