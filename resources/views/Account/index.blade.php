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
<blockquote class="layui-elem-quote">管理员列表</blockquote>
</p>
&nbsp;
<a href="{{route('tasksShow')}}" class="layui-btn  layui-btn-normal">设备管理</a>
<a href="{{route('accountCreate')}}" class="layui-btn" ><i class="layui-icon">&#xe608;</i>添加</a>
<a  class="layui-btn"  onclick="delAll('{{route('accountdestroy')}}')">删除</a>
<a >共：<a style="color:red;" >{{$num}}</a>&nbsp;条数据</a>
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
        <th>设备ID</th>
        <th>账号</th>
        <th>密码</th>
        <th>62数据</th>
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
                <td style="text-align: center;"><input type="checkbox" value=" {{$v->wechat_id}}" name="delAll"></td>
                <td>
                    {{$v->wechat_id}}
                </td>
                <td>
                    {{$v->equipment_id}}
                </td>
                <td>
                    {{$v->wechat_name}}
                </td>
                <td>
                    {{$v->wechat_password}}
                </td>
                <td>
                    {{substr($v->wechat_data,0,20)}}...
                </td>
                <td>
                    {{$v->wechat_state}}
                </td>
                <td>
                    {{$v->wechat_Remarks}}
                </td>
                <td >
                    {{$v->updated_at}}
                </td>
                <td class="td-manage">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    <a class="layui-btn layui-btn-small" href="accountEdit/{{$v->wechat_id}}">编辑</a>
                    <a title="删除" class="layui-btn layui-btn-small" href="javascript:;" onclick="del(this,'{{$v->wechat_id}}','accountdestroy')" style="text-decoration:none">
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
@include('common.pagination')
<script type="text/javascript">

$(function(){
        /**
         * 初始化树形表格
         */
        $("#roletree").treetable({expandable: true});
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
</body>
</html>
