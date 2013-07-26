<?php
/**
 * 分类和标签表
 */
class Terms
{
    /**
     * 表名
     * @return string       表名
     */
    public function tableName()
    {
        return 'terms';
    }

    /**
     * 获得分类
     */
    public function getTermsList($Common, $type)
    {
        $sql = 'SELECT terms.*,tax.description,tax.parent,tax.count 
                FROM `term_taxonomy` tax
                LEFT JOIN terms ON terms.term_id=tax.term_id
                WHERE tax.taxonomy="'.$type.'"';
        $arr = $Common->getSqlList($sql);
        $newarr = array();
        foreach ($arr as $key => $value) {
            $newarr[$value['term_id']] = $value;
        }
        foreach ($arr as $key => $value) {
            if($value['parent'] != 0){
                $newarr[$value['parent']]['sub'][] = $value;
                unset($newarr[$value['term_id']]);
            }
        }
        unset($arr);

        return $newarr;
    }

    /**
     * 获得单个分类
     */
    public function getOneTerms($Common, $id, $type)
    {
        $sql = 'SELECT terms.*,tax.description,tax.parent,tax.count 
                FROM `term_taxonomy` tax
                LEFT JOIN terms ON terms.term_id=tax.term_id
                WHERE tax.taxonomy="'.$type.'"
                AND terms.term_id='.$id;
        $arr = $Common->getSqlOne($sql);

        return $arr;
    }

    /**
     * 添加分类
     */
    public function addTerms($Common, $data, $type)
    {
        $termdata = $taxdata = array();
        $termdata['name'] = $data['name'];
        $Common->getInsert($this->tableName(), $termdata);
        $term_id = $Common->getLastId();
        $taxdata['term_id'] = $term_id;
        $taxdata['taxonomy'] = $type;
        $taxdata['description'] = $data['description'];
        $Common->getInsert('term_taxonomy', $taxdata);
        unset($data, $termdata, $taxdata);

        return true;
    }

    /**
     * 编辑分类
     */
    public function modifyTerms($Common, $data, $id, $type)
    {
        $termdata = $taxdata = array();
        $termdata['name'] = $data['name'];
        $Common->getUpdate($this->tableName(), $termdata, 'term_id', $id);
        $taxdata['term_id'] = $id;
        $taxdata['taxonomy'] = $type;
        $taxdata['description'] = $data['description'];
        $Common->getUpdate('term_taxonomy', $taxdata, 'term_id', $id);
        unset($data, $termdata, $taxdata);

        return true;
    }

    /**
     * 删除分类
     */
    public function getDelete($Common, $id)
    {
        $count = $Common->getFieldCount('term_taxonomy', 'parent', $id);
        if($count > 0) return 1;

        $term_taxonomy = $Common->getOneData('term_taxonomy', 'term_taxonomy_id,count', 'term_id', $id);
        if((int)$term_taxonomy['count'] > 0) return 2;

        $Common->getDelete($this->tableName(), 'term_id', $id);
        $Common->getDelete('term_taxonomy', 'term_id', $id);

        return true;
    }
}
?>