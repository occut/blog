<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/public/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/public/admin/css/myCss.css">
    <script src="/public/layui/layui.js" charset="utf-8"></script>
    <script src="/public/admin/js/jquery-1.12.4.js" type="text/javascript"></script>
    <title>导入文件</title>
</head>
<body style="height: 100%">
<p>
<blockquote class="layui-elem-quote">添加IDcard</blockquote>
</p>
&nbsp;
<a href="{{route('accountIndex')}}" class="layui-btn  layui-btn-normal">实名认证</a>
<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
<hr />
<br />
@if(!empty($msg))
    <div id="click" style="background: #CAE1FF;height:40px;line-height:40px;margin-top:10px;margin-bottom:20px;margin-left:50px;"><a style="width:80px;margin-left:10px;float:left;">{{$msg}}</a><a style="width:20px;float:right;color:red;" onclick="return value1()">X</a></div>
@endif
<script>
    function value1(){
        document.getElementById("click").style.display="none";
    }
</script>
<form class="layui-form" action="{{route('idcardCreate')}}" method="post">
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">文本域</label>
        <div class="layui-input-block">
            <textarea name="desc" placeholder="请输入内容"  class="layui-textarea" style = "height:300px;"></textarea>
            <div class="layui-form-mid layui-word-aux">示例：用户----密码----数据</div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            {{csrf_field()}}
            <button  class="layui-btn btn-submit logSubmit" lay-submit lay-filter="signIn">提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script>
    //Demo
    //监听提交
    layui.use(['form'],function () {
        $ = layui.jquery;
        var form = layui.form();
        form.on('submit(signIn)',function (data) {
            var result = post(data.form.action,data.field);
            console.log(result);
            if(result == 1){
                layer.msg("添加成功", { icon: 6 });
                layer.closeAll('page');
                layer.alert("添加成功",{ icon: 1,skin: 'layer-ext-moon' },function(){
                    parent.location.reload();
                });
            }else{
                layer.alert("添加失败",{icon:2, skin:'layer-ext-moon' },function () {
                    location.reload();
                });
            }
            return false;
        });
    });
</script>
</body>
</html>