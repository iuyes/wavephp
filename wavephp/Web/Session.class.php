<?php
/*
 * SESSION 类
 *
 */
class Session
{
    public $lifeTime = 86400;   //生存周期

    public function __construct($timeout)
    {
        $this->lifeTime = $timeout;
    }

    /**
     * 设置SESSION
     *  
     * @param string $key   session关键字
     * @param string $val   session值
     *
     */
    public function setState($key, $val)
    {
        session_set_cookie_params($this->lifeTime);
        session_start();  
        $_SESSION[$key] = $val;
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
        session_start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : '';
    }

    /**
     * 清除SESSION
     */
    public function logout()
    {
        session_start();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        session_destroy();
    }

}

?>