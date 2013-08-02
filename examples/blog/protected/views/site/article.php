<?php $homeurl = Wave::app()->homeUrl;?>
<div id="single-post-content" class="sidebar-bg container clearfix">
    <div id="post" class="clearfix">
        <header id="post-header">
            <h1><?=$arr['title']?></h1>
            <ul class="meta clearfix">
                <li>
                    <strong>Posted on:</strong>
                    <?=$arr['modify_date']?>
                </li>
                <li>
                    <strong>By:</strong>
                    <a rel="author" title="由 <?=$add_username?> 发布" href="<?=$homeurl?>?author=<?=$arr['add_author']?>"><?=$add_username?></a>
                </li>
                <li class="comment-scroll">
                    <strong>With:</strong>
                    <a class="comments-link" title="<?=$arr['title']?>上的评论" href="<?=$homeurl?>/site/article/?p=<?=$arr['id']?>#respond">
                        <?=$arr['comment_count']?> Comments
                    </a>
                </li>
            </ul>
        </header>
        
        <article class="post-20 post type-post status-publish format-standard hentry category-linux tag-ubuntu entry clearfix fitvids">
            <div class="inner-post">
                <?=$arr['content']?>
            </div>
        </article>
        
        <div id="category" class="terms clearfix">
            <ul>
                <li>分类：</li>
                <?php foreach ($arr['cate'] as $key => $value):?>
                    <li><a href="<?=$homeurl?>?cat=<?=$value['id']?>"><?=$value['name']?></a></li>
                <?php endforeach;?>
            </ul>
        </div>
        <div id="post_tags" class="terms clearfix">
            <ul>
                <li>标签：</li>
                <?php foreach ($arr['tag_names'] as $key => $value):?>
                    <li><a rel="tag" href="<?=$homeurl?>?tag=<?=$value?>"><?=$value?></a></li>
                <?php endforeach;?>  
            </ul>
        </div>

        <?php echo file_get_contents('http://'.Wave::app()->request->hostInfo.$homeurl.'/site/comment/?p=<?=$arr["id"]?>');?>
    </div>

    <?php echo file_get_contents('http://'.Wave::app()->request->hostInfo.$homeurl.'/site/sidebar');?>
</div>