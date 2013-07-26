<?php
/**
 * 公共类
 */
class Common
{
    public function db()
    {
        return Wave::app()->database->db;
    }

    /**
     * 获得日期
     * @return string 日期
     */
    public function getDate()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * 过滤
     * @param array $data   需过滤的数组
     * @return array        过滤数组
     */
    public function getFilter($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = addslashes($value);
        }

        return $data;
    }

    /**
     * 输出结果
     * @param bool $status      状态
     * @param string $msg       信息
     */
    public function exportResult($status, $msg)
    {
        $json_array = array();
        $json_array['success'] = $status;
        $json_array['msg'] = $msg;
        echo json_encode($json_array);
        unset($json_array);die;
    }

    /**
     * 执行sql获得数据
     * @param string $sql   sql语句
     * @return array        结果数组
     */
    public function getSqlList($sql)
    {
        return $this->db()->getAll($sql);
    }

    /**
     * 执行sql获得单个数据
     * @param string $sql   sql语句
     * @return array        结果数组
     */
    public function getSqlOne($sql)
    {
        return $this->db()->getOne($sql);
    }

    /**
     * 获得单个数据
     * @param string $table     表名
     * @param string $allField  查询字段
     * @param string $field     条件字段
     * @param string $id        条件
     * @return array            数组
     */
    public function getOneData($table, $allField, $field, $id)
    {
        $sql = "SELECT $allField FROM $table WHERE $field='$id'";

        return $this->db()->getOne($sql);
    }

    /**
     * 有条件的获得所有数据
     * @param string $table     表名
     * @param string $allfield  字段名
     * @param string $field     条件字段名
     * @param string $id        条件
     * @return array            结果数组
     */
    public function getAllData($table, $allField, $field, $id, $in = null)
    {
        $sql = "SELECT $allField FROM $table WHERE ";
        if(empty($in)){
            $sql .= "$field='$id'";
        }else{
            $sql .= "$field IN ($id)";
        }
        
        return $this->db()->getAll($sql);
    }

    /**
     * 根据字段统计数量
     * @param string $table 表名
     * @param string $field 条件字段名
     * @param string $id    条件
     */
    public function getFieldCount($table, $field, $id)
    {
        $sql = "SELECT count(*) count FROM $table WHERE $field='$id'";
        $count = $this->getSqlOne($sql);
        
        return $count['count'];
    }

    /**
     * 插入数据
     * @param string $table 表名
     * @param array $data   数据数组
     */
    public function getInsert($table, $data)
    {
        return $this->db()->insertdb($table,$data);
    }

    /**
     * 获得刚插入的id
     * @return int 刚插入的id
     */
    public function getLastId()
    {
        return $this->db()->getInsertID();
    }

    /**
     * 更新数据
     * @param string $table 表名
     * @param array $data   更新数据数组
     * @param string $field 条件字段名
     * @param string $id    条件
     * @param string $in    是否用IN
     * @return boolean
     *
     */
    public function getUpdate($table, $data, $field, $id, $in = null)
    {
        return $this->db()->updatedb($table, $data, $field, $id, $in);
    }

    /**
     * 删除数据
     * @param string $table 表名
     * @param string $field 条件字段名
     * @param string $id    条件
     * @param string $in    是否用IN
     * @return boolean
     */
    public function getDelete($table, $field, $id, $in = null)
    {
        if($in == null) {
            return $this->db()->delete($table, "$field='$id'");
        }else{
            return $this->db()->delete($table, "$field in ($id)");
        }
    }

}

?>