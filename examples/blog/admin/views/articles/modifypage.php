<?php $homeurl = Wave::app()->homeUrl;?>
<script src="<?=Wave::app()->request->baseUrl?>/resouce/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=Wave::app()->request->baseUrl?>/resouce/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
$(function(){
    CKEDITOR.replace( 'content', {
        language: 'zh-cn',
        height: 300,
        filebrowserUploadUrl : "&type=files",
        filebrowserImageUploadUrl : "&type=images",
        filebrowserFlashUploadUrl : "&type=flash"
    });
})

var checkForm = function(){
    var title = $("#title").val();
    if(!title){
        alert("请输入标题！");
        return false;
    }

    return true;
}

</script>
<form class="pure-form pure-form-stacked form" action="<?=$homeurl?>/articles/modify" method="POST" onsubmit="return checkForm()">
    <label for="title">文章标题</label>
    <input id="title" type="text" name="title" class="input" value="<?=$arr['title']?>">

    <label for="state">分类</label>
    <div class="category">
        <ul id="categorychecklist" class="categorychecklist form-no-clear" data-wp-lists="list:category">
            <?php foreach ($catlist as $key => $value):?>
                <li id="category-<?=$value['term_id']?>" class="popular-category">
                    <label class="selectit">
                        <input id="in-category-<?=$value['term_id']?>" type="checkbox" name="category[]" value="<?=$value['term_id']?>" <?php if(isset($arr['category'])){if(in_array($value['term_id'], $arr['category'])){ echo "checked";}}?>> <?=$value['name']?>
                    </label>
                </li>
                <?php if(!empty($value['sub'])):?>
                    <ul class="sub-<?=$value['term_id']?>">
                        <?php foreach ($value['sub'] as $k => $v):?>
                            <li id="category-<?=$v['term_id']?>" class="popular-category">
                                <label class="selectit">
                                    <input id="in-category-<?=$v['term_id']?>" type="checkbox" name="category[]" value="<?=$v['term_id']?>" <?php if(isset($arr['category'])){if(in_array($v['term_id'], $arr['category'])){ echo "checked";}}?>> <?=$v['name']?>
                                </label>
                            </li>
                        <?php endforeach;?>
                    </ul>
                <?php endif;?>
            <?php endforeach;?>
        <ul>
    </div>

    <label>内容</label>
    <textarea name="content" id="content"><?=$arr['content']?></textarea>

    <label for="tags">标签（以英文逗号隔开）</label>
    <input id="tags" type="text" name="tags" class="input" value="<?=$arr['tags']?>">

    <input type="hidden" name="aid" value="<?=$arr['id']?>">
    <input type="hidden" name="page" value="<?=$page?>">
    <input type="hidden" name="cate" value="<?=$category?>">
    <button type="submit" class="pure-button pure-button-primary">发布</button>
</form>