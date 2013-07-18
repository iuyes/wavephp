<?php $homeurl = Wave::app()->homeUrl;?>
<div class="c-top">
    文章 <span class="write"><a href="<?=$homeurl?>/articles/modifypage/0">写文章</a></span>
</div>
<div class="search">
    <select name="category" id="category">
        <option value="0">查看所有分类目录</option>
        <?php foreach ($catlist as $key => $value):?>
            <option value="<?=$value['term_id']?>"><?=$value['name']?></option>
            <?php if(!empty($value['sub'])):?>
                <?php foreach ($value['sub'] as $k => $v):?>
                    <option value="<?=$v['term_id']?>"> &nbsp;&nbsp;<?=$v['name']?></option>
                <?php endforeach;?>
            <?php endif;?>
        <?php endforeach;?>
    </select>
    <button type="submit" class="pure-button pure-button-small">过滤</button>
</div>
<div class="list">
    <table class="article-table pure-table pure-table-horizontal">
        <thead>
            <tr>
                <th>标题</th>
                <th>作者</th>
                <th>分类目录</th>
                <th>标签</th>
                <th>评论</th>
                <th>日期</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $key => $value):?>
                <tr>
                    <td><?=$value['title']?></td>
                    <td><?=$value['user_login']?></td>
                    <td><?=$value['category']?></td>
                    <td><?=$value['user_login']?></td>
                    <td><?=$value['comment_count']?></td>
                    <td><?=$value['modify_date']?></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>