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
    <style type="text/css">
        .layui-form-checkbox[lay-skin=primary] {
            margin: 0;
            padding: 0;
            margin-left: 5px;
        }
    </style>
</head>
<body>
<p>
<blockquote class="layui-elem-quote">管理员列表</blockquote>
</p>
&nbsp;
<a href="{{route('userindex')}}" class="layui-btn ">操作管理员</a>
<a href="{{route('rolsindex')}}" class="layui-btn ">角色管理</a>
<a href="{{route('nodeCreate')}}" class="layui-btn" ><i class="layui-icon">&#xe608;</i>添加</a>
<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
<hr />
<br />
<table class="layui-table treetable layui-form" id="nodetree">
    <thead>
    <tr>
        <th>节点名</th>
        <th>链接</th>
        <th>权值</th>
        <th>排序</th>
        <th>导航</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($result))
        <?php
        $tmp = '';
        \App\ClassLib\Category::treeMap($result,function($v) use(&$tmp) {
            $tmp .= '<tr data-tt-id="'.$v['node_id'].'" data-tt-parent-id="'.$v['pid'].'">';

            $checkbox = '';
            if(empty($v['child'])) {
                $checkbox = '<input type="checkbox" class="node_id" value="'.$v['node_id'].'" lay-skin="primary">';
            }

            $tmp .= '<td id="sp-'.$v['node_id'].'"><span class="'.(!empty($v['child']) ? 'folder' : 'file').'">'.$v['nodename'].'</span>'.$checkbox.'</td>';

            if(stripos($v['url'],'javascript') === 0) {
                $tmp .= '<td></td>';
            }else{
                $tmp .= '<td>'.$v['url'].'</td>';
            }

            $tmp .= '<td>'.$v['auth'].'</td>';

            $tmp .= '<td><input data-node_id="'.$v['node_id'].'" value="'.$v['sortid'].'" style="width:55px;" class="layui-input sortid" placeholder="请输入ID" type="text"></td>';

            $tmp .= '<td><input type="checkbox" value="'.$v['node_id'].'"  data-url="'.route('nodestore',['node_id'=>$v['node_id']]).'" lay-filter="ajax-switch" lay-skin="switch" lay-text="显示|隐藏" '.($v['nav'] == \App\con_node::NAV_SHOW ? 'checked' : '').'></td>';

            $tmp .= '<td>';

//                if(stripos($v['auth'],'Controller@index') == strlen($v['auth'])-strlen('Controller@index')) {
//                    $tmp .= '<a class="layui-btn layui-btn-small" href="/admin/rbac/node/resource/'.$v['node_id'].'" title="点击自动添加资源节点">资源</a>';
//                }

            $tmp .= '<a class="layui-btn layui-btn-small" href="'.route('nodeCreate',['node_id'=>$v['node_id']]).'">新增</a>';

            $tmp .= '<a class="layui-btn layui-btn-small" href="'.route('nodeedit',['node_id'=>$v['node_id']]).'">编辑</a>';

            if(empty($v['child'])) $tmp .= '<a class="layui-btn layui-btn-small" href="'.route('nodedel',['node_id'=>$v['node_id']]).'" data-tip="1" data-_method="DELETE" data-id="'.$v['node_id'].'" data-url="'.route('nodedel').'" lay-filter="ajax-any">删除</a>';

            $tmp .= '</td>';
            $tmp .= '</tr>';
        });
        echo $tmp;
        ?>
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
<script type="text/javascript">
    layui.use('form', function() {
        var form = layui.form();
        form.on('switch', function (data) {
//                    console.log(data.elem.value);
                    var ids = data.elem.checked; //开关是否开启，true或者false
//            console.log(data.value); //开关value值，也可以通过data.elem.value得到
            var id = data.elem.value;

            $.ajax({
                url:"{{route('nodestore')}}",
                type:"post",
                dataType: "json",
                data:{'id':id,ids:ids},
                async: "false",
                success:function(result){
                    if(result){
                        layer.msg("更新状态成功", { icon: 6 });
                    }else{
                        layer.msg("更新状态失败", { icon: 5 });
                    }
                }
            })
        });
    });
</script>
<script type="text/javascript">
    /**
     * 修改节点排序
     */
    function getSortID(data) {
        var sortid = [];
        $(".sortid").each(function () {
            var o = $(this);
            sortid.push({node_id:o.attr('data-node_id'),value:o.val()});
        });
        data['sortid'] = sortid;
        return data;
    }

    /**
     * 获取选中的node_id
     */
    function getNodeId(data) {
        data['id'] = layui.comm.getChecked('.node_id');
        if(data['id'].length == 0) {
            layui.layer.msg('请勾选后操作');
            return null;
        }
        return data;
    }

    $(function(){
        /**
         * 初始化树形表格 并展开节点到二级
         */
        $("#nodetree").treetable({expandable: true}).find('tr').each(function (i) {
            var o = $(this)
            if(o.attr('data-tt-parent-id') == 0 && o.siblings("[data-tt-parent-id='"+o.attr('data-tt-id')+"']").hasClass('leaf') == false) {
                $("#nodetree").treetable("expandNode", o.attr('data-tt-id'));
            }
        });

        /**
         * 滚动页面到指定id
         */
        layui.use('comm', function () {
            layui.comm.scrollPage();
        });
    });
</script>
</body>
</html>
