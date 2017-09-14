<!DOCTYPE>
<html>
<head>
    <title>后台登陆</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/public/admin/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/public/layui/css/layui.css" />
    <link rel="stylesheet" type="text/css" href="/public/admin/css/loginCss.css" />
</head>
<body class="login-body">
<div class="login-box">
    <form class="layui-form layui-form-pane" action="verification" method="post">
        <div class="layui-form-item">
            <h3>
                <span>网站后台管理系统</span><br />
                <span class="version"></span></h3>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                用户名：</label>
            <div class="layui-input-inline">
                <input type="text" name="username"  autocomplete="off" class="layui-input" lay-verify="account" placeholder="请输入用户名" maxlength="20" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                密码：</label>
            <div class="layui-input-inline">
                <input type="password" name="password" class="layui-input" lay-verify="password" placeholder="请输入密码" maxlength="20" />
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                验证码
            </label>
            <div class="layui-input-inline" style="width: 76px;" >
                <input type="text" name="captcha" placeholder="验证码" required lay-verify="required" autocomplete="off" class="layui-input">
            </div>
            <div class="layui-input-inline" style="width: auto;margin: 0;" >
                <img style="height: 38px;width:100px;margin: 0;" src="{{captcha_src()}}" alt="验证码" onclick="this.src='/captcha/default?a='+Math.random(0,10)">
            </div>
        </div>
        @if (count($errors) > 0)
            <div class="layui-form-item" style="color: #DD4A68;">
                <label class="layui-form-label"></label>
                <div class="layui-input-inline">
                    @foreach ($errors->all() as $error)
                        {!! $error !!}
                    @endforeach
                </div>
            </div>
        @endif
        <div class="layui-form-item" style="margin:15px;">
            <a type="reset" class="layui-btn btn-reset layui-btn-danger">
                重置</a>
            {{csrf_field()}}
            <button  class="layui-btn btn-submit logSubmit" lay-submit lay-filter="signIn">
                立即登录</button>
        </div>
    </form>
</div>
<script type="text/javascript" src="/public/layui/layui.js"></script>
<script type="text/javascript" src="/public/admin/js/script.js"></script>
<script>
    //Demo
    layui.use('form', function(){
        var form = layui.form;
        $ = layui.jquery;
        //监听提交
        form.on('submit(signIn)', function(data){
            var result = post(data.form.action,data.field);
            if(typeof result == 'object' && result.error){
                layer.msg(result.msg, { icon: 6 });
                layer.closeAll('page');
                setTimeout(function () {
                    location.href = result.url;
                }, 1000);
            }else{
                layer.msg(result.msg, { icon: 5 });
            }
            return false;
        });
    });
</script>
</body>
</html>
