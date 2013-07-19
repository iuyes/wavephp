<script type="text/javascript">
var getsubmit = function(){
    var user_login = $("#user_login").val();
    var user_pass = $("#user_pass").val();
    if(!user_login){
        $("#warning").css({"display":"block"});
        $("#warning").html("请输入用户名！");
        return false;
    }
    if(!user_pass){
        $("#warning").css({"display":"block"});
        $("#warning").html("请输入密码！");
        return false;
    }
    $("#warning").css({"display":"none"});
    $.ajax({
        type: "POST",
        url: "<?php echo Wave::app()->homeUrl.'/site/loging';?>",
        data: $("#login-form").serialize(),
        dataType: "json",
        success: function(data){
            if(data.success == true){
                window.location.href="<?php echo Wave::app()->homeUrl.'/site';?>";
            }else{
                $("#warning").css({"display":"block"});
                $("#warning").html(data.msg);
            }
        }
    });
}

$(function(){
    $("#submit").click(function(){
        getsubmit();
    })
    
    $("#user_pass").keydown(function(event){
        if (event.keyCode==13) { getsubmit(); } 
    })
})
</script>
<div class="form-signin">
    <form class="pure-form pure-form-stacked" id="login-form">
        <fieldset>
            <legend>WAVEPHP博客登录</legend>
            <div id="warning" class="alert alert-error warning"></div>
            <label for="user_login" class="form-label">用户名</label>
            <input id="user_login" type="text" name="user_login">

            <label for="user_pass" class="form-label">密码</label>
            <input id="user_pass" type="password" name="user_pass">

            <label for="remember" class="pure-checkbox clearfix">
                <div class="left"><input id="remember" type="checkbox"></div>
                <div class="left remember-txt">记住我的登录信息</div>
            </label>
            <button type="button" id="submit" class="pure-button pure-button-primary">登录</button>
        </fieldset>
    </form>
</div>