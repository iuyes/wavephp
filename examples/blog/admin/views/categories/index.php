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
<div class="c-top">
    分类目录
</div>
<div class="list clearfix">
    <div class="left">
        <form class="pure-form pure-form-stacked form" action="<?=$homeurl?>/categories/modify" method="POST" onsubmit="return checkForm()">
            <fieldset>
                <legend>添加新分类目录</legend>

                <label for="name">名称</label>
                <input id="name" type="text" name="name" class="input">

                <label for="state">父级</label>
                <select name="parent" id="parent">
                    <option value="0">无</option>
                    <?php foreach ($list as $key => $value):?>
                        <option value="<?=$value['term_id']?>"><?=$value['name']?></option>
                        <?php if(!empty($value['sub'])):?>
                            <?php foreach ($value['sub'] as $k => $v):?>
                                <option value="<?=$v['term_id']?>"> &nbsp;&nbsp;<?=$v['name']?></option>
                            <?php endforeach;?>
                        <?php endif;?>
                    <?php endforeach;?>
                </select>

                <label>描述</label>
                <textarea name="description"></textarea>
                <input type="hidden" name="cid" value="0">
                <button type="submit" class="pure-button pure-button-primary">添加新分类目录</button>
            </fieldset>
        </form>
    </div>
    <div class="right">
        <table class="categories-table pure-table pure-table-horizontal">
            <thead>
                <tr>
                    <th>名称</th>
                    <th>描述</th>
                    <th>文章数</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $key => $value):?>
                    <tr>
                        <td><?=$value['name']?></td>
                        <td><?=$value['description']?></td>
                        <td><?=$value['count']?></td>
                        <td><a href="<?=$homeurl?>/categories/edit/<?=$value['term_id']?>">编辑</a> 
                            | 
                            <a href="<?=$homeurl?>/categories/delete/<?=$value['term_id']?>">删除</a></td>
                    </tr>
                    <?php if(!empty($value['sub'])):?>
                        <?php foreach ($value['sub'] as $k => $v):?>
                            <tr>
                                <td>—— <?=$v['name']?></td>
                                <td><?=$v['description']?></td>
                                <td><?=$v['count']?></td>
                                <td>
                                    <a href="<?=$homeurl?>/categories/edit/<?=$v['term_id']?>">编辑</a> 
                                    |
                                    <a href="<?=$homeurl?>/categories/delete/<?=$v['term_id']?>">删除</a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                <?php endforeach;?>
            </tbody>
        </table>
    </div>

</div>