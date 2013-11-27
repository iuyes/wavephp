<?php $homeurl = Wave::app()->homeUrl;?>
<div class="c-top">
    多媒体
</div>
<div class="list">
    <table class="article-table pure-table pure-table-horizontal">
        <thead>
            <tr>
                <th>媒体类型</th>
                <th>名称</th>
                <th>内容</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $key => $value):?>
                <tr>
                    <td><?=$value['file_type']?></td>
                    <td><?=$value['file_name']?></td>
                    <td><?php if($value['file_type'] == 'images'){ echo "<img src='".$value['file_abso']."'>";}?></td>
                    <td><?=$value['adddate']?></td>
                    <td>
                        <a href="<?=$homeurl?>/multimedias/delete/<?=$value['id']?>?page=<?=$page?>">删除</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<div class="pagebar">
    <?=$pagebar?>
</div>