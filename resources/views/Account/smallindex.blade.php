<!DOCTYPE>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理员管理</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/public/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/public/admin/css/myCss.css">
    <script src="/public/layui/layui.js" charset="utf-8"></script>
    <script src="/public/admin/js/jquery-1.12.4.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/public/admin/treeTable/jquery.treetable.theme.default.css">
    <link rel="stylesheet" type="text/css" href="/public/admin/treeTable/jquery.treetable.css">
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
        layui.use(['util'], function () {
            var util = layui.util;

        });
        function deleteUser(delid) {
            var index = parent.layer.confirm('确定要删除这个用户吗？', {
                btn: ['删除', '我再想想'] //按钮
            }, function () {
                parent.layer.close(index);
                location.href = 'adminUserList.html?action=del&id=' + delid;
            }, function () {
                parent.layer.close(index);
            });
        }
    </script>
</head>
<body style="height: 100%">
<p>
<blockquote class="layui-elem-quote">账号列表</blockquote>
</p>
&nbsp;
{{--<a href="{{route('tasksShow')}}" class="layui-btn  layui-btn-normal">设备管理</a>--}}
<a href="{{route('smallCreate')}}" class="layui-btn" ><i class="layui-icon">&#xe608;</i>添加</a>
<a  class="layui-btn"  onclick="delAll('{{route('smallDel')}}')">删除</a>
<a >共：<a style="color:red;" >{{$num}}</a>&nbsp;条数据</a>
<form class="layui-form" action="" style="float: left;">
    <div class="layui-form-item">
        <div class="layui-inline">
            <div class="layui-input-inline">
                <input type="text" name="small_state" value="{{$value}}" class="layui-input" autocomplete="off" placeholder="请输状态：正常/使用">
            </div>
        </div>

        <div class="layui-inline">
            <div class="layui-input-inline">
                <button class="layui-btn layui-btn-small">搜索</button>
            </div>
        </div>
    </div>
</form>
<form class="layui-form" style="float: left;" action="{{route("txtcreate")}}" method="post">
    <input type="file" name="file" class="layui-upload-file" lay-title="文本添加">
</form>
<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
<hr />
<br />
@if(!empty($msg))
    <div id="click" style="background: #CAE1FF;height:40px;line-height:40px;"><a style="width:80px;margin-left:10px;float:left;">{{$msg}}</a><a style="width:20px;float:right;color:red;" onclick="return value1()">X</a></div>
@endif
<script>
    function value1(){
        document.getElementById("click").style.display="none";
    }
</script>

<table class="layui-table treetable" id="roletree">
    <thead>
    <tr>
        <th style = "width:5%;text-align: center;"><input type="checkbox" id="dellAll" value=""></th>
        <th>ID</th>
        <th>账户</th>
        <th>密码</th>
        <th>状态</th>
        <th>备注</th>
        <th>更新时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($result))
        @foreach ($result as $v)
            <tr>
                <td style="text-align: center;"><input type="checkbox" value=" {{$v->small_id}}" name="delAll"></td>
                <td>
                    {{$v->small_id}}
                </td>
                <td>
                    {{$v->small_name}}
                </td>
                <td>
                    {{$v->small_password}}
                </td>
                <td class="layui-form">
                    <input type="checkbox" value=" {{$v->small_id}}" data-url="{{route('contentCreate')}}" name="state" lay-filter="ajax-switch" lay-skin="switch" lay-text="正常|使用"   @if ($v->small_state == 0)checked @endif>

                </td>
                <td>
                    {{$v->small_data}}
                </td>
                <td >
                    {{$v->updated_at}}
                </td>
                <td class="td-manage">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    {{--<a class="layui-btn layui-btn-small" href="accountEdit/{{$v->card_id}}">编辑</a>--}}
                    <a title="删除" class="layui-btn layui-btn-small" href="javascript:;" onclick="del(this,'{{$v->small_id}}','smallDel')" style="text-decoration:none">
                        删除
                    </a>
                </td>
            </tr>
        @endforeach
    @endif
    </tbody>
</table>
<script type="text/javascript" src="/public/admin/js/script.js"></script>
<script type="text/javascript" src="/public/admin/treeTable/jquery.treetable.js"></script>
<script type="text/javascript">
    $(function(){
        /**
         * 初始化树形表格
         */
        $("#roletree").treetable({expandable: true});
    });

    layui.use('form', function() {
        var form = layui.form();
        form.on('switch', function (data) {
            var ids = data.elem.checked; //开关是否开启，true或者false
//            console.log(data.value); //开关value值，也可以通过data.elem.value得到
            var small_id = data.value;
            if(ids){
                var id = 0;
            }else{
                var id = 1;
            }
            $.ajax({
                url:"{{route('smallstata')}}",
                type:"post",
                dataType: "json",
                data:{'stata':id,'small_id':small_id},
                async: "false",
                success:function(result){
                    if(result.error){
                        layer.msg(result.msg, { icon: 6,time: 2000,});
                    }else{
                        layer.msg(result.msg, { icon: 5 });
                    }
                }
            })
        });
    });
    $(document).ready(function () {
        var num = 1;
        var checkbox = $("input[type='checkbox'][name='delAll']");
        $('#dellAll').on('click',function () {
//                alert(123);
            if (num%2){
                $.each(checkbox, function(i, n){
                    checkbox[i].checked = true;
                });
            }else{
                $.each(checkbox, function(i, n){
                    checkbox[i].checked = false;
                });
            }
            num++;
        });
        $('.selectRule').on('click',function () {
            var classname = $(this).children(".layui-form-checkbox")[0].className;
            var classArr = classname.split(' ');
            var checkbox = $(this).next('td').find("input[type='checkbox']");
            if($.inArray('layui-form-checked',classArr) >= 0){
                $.each(checkbox,function (i,n) {
                    checkbox[i].checked = true;
                });
                $(this).next('td').find(".layui-form-checkbox").addClass('layui-form-checked');
            }else{
                $.each(checkbox,function (i,n) {
                    checkbox[i].checked = false;
                });
                $(this).next('td').find(".layui-form-checkbox").removeClass('layui-form-checked');
            }
        });

    });
</script>
<script>
    layui.use('form', function() {
        var form = layui.form();
        layui.use('upload', function(){
            layui.upload({
                url: "{{route("txtcreate")}}",
                ext: 'txt',
                param:{type:'img/goods'}, //object  string
                before: function(input){
                    load = layer.load(1, {
                        shade: [0.1,'#000'] //0.1透明度的白色背景
                    });
                },
                success: function(result, input){
//                    console.log(result);
                    layer.close(load);
                    var uploadpic = $('.uploadpic');
                    if (result.success){
                        layer.alert(result.msg,{icon:1, skin:'layer-ext-moon' });
                    }else{
                        layer.alert(result.msg,{icon:2, skin:'layer-ext-moon' });
                    }
                }
            });
        });
    });
</script>
@include('common.pagination')
</body>
</html>
