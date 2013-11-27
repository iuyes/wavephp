<?php $homeurl = Wave::app()->homeUrl;?>
<form class="pure-form pure-form-stacked form" action="<?=$homeurl?>/categories/modify" method="POST" onsubmit="return checkForm()">
    <fieldset>
        <legend>编辑分类目录</legend>

        <label for="name">名称</label>
        <input id="name" type="text" name="name" value="<?=$arr['name']?>" class="input">

        <label for="state">父级</label>
        <select name="parent" id="parent">
            <option value="0">无</option>
            <?php foreach ($list as $key => $value):?>
                <option value="<?=$value['term_id']?>" <?php if($arr['term_id'] == $value['term_id']):?> selected <?php endif;?>><?=$value['name']?></option>
                <?php if(!empty($value['sub'])):?>
                    <?php foreach ($value['sub'] as $k => $v):?>
                        <option value="<?=$v['term_id']?>" <?php if($arr['term_id'] == $v['term_id']):?> selected <?php endif;?>> &nbsp;&nbsp;<?=$v['name']?></option>
                    <?php endforeach;?>
                <?php endif;?>
            <?php endforeach;?>
        </select>

        <label>描述</label>
        <textarea name="description"><?=$arr['description']?></textarea>
        <input type="hidden" name="cid" value="<?=$arr['term_id']?>">
        <button type="submit" class="pure-button pure-button-primary">编辑分类目录</button>
    </fieldset>
</form>