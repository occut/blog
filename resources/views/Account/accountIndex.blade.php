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
</head>
<body style="height: 100%">
<p>
<blockquote class="layui-elem-quote">管理员列表</blockquote>
</p>
&nbsp;
<a  class="layui-btn"  onclick="delAll('{{route('idcarddestroy')}}')">删除</a>
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
        <th>姓名</th>
        <th>密码</th>
        <th>状态</th>
        <th>更新时间</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($result))
        @foreach ($result as $v)
            <tr>
                <td style="text-align: center;"><input type="checkbox" value=" {{$v->card_id}}" name="delAll"></td>
                <td>
                    {{$v->card_id}}
                </td>
                <td>
                    {{$v->card_name}}
                </td>
                <td>
                    {{$v->card_number}}
                </td>
                <td>
                    {{$v->card_state}}
                </td>
                <td >
                    {{$v->updated_at}}
                </td>
                <td class="td-manage">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    {{--<a class="layui-btn layui-btn-small" href="accountEdit/{{$v->card_id}}">编辑</a>--}}
                    <a title="删除" class="layui-btn layui-btn-small" href="javascript:;" onclick="del(this,'{{$v->card_id}}','idcarddestroy')" style="text-decoration:none">
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
@include('common.pagination')
</body>
</html>
