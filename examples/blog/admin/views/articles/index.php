<div class="c-top">
    文章 <span class="write"><a href="">写文章</a></span>
</div>
<div class="search">
    <select name="category" id="category">
        <option value="0">查看所有分类目录</option>
        <option class="level-0" value="14">IOS</option>
        <option class="level-0" value="10">JS+HTML+DIV+CSS</option>
        <option class="level-0" value="4">Linux</option>
        <option class="level-0" value="3">PHP</option>
        <option class="level-0" value="16">Python</option>
        <option class="level-0" value="15">其他</option>
        <option class="level-0" value="9">数据</option>
        <option class="level-0" value="1">生活</option>
    </select>
    <button type="submit" class="pure-button pure-button-small">过滤</button>
</div>
<div class="article-list">
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