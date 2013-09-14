<?php $homeUrl = Wave::app()->homeUrl;?>
<div id="footer-widgets" class="clearfix">
    <div class="footer-box">
        <div class="footer-widget widget_search clearfix">
            <h4>
                <span>搜索</span>
            </h4>
            <form id="searchbar" action="<?=$homeUrl?>/search" method="get">
                <input type="search" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" value="按回车搜索" name="s">
            </form>
        </div>

        <div class="footer-widget widget_categories clearfix">
            <h4>
                <span>分类</span>
            </h4>
            <ul>
                <?php foreach ($catelist as $key => $value):?>
                <li class="cat-item cat-item-14">
                    <a title="查看 <?=$value['name']?> 下的所有文章" href="<?=$homeurl?>?category=<?=$value['term_id']?>">
                        <?=$value['name']?>
                    </a> (<?=$value['count']?>)
                </li>
                <?php if(!empty($value['sub'])):?>
                    <?php foreach ($value['sub'] as $k => $v):?>
                        <li class="cat-item cat-item-14">
                            —— <a title="查看 <?=$v['name']?> 下的所有文章" href="<?=$homeurl?>?category=<?=$v['term_id']?>">
                                <?=$v['name']?>
                            </a> (<?=$v['count']?>)
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
                <?php endforeach;?>
            </ul>
        </div>

        <div class="footer-widget widget_tag_cloud clearfix">
            <h4>
                <span>标签</span>
            </h4>
            <div class="tagcloud">
                <?php foreach ($taglist as $key => $value):?>
                <a class="tag-link-<?=$value['term_id']?>" style="font-size: 11.888888888889pt;" title="<?=$value['count']?> 个话题" href="<?=$homeUrl?>?tag=<?=$value['name']?>">
                    <?=$value['name']?>
                </a>
                <?php endforeach;?>
            </div>
        </div>
        
    </div>
    <div class="footer-box"> </div>
    <div class="footer-box remove-margin"> </div>
</div>