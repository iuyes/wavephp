<?php
/**
 * 用户表
 */
class Users
{
    /**
     * 表名
     * @return string       表名
     */
    public function tableName()
    {
        return 'users';
    }

    /**
     * 密码加密
     * @return string       加密过后的密码     
     */
    public function hashPassword($pwd)
    {
        return md5($pwd);
    }

    /**
     * 获得用户信息
     * @param class $Common     公共类模型
     * @param string $username  用户名
     * @return array            用户信息数组
     */
    public function getUser($Common, $username)
    {
        return $Common->getOneData($this->tableName(), 
                    'id,user_login,user_pass',
                    'user_login',
                    $username);
    }

    /**
     * 根据id获得用户名称
     * @param class $Common     公共类模型
     * @param int $id           用户id
     * @return string           用户名
     */
    public function getUsername($Common, $id)
    {
        $arr = $Common->getOneData($this->tableName(),'user_login','id',$id);

        return $arr['user_login'];
    }

}
?>