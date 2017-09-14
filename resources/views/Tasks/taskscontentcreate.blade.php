<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加任务</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/public/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/public/admin/css/myCss.css">
    <script src="/public/layui/layui.js" charset="utf-8"></script>
    {{--<script src="admin/js/jquery-1.12.4.js" type="text/javascript"></script>--}}
    {{--<script src="http://code.jquery.com/jquery-latest.js"></script>--}}
    <script type='text/JavaScript' src='http://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js'></script>
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
<blockquote class="layui-elem-quote">添加任务</blockquote>
</p>
<a href="/contentIndex" class="layui-btn  layui-btn-normal">任务管理</a>
<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
<a href="javascript:history.go(-1);" title="返回" style="line-height:1.6em;margin-top:3px;float:right" class="layui-btn layui-btn-small"><i class="layui-icon">&#xe603;</i></a>
<hr />
<br />
<div class="layui-tab-item layui-show">
    <form class="layui-form" action="{{route("contentCreate")}}" method="post">
        <div class="layui-form-item">
            <label class="layui-form-label">任务名称</label>
            <div class="layui-input-block" >
                <select name="content_name" lay-verify="required" lay-filter="aihao" >
                    @if(isset($result1))
                        @foreach ($result1 as $v)
                            <option  value="{{$v->config_id}}">{{$v->config_name}}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="form-group" id="listAllConfigs"></div>
        <div class="layui-tab-item" id="main"  style="display:none">
            <div class="layui-form-item">
                <label class="layui-form-label">任务配图</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" placeholder="http://img.xx.com/xx.jpg" name="image" vgo-pattern="add" id="thumpic">
                </div>
                <div class="layui-input-inline" style="width: auto">
                    <input type="file" name="file" class="layui-upload-file">
                </div>
            </div>
            <div  class="layer-photos">
                <div class="show-img" style="display: none;width: 100px;margin-right: 5px;text-align: center;overflow: hidden">
                    <img style="display: block;margin-bottom: 2px;" layer-src="" width="100" style="margin-bottom:5px; " src="" alt="">
                    <span>
                        <a href="javascript:;" class="layui-btn layui-btn-mini prev" ><i class="layui-icon">&#xe603;</i></a>
                        <a href="javascript:;" class="layui-btn layui-btn-mini del" ><i class="layui-icon">&#xe640;</i></a>
                        <a href="javascript:;" class="layui-btn layui-btn-mini next" ><i class="layui-icon">&#xe602;</i></a>
                    </span>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">设备分组</label>
            <div class="layui-input-block">
                <select name="tasks_id" lay-verify="required" >
                    @if(isset($result))
                    @foreach ($result as $v)
                    <option value="{{$v->tasks_id}}">{{$v->tasksgroup_name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">下单量</label>
            <div class="layui-input-inline">
                <input type="text" name="content_number"  lay-verify="required" placeholder="请输入下单量"  autocomplete="off" class="layui-input" >
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">任务状态</label>
            <div class="layui-input-block">
                <input type="radio" name="content_status" value="0" title="开启">
                <input type="radio" name="content_status" value="1" title="关闭" checked>
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                {{csrf_field()}}
                <button class="layui-btn"  lay-submit lay-filter="">
                    立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary" >
                    重置</button>
            </div>
        </div>

    </form>
</div>
<script type="text/javascript"  src="/public/admin/js/script.js"></script>
<script>

layui.use('form', function() {
    var form = layui.form();
    form.on('select(aihao)', function(data){
        var id = data.value;
        $.ajax({
            url:"{{route("getConfigs")}}",
            type:"post",
            dataType: "json",
            data:{'configId':id  },
            async: "false",
            success:function( result){
                $("#listAllConfigs").html(result.content);
                if(result.uploadimg==0){
                    $("#main").hide();
                }
                if(result.uploadimg==1){
                    $("#main").show();
                }
            }
        })
    });
    layui.use('upload', function(){
        layui.upload({
            url: "baidu.com",
            ext: 'jpg|png|gif|jpeg',
            param:{type:'img/goods'}, //object  string
            before: function(input){
                load = layer.load(1, {
                    shade: [0.1,'#000'] //0.1透明度的白色背景
                });
            },
            success: function(result, input){
                layer.close(load);
                var uploadpic = $('.uploadpic');
                if (result.error){
                    var src = result.files;
                    var oldVal = $('#thumpic').val();
                    //把旧的 和新的进行连接字符串
                    src = oldVal.length>0?oldVal+','+src:src;
                    $('#thumpic').val(src);
                    $('#thumpic').trigger('change');
                    layer.alert(result.msg,{icon:1, skin:'layer-ext-moon' });
                }else{
                    layer.alert(result.msg,{icon:2, skin:'layer-ext-moon' });
                }
            }
        });
    });

})

    function setFirstConfig(firstNavId){
//        alert(123);
        $.ajax({
            url:"{{route("getConfigs")}}",
            type:"post",
            dataType: "json",
            data:{'configId': firstNavId  },
            success: function(data){
//                alert(data);
                $("#listAllConfigs").html(data.content);
            }
        })
    }
    var navId = '{{$firstNavId}}';
    if(navId != null){
        setFirstConfig({{$firstNavId}});
    }
</script>
</body>
</html>
