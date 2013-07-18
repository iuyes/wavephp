<?php
/**
 * 文章表
 */
class Articles
{
    /**
     * 表名
     * @return string       表名
     */
    public function tableName()
    {
        return 'articles';
    }

    public function getArticleList($Common, $data)
    {
        $start = $data['start'];
        $limit = $data['limit'];
        $sql = "SELECT 
                articles.id,
                articles.title,
                articles.modify_date,
                articles.guid,
                articles.comment_count,
                users.user_login 
                FROM articles
                LEFT JOIN users ON articles.add_author=users.id
                ORDER BY articles.id DESC
                LIMIT $start,$limit";

        $arr = $Common->getSqlList($sql);
        foreach ($arr as $key => $value) {
            $relationships = $Common->getAllData('term_relationships', 
                            'term_taxonomy_id', 
                            'article_id', $value['id']);
            $relationships_id_arr = array();
            foreach ($relationships as $v) {
                $relationships_id_arr[] = $v['term_taxonomy_id'];
            }
            $relationships_id = implode(',', $relationships_id_arr);
            if(!empty($relationships_id)){
                $sql = "SELECT term_id FROM `term_taxonomy` 
                        WHERE term_taxonomy_id IN($relationships_id) AND taxonomy='category'";
                $taxonomy = $Common->getSqlList($sql);
                $term_id_arr = array();
                foreach ($taxonomy as $v) {
                    $term_id_arr[] = $v['term_id'];
                }
                $term_id = implode(',', $term_id_arr);
                unset($relationships_id_arr, $term_id_arr);
                $category = $Common->getAllData('terms', 
                            '`name`', 'term_id', 
                            $term_id, true);
                $category_name = array();
                foreach ($category as $v) {
                    $category_name[] = $v['name'];
                }
            }else{
                $category_name = array();
            }
            $arr[$key]['category'] = implode(',', $category_name);
        }

        return $arr;
    }

    public function getTermRelationships($Common, $article_id)
    {
        return ;
    }


}