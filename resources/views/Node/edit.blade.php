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
        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
        }
        //获取图片真实宽高
        function getImageWidth(url, callback) {
            var img = new Image();
            img.src = url;

            // 如果图片被缓存，则直接返回缓存数据
            if (img.complete) {
                callback(img.width, img.height);
            } else {
                // 完全加载完毕的事件
                img.onload = function () {
                    callback(img.width, img.height);
                }
            }
        }
    </script>

    <script type="text/javascript">

        layui.use(['form'], function () {
            var form = layui.form();
            form.render();
        });

    </script>
</head>
<body>
<p>
<blockquote class="layui-elem-quote">添加角色</blockquote>
</p>
<a href="/rolsIndex" class="layui-btn  layui-btn-normal">角色列表</a>
<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
<a href="javascript:history.go(-1);" title="返回" style="line-height:1.6em;margin-top:3px;float:right" class="layui-btn layui-btn-small"><i class="layui-icon">&#xe603;</i></a>
<hr />
<br />
<fieldset class="layui-elem-field layui-field-title">
    <legend>编辑节点</legend>
    <div class="layui-field-box">
        <form class="layui-form" action="{{route('nodeupdate',['node_id'=>$result->node_id])}}" method="">
            <div class="layui-form-item">
                <label class="layui-form-label">节点名</label>
                <div class="layui-input-inline">
                    <input type="text" value="{{$result->nodename}}" name="nodename" required lay-verify="required" placeholder="请输入节点名" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">上级节点</label>
                <div class="layui-input-inline">
                    <select name="pid" lay-verify="required">
                        <option value="0">顶级节点</option>
                        @if(!empty($node))
                            @foreach($node as $v)
                                <option @if($v['node_id'] === $result->pid) selected @endif value="{{$v['node_id']}}">|-{{$v['delimiter'].$v['nodename']}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">链接</label>
                <div class="layui-input-inline width-500">
                    <input type="text" value="{{$result->url}}" name="url" placeholder="请输入url链接" autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label class="layui-form-label">权值</label>
                <div class="layui-input-inline width-500">
                    <input type="text" value="{{$result->auth}}" name="auth" placeholder="请输入权值" autocomplete="off" class="layui-input">
                </div>
                <div class="layui-form-mid layui-word-aux">
                    此节点是某个控制器的方法则填写
                    <br>
                    例如：App\Http\Controllers\Admin\Rbac\NodeController<?php echo '@';?>index
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    {{csrf_field()}}
                    {{ method_field('PUT') }}
                    <button class="layui-btn layui-btn-small" lay-submit>提交</button>
                </div>
            </div>

        </form>
    </div>
</fieldset>
<script type="text/javascript" src="/public/admin/js/script.js"></script>
<script>
    //表单提交
    layui.use(['form'],function () {
        $ = layui.jquery;
        var form = layui.form();
        form.on('submit(signIn)',function (data) {
            var result = post(data.form.action,data.field);
            console.log(result);
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
