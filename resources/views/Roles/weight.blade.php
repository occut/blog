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
    <link rel="stylesheet" type="text/css" href="/public/admin/zTree/css/zTreeStyle/zTreeStyle.css">
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
<blockquote class="layui-elem-quote">管理员列表</blockquote>
</p>
&nbsp;
<a href="adminUser.html" class="layui-btn ">操作管理员</a>
<a href="javascript:;" class="layui-btn  layui-btn-normal">管理员列表</a>
<a href="javascript:;" class="layui-btn" onclick="add('添加规格','rolsCreate')"><i class="layui-icon">&#xe608;</i>添加</a>
<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
<hr />
<br />
<fieldset class="layui-elem-field layui-field-title">
    <legend>角色节点</legend>
    <div class="layui-field-box">
        <form class="layui-form" action="{{route('roleuweightpost',['role_id'=>$role_id])}}" method="post">
            <div class="layui-form-item">
                <label class="layui-form-label"></label>
                <div class="layui-input-inline">
                    <ul id="nodetree" class="ztree"></ul>
                </div>
            </div>

            <div class="layui-form-item">
                <div class="layui-input-block">
                    {{csrf_field()}}
                    <input type="hidden" value="{{$nodeIds}}" name="node_id" id="node_id">
                    <button class="layui-btn layui-btn-small" lay-submit>提交</button>
                </div>
            </div>

        </form>
    </div>
</fieldset>
<script type="text/javascript" src="/public/admin/js/script.js"></script>
<script type="text/javascript" src="/public/admin/treeTable/jquery.treetable.js"></script>
<script type="text/javascript" src="/public/admin/zTree/js/jquery.ztree.core.min.js"></script>
<script type="text/javascript" src="/public/admin/zTree/js/jquery.ztree.excheck.min.js"></script>

<script type="text/javascript">
    var setting = {
        check: {
            enable: true,
            chkboxType: { "Y" : "ps", "N" : "s" }
        },
        data: {
            simpleData: {
                enable: true,
                idKey: "node_id",
                pIdKey: "pid",
            }
        },
        callback: {
            onCheck:onCheck
        }
    };

    var node = {!! $result !!};

    /**
     * 获取选中的节点，更新数据到隐藏域
     */
    function onCheck(e,treeId,treeNode) {
        var treeObj = $.fn.zTree.getZTreeObj("nodetree");
        var nodes = treeObj.getCheckedNodes(true);
        var nodeIds = "";
        for(var i=0;i<nodes.length;i++){
            if(nodeIds == '') {
                nodeIds += nodes[i].node_id;
            }else{
                nodeIds += "," + nodes[i].node_id;
            }

        }
        $("#node_id").attr('value',nodeIds);
    }

    $(document).ready(function(){
        $.fn.zTree.init($("#nodetree"), setting, node);
    });
</script>
</body>
</html>
