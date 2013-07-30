<?php $homeurl = Wave::app()->homeUrl;?>
<script src="<?=Wave::app()->request->baseUrl?>/resouce/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?=Wave::app()->request->baseUrl?>/resouce/ckfinder/ckfinder.js"></script>
<script type="text/javascript">
$(function(){
    CKEDITOR.replace( 'content', {
        language: 'zh-cn',
        filebrowserUploadUrl : "&type=files",
        filebrowserImageUploadUrl : "&type=images",
        filebrowserFlashUploadUrl : "&type=flash"
    });
})

var checkForm = function(){
    var title = $("#title").val();
    if(!title){
        alert("请输入标题！");
        return false;
    }

    return true;
}
</script>
<div class="intermediate clearfix">
    <div class="overview left">
        <div class="h">概况</div>
        <div class="inside">
            <div class="table table_content left">
                <div class="sub">内容</div>
                <table class="pure-table">
                    <tbody>
                        <tr class="first">
                            <td class="first b b-posts" width="50px">
                                <a href="<?=$homeurl.'/articles'?>"><?=$infoarr['article_count']?></a>
                            </td>
                            <td class="t posts">
                                <a href="<?=$homeurl.'/articles'?>">文章</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="first b b_pages">
                                <a href="edit.php?post_type=page">3</a>
                            </td>
                            <td class="t pages">
                                <a href="edit.php?post_type=page">页面</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="first b b-cats">
                                <a href="<?=$homeurl.'/categories'?>"><?=$infoarr['cate_count']?></a>
                            </td>
                            <td class="t cats">
                                <a href="<?=$homeurl.'/categories'?>">分类目录</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="first b b-tags">
                                <a href="<?=$homeurl.'/tags'?>"><?=$infoarr['tag_count']?></a>
                            </td>
                                <td class="t tags">
                            <a href="<?=$homeurl.'/tags'?>">标签</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table table_discussion right">
                <div class="sub">讨论</div>
                <table class="pure-table">
                    <tbody>
                        <tr class="first">
                            <td class="b b-comments" width="50px">
                                <a href="edit-comments.php">
                                <span class="total-count">19</span>
                            </a>
                        </td>
                            <td class="last t comments">
                            <a href="edit-comments.php">评论</a>
                        </td>
                        </tr>
                        <tr>
                            <td class="b b_approved">
                                <a href="edit-comments.php?comment_status=approved">
                                <span class="approved-count">19</span>
                            </a>
                            </td>
                                <td class="last t">
                                <a class="approved" href="edit-comments.php?comment_status=approved">获准</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="b b-waiting">
                                <a href="edit-comments.php?comment_status=moderated">
                                <span class="pending-count">0</span>
                            </a>
                            </td>
                                <td class="last t">
                                <a class="waiting" href="edit-comments.php?comment_status=moderated">待审</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="b b-spam">
                                <a href="edit-comments.php?comment_status=spam">
                                <span class="spam-count">0</span>
                                </a>
                            </td>
                            <td class="last t">
                                <a class="spam" href="edit-comments.php?comment_status=spam">垃圾评论</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="publish left">
        <div class="h">快速发布</div>
        <div class="pub-form">
            <form class="pure-form" action="<?=$homeurl?>/articles/modify" method="POST" onsubmit="return checkForm()">
                <input class="pure-input-1" id="title" type="text" name="title" placeholder="在此键入标题">
                
                <textarea cols="80" id="content" name="content" rows="10"></textarea>

                <input class="pure-input-1 tag" name="tags" type="text" placeholder="标签（用英文逗号分隔）">

                <input type="hidden" name="aid" value="0">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="cate" value="0">
                <button type="submit" class="pure-button pure-button-primary">发布</button>
            </form>
        </div>
    </div>
</div>