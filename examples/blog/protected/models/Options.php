<?php
/**
 * 网站设置
 */
class Options
{
    /**
     * 表名
     * @return string       表名
     */
    public function tableName()
    {
        return 'options';
    }

    /**
     * 获得项目域名
     * @param class $Common     公共类模型
     * @return string           网站域名
     */
    public function getSiteurl($Common)
    {
        $sql = "SELECT option_name,option_value 
                    FROM `options` 
                    WHERE option_name='siteurl'";
        $arr = $Common->getSqlOne($sql);

        return $arr['option_value'];
    }

    /**
     * 获得上传图片的设置信息
     * @param class $Common     公共类模型
     * @return array            图片缩略图宽高设定
     */
    public function getImagesSet($Common)
    {
        $sql = "SELECT option_name,option_value 
                    FROM `options` 
                    WHERE option_name 
                    IN('thumbnail_size_w','thumbnail_size_h',
                        'medium_size_w','medium_size_h')";
        
        return $Common->getSqlOne($sql);
    }

}