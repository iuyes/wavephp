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

    /**
     * 获得单个文章
     * @param class $Common     公共类模型
     * @param int $id           文章id
     * @return array            单个文章数组
     */
    public function getArticle($Common, $id)
    {
        $arr = $Common->getOneData('articles', '*', 'id', $id);
        if(!empty($arr)){
            $relationships = $Common->getAllData('term_relationships', 
                            'term_taxonomy_id', 
                            'article_id', $arr['id']);
            $relationships_id_arr = array();
            foreach ($relationships as $v) {
                $relationships_id_arr[] = $v['term_taxonomy_id'];
            }
            $relationships_id = implode(',', $relationships_id_arr);
            $cate = $category = $tags_name = array();
            if(!empty($relationships_id)){
                $sql = "SELECT tax.term_id,tax.taxonomy,terms.`name` 
                        FROM term_taxonomy tax 
                        LEFT JOIN terms 
                        ON tax.term_id=terms.term_id
                        WHERE tax.term_taxonomy_id IN($relationships_id)";
                $taxonomy = $Common->getSqlList($sql);
                foreach ($taxonomy as $k => $v) {
                    if($v['taxonomy'] == 'category'){
                        $category[] = $v['term_id'];
                        $cate[$k]['id'] = $v['term_id'];
                        $cate[$k]['name'] = $v['name'];
                    } else 
                        $tags_name[] = $v['name'];
                }
            }
            $arr['category'] = $category;
            $arr['cate'] = $cate;
            $arr['tags'] = implode(',', $tags_name);
            $arr['tag_names'] = $tags_name;
        }

        return $arr;
    }

    /**
     * 获得文章总数量
     * @param class $Common     公共类模型
     * @param int $user_id      用户id
     * @return int              数量
     */
    public function getArticleCount($Common, $user_id = 0)
    {
        if(!empty($user_id)){
            $sql = "SELECT count(*) count FROM articles
                    LEFT JOIN users ON articles.add_author=users.id
                    WHERE users.id='$user_id'";
            $arr = $Common->getSqlOne($sql);

            return $arr['count'];
        }else
            return $Common->getCount($this->tableName());
    }

    /**
     * 获得文章列表
     * @param class $Common     公共类模型
     * @param array $data       条件数组
     * @param string $content   是否查询内同
     * @param int $user_id      用户id
     * @return array            文章数组
     */
    public function getArticleList($Common, $data, $content = null, $user_id = 0)
    {

        $start = $data['start'];
        $limit = $data['limit'];
        $field = $where = '';
        if(!empty($content)) $field = 'articles.content,';
        if(!empty($user_id)) $where = "WHERE users.id='$user_id'";
        $sql = "SELECT 
                articles.id,
                articles.title,
                $field
                articles.modify_date,
                articles.guid,
                articles.comment_count,
                users.user_login,
                users.id user_id 
                FROM articles
                LEFT JOIN users ON articles.add_author=users.id
                $where
                ";
        if(!empty($data['category'])){
            $term_taxonomy = $Common->getOneData('term_taxonomy', 
                            'term_taxonomy_id', 
                            'term_id', 
                            $data['category']);
            if(!empty($term_taxonomy['term_taxonomy_id'])){
                $term_taxonomy_id = $term_taxonomy['term_taxonomy_id'];
                $sql .= " LEFT JOIN term_relationships rela
                        ON articles.id=rela.article_id
                        WHERE rela.term_taxonomy_id='$term_taxonomy_id'";
            }
        }
        $sql .= " ORDER BY articles.id DESC
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
            $category_name = $tags_name = array();
            if(!empty($relationships_id)){
                $sql = "SELECT tax.term_id,tax.taxonomy,terms.`name` 
                        FROM term_taxonomy tax 
                        LEFT JOIN terms 
                        ON tax.term_id=terms.term_id
                        WHERE tax.term_taxonomy_id IN($relationships_id)";
                $taxonomy = $Common->getSqlList($sql);
                foreach ($taxonomy as $k => $v) {
                    if($v['taxonomy'] == 'category') 
                        $category_name[] = $v['name'];
                    else 
                        $tags_name[] = $v['name'];
                }
            }
            $arr[$key]['category'] = implode(',', $category_name);
            $arr[$key]['tags'] = implode(',', $tags_name);
        }

        return $arr;
    }

    /**
     * 添加文章
     * @param class $Common     公共类模型
     * @param array $data       添加数组
     * @return boolearn         true or false
     */
    public function addArticles($Common, $data)
    {
        $count = $Common->getFieldCount($this->tableName(), 'title', $data['title']);
        if($count > 0) return false;
        $data['add_date'] = $Common->getDate();
        $data['modify_date'] = $Common->getDate();
        $category = isset($data['category']) ? 
        $data['category'] : $data['category'] = '';
        $tags = $data['tags'];
        unset($data['category'], $data['tags']);
        $Common->getInsert($this->tableName(), $data);
        $aid = $Common->getLastId();
        $this->articleAddCategory($Common, $category, $aid);
        $this->articleAddTag($Common, $tags, $aid);

        return true;
    }

    /**
     * 编辑文章
     * @param class $Common     公共类模型
     * @param array $data       编辑数组
     * @param int $id           文章id
     * @return boolearn         true or false
     */
    public function modifyArticles($Common, $data, $id)
    {
        $arr = $Common->getOneData('articles', 'title', 'id', $id);
        if($arr['title'] != $data['title']){
            $count = $Common->getFieldCount($this->tableName(), 'title', $data['title']);
            if($count > 0) return false; 
        }
        $this->updateArticleNum($Common, $id);

        $data['modify_date'] = $Common->getDate();
        $category = $data['category'];
        $tags = $data['tags'];
        $this->articleAddCategory($Common, $category, $id);
        $this->articleAddTag($Common, $tags, $id);

        unset($data['category'], $data['tags']);
        $Common->getUpdate('articles', $data, 'id', $id);

        return true;
    }

    /**
     * 删除文章
     * @param class $Common     公共类模型
     * @param int $id           文章id
     * @return boolearn         true or false
     */
    public function deleteArticles($Common, $id)
    {
        $Common->getDelete($this->tableName(), 'id', $id);
        $this->updateArticleNum($Common, $id);

        return true;
    }

    /**
     * 删除文章时，更新分类、标签文章数量
     * @param class $Common     公共类模型
     * @param int $id           文章id
     */
    public function updateArticleNum($Common, $id)
    {
        $relationships = $Common->getAllData('term_relationships', 
                        'term_taxonomy_id', 
                        'article_id', $id);
        $relationships_id_arr = array();
        foreach ($relationships as $v) {
            $relationships_id_arr[] = $v['term_taxonomy_id'];
        }
        $relationships_id = implode(',', $relationships_id_arr);
        if(!empty($relationships_id)){
            $taxonomys = $Common->getAllData('term_taxonomy', 
                         'term_taxonomy_id,count', 
                         'term_taxonomy_id', 
                         $relationships_id, true);
            foreach ($taxonomys as $k => $v) {
                $tarr = array();
                $tarr['count'] = ((int)$v['count']) - 1;
                $Common->getUpdate('term_taxonomy', $tarr, 
                        'term_taxonomy_id', $v['term_taxonomy_id']);
                unset($tarr);
            }
        }
        $Common->getDelete('term_relationships', 'article_id', $id);
    }

    /**
     * 给文章选择分类
     * @param class $Common     公共类模型
     * @param array $category   分类数组
     * @param int $aid          文章id
     */
    public function articleAddCategory($Common, $category, $aid)
    {
        if(!empty($category)){
            foreach ($category as $v) {
                $taxonomy_arr = $Common->getOneData('term_taxonomy', 
                                'term_taxonomy_id,count', 
                                'term_id', $v);
                $tarr = array();
                $tarr['count'] = ((int)$taxonomy_arr['count']) + 1;
                $Common->getUpdate('term_taxonomy', $tarr, 'term_id', $v);
                $relationships = array('article_id'  => $aid,
                                'term_taxonomy_id'   => $taxonomy_arr['term_taxonomy_id']);
                $Common->getInsert('term_relationships', $relationships);
                unset($relationships, $tarr);
            }
        }
    }

    /**
     * 给文章选择标签
     * @param class $Common     公共类模型
     * @param array $category   标签数组
     * @param int $aid          文章id
     */
    public function articleAddTag($Common, $tags, $aid)
    {
        if(!empty($tags)){
            $tags = explode(',', $tags);
            foreach ($tags as $v) {
                $tsql = "SELECT tax.term_taxonomy_id FROM terms 
                        LEFT JOIN term_taxonomy tax
                        ON terms.term_id=tax.term_id
                        WHERE terms.`name`='$v' 
                        AND tax.taxonomy='post_tag'";
                $terms = $Common->getSqlOne($tsql);
                $tarr = array();
                if(!empty($terms['term_taxonomy_id'])){
                    $term_taxonomy_id = $terms['term_taxonomy_id'];

                    $taxonomy_arr = $Common->getOneData('term_taxonomy', 
                                    'count', 'term_taxonomy_id', 
                                    $term_taxonomy_id);
                    $tarr['count'] = ((int)$taxonomy_arr['count']) + 1;

                    $relationships = array('article_id'         => $aid,
                                           'term_taxonomy_id'   => $term_taxonomy_id);
                }else{
                    $insert_terms = array('name' => $v);
                    $Common->getInsert('terms', $insert_terms);
                    $taxonomy = array();
                    $taxonomy['term_id'] = $Common->getLastId();
                    $taxonomy['taxonomy'] = 'post_tag';
                    $taxonomy['count'] = 1;
                    $Common->getInsert('term_taxonomy', $taxonomy);
                    $term_taxonomy_id = $Common->getLastId();
                    $tarr['count'] = 1;
                    $relationships = array('article_id'         => $aid,
                                           'term_taxonomy_id'   => $term_taxonomy_id);
                }
                $Common->getInsert('term_relationships', $relationships);
                $Common->getUpdate('term_taxonomy', $tarr, 
                        'term_taxonomy_id', $term_taxonomy_id);
                unset($relationships);
            }
        }
    }

}