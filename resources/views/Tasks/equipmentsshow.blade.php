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
<body>
<p>
<blockquote class="layui-elem-quote">设备管理</blockquote>
</p>
&nbsp;
<a href="{{route('tasksIndex')}}" class="layui-btn ">分组管理</a>
{{--<a href="javascript:;" class="layui-btn  layui-btn-normal">管理员列表</a>--}}
{{--<a href="{{route('tasksCreate')}}" class="layui-btn" ><i class="layui-icon">&#xe608;</i>添加</a>--}}
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
        <th>ID</th>
        <th>分组名</th>
        <th>设备ID</th>
        <th>任务名</th>
        <th>任务进度</th>
        <th>更新时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($result))
        @foreach ($result as $v)
            <tr>
                <td>
                    {{$v->eq_id}}
                </td>
                <td>
                    {{$v->tasksgroup_name}}
                </td>
                <td>
                    {{$v->equipments}}
                </td>
                <td>
                    {{$v->tasks_name}}
                </td>
                <td>
                    {{$v->tasks_progress}}
                </td>
                <td >
                    {{$v->updated_at}}
                </td>
                <td class="td-manage">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    {{--<a class="layui-btn layui-btn-small" href="create/{{$v->eq_id}}">编辑</a>--}}
                    <a title="删除" class="layui-btn layui-btn-small" href="javascript:;" onclick="del(this,'{{$v->eq_id}}','showdel')" style="text-decoration:none">
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
</script>
</body>
</html>
