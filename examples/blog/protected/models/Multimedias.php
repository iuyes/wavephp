<?php
/**
 * 多媒体
 */
class Multimedias
{
    /**
     * 表名
     * @return string       表名
     */
    public function tableName()
    {
        return 'multimedias';
    }

    /**
     * 获得多媒体总数量
     * @param class $Common     公共类模型
     * @return int              数量
     */
    public function getMultimediaCount($Common)
    {
        return $Common->getCount($this->tableName());
    }

    /**
     * 获得多媒体列表
     * @param class $Common     公共类模型
     * @param array $data       条件数组
     * @return array            多媒体数组
     */
    public function getMultimediasList($Common, $data)
    {
        $start = $data['start'];
        $limit = $data['limit'];
        $sql = "SELECT * FROM multimedias 
                ORDER BY id DESC 
                LIMIT $start,$limit";

        return $Common->getSqlList($sql);
    }

    /**
     * 删除多媒体
     * @param class $Common         公共类模型
     * @param int $id               多媒体id
     * @param string $uploadPath    上传路径
     * @return boolean              true or false
     */
    public function deleteMultimedias($Common, $id, $uploadPath)
    {
        $arr = $Common->getOneData($this->tableName(), '*', 'id', $id);
        $save_name = $arr['save_name'];
        $uploadPath = $uploadPath.$arr['file_type'];
        if($arr['file_type'] == 'images'){
            $bigPath = $uploadPath.'/big/'.$save_name;
            $smallPath = $uploadPath.'/small/'.$save_name;
            $mediumPath = $uploadPath.'/medium/'.$save_name;
            unlink($bigPath);
            unlink($smallPath);
            unlink($mediumPath);
        }else{
            $path = $uploadPath.'/'.$save_name;
            unlink($path);
        }

        return $Common->getDelete($this->tableName(), 'id', $id);
    }

    /**
     * 上传图片
     * @param class $Common         公共类模型
     * @param string $type          媒体类型
     * @param string $uploadPath    上传路径
     * @param string $baseurl       图片访问路径
     * @param array $imageSet       图片缩略图宽高设定
     * @param array $files          上传图片信息
     * @param string $fn            ckeditor上传方法类型
     * @return string
     */
    public function uploadImg($Common,$type,$uploadPath,$baseurl,$imageSet,$files,$fn)
    {
        $bigPath = $uploadPath.'/big';
        $smallPath = $uploadPath.'/small';
        $mediumPath = $uploadPath.'/medium';
        if(!is_dir($bigPath)) mkdir($bigPath, 0777);
        if(!is_dir($smallPath)) mkdir($smallPath, 0777);
        if(!is_dir($mediumPath)) mkdir($mediumPath, 0777);
        $imgType = substr(strrchr($files['upload']['name'],'.'),1);
        $imageName = time().'.'.$imgType;
        $data = array();
        $data['file_type'] = $type;
        $data['file_name'] = $files['upload']['name'];
        $data['save_name'] = $imageName;
        $data['adddate'] = $Common->getDate();
        $Common->getInsert($this->tableName(), $data);
        $abso = $imgType == 'gif' ? 'big' : 'medium';
        $file_abso = $baseurl.'/uploadfile/'.$type.'/'.$abso.'/'.$imageName;
        $thumb = PhpThumbFactory::create($files['upload']['tmp_name']);
        $small_w = isset($imageSet['thumbnail_size_w']) ? (int)$imageSet['thumbnail_size_w'] : 150;
        $small_h = isset($imageSet['thumbnail_size_h']) ? (int)$imageSet['thumbnail_size_h'] : 150;
        $medium_w = isset($imageSet['medium_size_w']) ? (int)$imageSet['medium_size_w'] : 500;
        $medium_h = isset($imageSet['medium_size_h']) ? (int)$imageSet['medium_size_h'] : 300;
        $thumb->resize($small_w, $small_h);
        $thumb->save($smallPath.'/'.$imageName, $imgType);
        $thumb = PhpThumbFactory::create($files['upload']['tmp_name']);
        $thumb->resize($medium_w, $medium_h);
        $thumb->save($mediumPath.'/'.$imageName, $imgType);
        
        move_uploaded_file($files['upload']['tmp_name'],$bigPath.'/'.$imageName);
        
        return '<script type="text/javascript">
        window.parent.CKEDITOR.tools.callFunction("'.$fn.'","'.$file_abso.'","上传成功");
        </script>';
    }

}