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

}

?>