<?php $homeurl = Wave::app()->homeUrl;?>
<?php if(!empty($username)):?>
    <header id="page-heading">
        <h1>Posts by: xpmozong</h1>
    </header>
<?php endif;?>
<div class="blog-main">
    <div id="blog-wrap" class="blog-isotope clearfix isotope" style="position: relative; overflow: hidden; height: 1009px;">
    <?php foreach ($list as $key => $value):?>    
        <article class="post-576 post type-post status-publish format-standard hentry category-1 blog-entry clearfix isotope-item" style="position: absolute; left: 0px; top: 0px;">
            <div class="entry-text clearfix">
                <header>
                    <h2>
                        <a title="test" href="<?=$homeurl.'/site/article'?>/?p=<?=$value['id']?>"><?=$value['title']?></a>
                    </h2>
                </header>
                <?=$value['content']?>
                <ul class="entry-meta">
                    <li>
                        <strong>Posted on:</strong>
                        <?=$value['modify_date']?>
                    </li>
                    <li>
                        <strong>By:</strong>
                        <a rel="author" title="由 <?=$value['user_login']?> 发布" href="<?=$homeurl.'/site/index'?>/?author=<?=$value['user_id']?>">
                            <?=$value['user_login']?>
                        </a>
                    </li>
                    <li class="comment-scroll">
                        <strong>With:</strong>
                        <a class="comments-link" title="《test》上的评论" href="<?=$homeurl.'/site/article'?>/?p=<?=$value['id']?>#respond">
                            <?=$value['comment_count']?> Comments
                        </a>
                    </li>
                </ul>
            </div>
        </article>
    <?php endforeach;?>
    </div>
</div>

<?=$pagebar?>