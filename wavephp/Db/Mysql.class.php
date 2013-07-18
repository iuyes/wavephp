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
 * Wavephp Application Mysql Class
 *
 * 数据库类
 *
 * @package         Wavephp
 * @subpackage      Db
 * @author          许萍
 *
 */
class Mysql
{
    private $dbhost;            //数据库地址
    private $dbport;            //数据库端口
    private $dbuser;            //数据库用户名
    private $dbpasswd;          //数据库密码
    private $dbpconnect = 0;    //数据库长连接
    private $dbname;            //数据库名称
    private $dbchart;           //数据库链接编码
    private $dblink;            //数据库连接对象
    private $sql;               //sql语句
    private $res;               //sql语句执行结果
    private $errno;             //错误信息
     
    public function __construct($dbConfig)
    {
        $this->dbhost       = $dbConfig['dbhost'];
        $this->dbport       = isset($dbConfig['dbport']) ? $dbConfig['dbport'] : 3306;
        $this->dbuser       = $dbConfig['dbuser'];
        $this->dbpasswd     = $dbConfig['dbpasswd'];
        $this->dbpconnect   = $dbConfig['dbpconnect'];
        $this->dbname       = $dbConfig['dbname'];
        $this->dbchart      = $dbConfig['dbchart'];
        if($this->dbpconnect) {
            $this->dblink = mysql_pconnect($this->dbhost.':'.$this->dbport,$this->dbuser,$this->dbpasswd,1) 
            or die('can not connect to mysql database!');
        } else {
            $this->dblink = mysql_connect($this->dbhost.':'.$this->dbport,$this->dbuser,$this->dbpasswd,1) 
            or die('can not connect to mysql database!');
        }
        mysql_query('set names '.$this->dbchart, $this->dblink);
        mysql_select_db($this->dbname, $this->dblink);
        unset($dbConfig);
    }
 
    /**
     * 数据库执行语句
     *
     * @return blooean
     *
     */
    public function query($sql, $die_msg = 1)
    {
        $this->sql = $sql;
        $result = @mysql_query($sql, $this->dblink); //可以用自定义错误信息的方法，就要压制本身的错误信息
        if($result == true) {
            return $result;
        }else{
            //有错误发生
            $this->errno = mysql_error($this->dblink);
            if($this->errno >0) {
                if($die_msg == 1) {
                    //强制报错并且die
                    $this->msg();
                }else{
                    return $this->errno;//无强制报错，则返回错误代码
                }
            }
        }
    }

    /**
     * 插入数据
     *
     * @param string $table         : 表名
     * @param array  $array         : 数据数组
     *
     * @return boolean 
     *
     */
    public function insertdb($table, $array)
    {
        $tbcolumn = $tbvalue = '';
        foreach($array  as $key=>$value){
            $tbcolumn .= '`'.$key.'`'.",";
            $tbvalue  .= "'".$value."',";
        }
        $tbcolumn = "(".trim($tbcolumn,',').")";
        $tbvalue = "(".trim($tbvalue,',').")";
        $sql = "INSERT INTO `".$table."` ".$tbcolumn." VALUES ".$tbvalue;
        if($this->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 更新数据
     *
     * @param string $table         : 表名
     * @param array  $array         : 数据数组
     * @param string $where_field   : Where子句的字段名
     * @param string $where_value   : Where子句的值
     * @param string $type          : Where子句是不是IN  
     *
     * @return boolean
     *
     */
    public function updatedb($table, $array, $where_field, $where_value, $type=null)
    {
        $update = array();
        foreach ($array as $key => $value){
            $update[] = '`'.$key.'` = '."'".$value."'";
        }
        $update = implode(",",$update);
        
        if ($type == 'IN'){
            $sql = 'UPDATE `'.$table.'` SET '.$update.' WHERE '.$where_field.' IN ('.$where_value.')';
        }else{
            $sql = 'UPDATE `'.$table.'` SET '.$update.' WHERE '.$where_field.' = '." '".$where_value."'";
        }
        if($this->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 获得查询语句单条结果
     *
     * @return array
     *
     */
    public function getOne($sql) 
    {
        $this->sql = $sql;
        $this->res = $this->query($sql);
        return mysql_fetch_assoc($this->res);
    }
 
    /**
     * 获得查询语句多条结果
     *
     * @return array
     *
     */
    public function getAll($sql) 
    {
        $this->sql = $sql;
        $this->res = $this->query($sql);
        $arr = array();
        while($row = mysql_fetch_assoc($this->res)) {
            $arr[] = $row;
        }
        return $arr;
    }

    /**
     * 删除数据
     *
     * @param string $table         : 表名
     * @param string $fields        : 条件
     *
     * @return boolean
     *
     */
    public function delete($table, $fields)
    {
        $sql = "DELETE FROM $table WHERE $fields";
        if($this->query($sql)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * 取得结果数据
     *
     * @param resource $query
     *
     * @return string
     *
     */
    public function result($query, $row) 
    {
        $query = @mysql_result($query, $row);
        return $query;
    }
 
    /**
     * 获得刚插入数据的id
     *
     * @return int id
     *
     */
    public function getInsertID() 
    {
        return ($id = mysql_insert_id($this->dblink)) >= 0 ? $id : $this->result($this->query('SELECT last_insert_id()'), 0);
    }
 
    /**
     * 关闭数据库连接，当您使用持续连接时该功能失效
     *
     * @return blooean
     *
     */
    public function close() 
    {
        return mysql_close($this->dblink);
    }
 
    /**
     * 显示自定义错误
     */
    public function msg() 
    {
        if($this->errno) {
            //可以根据错误ID，配置好一些友好的错误信息提示语句
            $msgArr = array();
            $msgArr['1062'] = "唯一性索引有重复值插入";
            /*...更多错误代码根据实际业务再添加...*/
            if($msgArr[$this->errno]) {
                $errMsg = $msgArr[$this->errno];//已定义的错误
            }else{
                $errMsg = mysql_error();//未定义的错误，由默认的错误信息决定
            }
            echo "<div style='color:red;'>\n";
                echo "<h4>数据库操作错误</h4>\n";
                echo "<h5>错误代码：".$this->errno."</h5>\n";
                echo "<h5>错误信息：".$errMsg."</h5>\n";
            echo "</div>";
            unset($msgArr);
            die;
        }
    }
    
}

?>
