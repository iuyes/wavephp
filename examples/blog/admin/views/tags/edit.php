<?php $homeurl = Wave::app()->homeUrl;?>
<script type="text/javascript">
var checkForm = function(){
    var name = $("#name").val();
    if(!name){
        alert("请输入分类名称！");
        return false;
    }

    return true;
}
</script>
<form class="pure-form pure-form-stacked form" action="<?=$homeurl?>/tags/modify" method="POST" onsubmit="return checkForm()">
    <fieldset>
        <legend>编辑标签</legend>

        <label for="name">名称</label>
        <input id="name" type="text" name="name" value="<?=$arr['name']?>" class="input">

        <label>描述</label>
        <textarea name="description"><?=$arr['description']?></textarea>
        <input type="hidden" name="cid" value="<?=$arr['term_id']?>">
        <button type="submit" class="pure-button pure-button-primary">编辑标签</button>
    </fieldset>
</form>