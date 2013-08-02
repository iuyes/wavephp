<?php $homeurl = Wave::app()->homeUrl;?>
<aside id="sidebar">
    <div class="sidebar-box widget_search clearfix">
        <h4>
            <span>搜索</span>
        </h4>
        <form id="searchbar" action="http://localhost/wordpress/" method="get">
            <input type="search" onblur="if(this.value=='')this.value=this.defaultValue;" onfocus="if(this.value==this.defaultValue)this.value='';" value="Type and hit enter to search" name="s">
        </form>
    </div>

    <div class="sidebar-box widget_recent_entries clearfix">
        <h4>
            <span>近期文章</span>
        </h4>
        <ul>
            <li>
                <a title="test" href="http://localhost/wordpress/?p=576">test</a>
            </li>
            <li>
                <a title="世界，你好！" href="http://localhost/wordpress/?p=1">世界，你好！</a>
            </li>
            <li>
                <a title="Centos rpm 安装 mysql" href="http://localhost/wordpress/?p=573">Centos rpm 安装 mysql</a>
            </li>
            <li>
                <a title="php求助问题，计算两个字符串的相似度，中文，5000次以上" href="http://localhost/wordpress/?p=567">php求助问题，计算两个字符串的相似度，中文，5000次以上</a>
            </li>
            <li>
                <a title="linux常用svn命令" href="http://localhost/wordpress/?p=562">linux常用svn命令</a>
            </li>
        </ul>
    </div>

    <div class="sidebar-box widget_categories clearfix">
        <h4>
            <span>分类</span>
        </h4>
        <ul>
            <?php foreach ($catelist as $key => $value):?>
                <li class="cat-item cat-item-14">
                    <a title="查看 <?=$value['name']?> 下的所有文章" href="<?=$homeurl?>/?cat=<?=$value['term_id']?>">
                        <?=$value['name']?>
                    </a> (<?=$value['count']?>)
                </li>
                <?php if(!empty($value['sub'])):?>
                    <?php foreach ($value['sub'] as $k => $v):?>
                        <li class="cat-item cat-item-14">
                            —— <a title="查看 <?=$v['name']?> 下的所有文章" href="<?=$homeurl?>/?cat=<?=$v['term_id']?>">
                                <?=$v['name']?>
                            </a> (<?=$v['count']?>)
                        </li>
                    <?php endforeach;?>
                <?php endif;?>
            <?php endforeach;?>
        </ul>
    </div>

    <div class="sidebar-box widget_tag_cloud clearfix">
        <h4>
            <span>标签</span>
        </h4>
        <div class="tagcloud">
            <?php foreach ($taglist as $key => $value):?>
                <a class="tag-link-<?=$value['term_id']?>" style="font-size: 11.888888888889pt;" title="<?=$value['count']?> 个话题" href="<?=$homeurl?>/?tag=<?=$value['name']?>">
                    <?=$value['name']?>
                </a>
            <?php endforeach;?>    
        </div>
    </div>

</aside>