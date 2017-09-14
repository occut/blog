<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理员管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/public/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/public/css/myCss.css">
    <script src="/public/layui/layui.js" charset="utf-8"></script>
    <script src="/public/js/jquery-1.12.4.js" type="text/javascript"></script>
    <script type="text/javascript">
        layui.use(['form'], function () {
            var form = layui.form();
            form.render();
        });
    </script>
</head>
<body>
@if(!empty($msg))
    <div id="click" style="background: #CAE1FF;height:40px;line-height:40px;"><a style="width:80px;margin-left:10px;float:left;">{{$msg}}</a><a style="width:20px;float:right;color:red;" onclick="return value1()">X</a></div>
@endif
<script>
    function value1(){
        document.getElementById("click").style.display="none";
    }
</script>
<p>
<blockquote class="layui-elem-quote">添加分组</blockquote>
</p>
<a href="/rolsIndex" class="layui-btn  layui-btn-normal">分组列表</a>
<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
<a href="javascript:history.go(-1);" title="返回" style="line-height:1.6em;margin-top:3px;float:right" class="layui-btn layui-btn-small"><i class="layui-icon">&#xe603;</i></a>
<hr />
<br />
<div class="layui-tab-item layui-show">
    <form class="layui-form" action="{{route("tasksCreate")}}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">分组名</label>
            <div class="layui-input-inline">
                <input type="text" name="tasks_name" value="{{$tasksgroup->tasksgroup_name}}"  lay-verify="required" placeholder="请输入分组名"  autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item layui-form-text">
            <label class="layui-form-label">配置列表</label>
            <div class="layui-input-block">
                <textarea name="equipments" placeholder="请用英文状态的逗号“,”隔开" class="layui-textarea">{{$equipment}}</textarea>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                {{csrf_field()}}
                <button class="layui-btn"  lay-submit lay-filter="">
                    立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">
                    重置</button>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/public/admin/js/script.js"></script>
<script>
    //表单提交
    layui.use(['form'],function () {
        $ = layui.jquery;
        var form = layui.form();
        form.on('submit(signIn)',function (data) {
//            console.log(data.field);
            var result = post(data.form.action,data.field);
//            console.log(result);
            if(typeof result == 'object' && result.error){
                layer.msg(result.msg, { icon: 6 });
                layer.closeAll('page');
                layer.alert(result.msg,{ icon: 1,skin: 'layer-ext-moon' },function(){
                    parent.location.reload();
                });
            }else{
                layer.alert(result.msg,{icon:2, skin:'layer-ext-moon' },function () {
                    location.reload();
                });
            }
            return false;
        });
    });
</script>

</body>
</html>
