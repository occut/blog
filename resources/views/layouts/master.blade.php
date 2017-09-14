<!DOCTYPE>
<html>
<head runat="server">
    <title>后台管理系统</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="/public/admin/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="/public/admin/css/myCss.css">
    <link rel="stylesheet" href="/public/layui/css/layui.css" media="all">
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <!--头部-->
    <div class="layui-header ymheader" style="background: #393d49;">
        <a href="javascript:" class="logo"><i class="layui-icon" style="font-size: 42px;">&#xe62e;</i>
            后台管理系统</a>
        <button class="layui-btn layui-btn-mini MyYinCang" title="隐藏/显示" onclick="javascript:ShowHiddenLeft()">
            〓</button>
        <ul class="layui-nav" style="float: right;">
            <li class="layui-nav-item layui-this"><a href="javascript:switchMy(1);">网站管理</a>
            </li>
            <li class="layui-nav-item "><a href="javascript:switchMy(2);">内容维护</a> </li>
            <li class="layui-nav-item "><a href="javascript:;" class="admin-header-user">
                    <img src="images/Head.jpg" width="40" height="40" class="layui-circle" />
                    <span>&nbsp;管理员</span></a>
                <dl class="layui-nav-child">
                    <dd>
                        <a href="javascript:ChangePage('adminUser.html');"><i class="layui-icon">&#xe612;</i>
                            管理员管理</a>
                    </dd>
                    <dd>
                        <a href="quit"><i class="layui-icon">&#xe609;</i> 注销</a>
                    </dd>
                </dl>
            </li>
        </ul>
    </div>
    <!--头部END-->
    <!--侧栏-->
    <div class="layui-side layui-bg-black" id="SiteSidebar">
        <div class="layui-side-scroll">
            <ul class="layui-nav layui-nav-tree" lay-filter="test" id="left1">
                <li class="layui-nav-item layui-nav-itemed"><a href="javascript:;">任务管理</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:ChangePage('tasksIndex');"><i class="layui-icon"></i> 分组管理</a></dd>
                        <dd>
                            <a href="javascript:ChangePage('tasksShow');"><i class="layui-icon"></i> 设备管理</a></dd>
                        <dd>
                            <a href="javascript:ChangePage('configIndex');"><i class="layui-icon"></i> 配置管理</a></dd>
                        <dd>
                            <a href="javascript:ChangePage('contentIndex');"><i class="layui-icon"></i> 任务管理</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item "><a href="javascript:;">账户管理</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:ChangePage('accountIndex');"><i class="layui-icon"></i>微信账户</a></dd>
                        <dd>
                            <a href="javascript:ChangePage('idcardIndex');"><i class="layui-icon"></i>实名认证</a></dd>
                        <dd>
                            <a href="javascript:ChangePage('configIndex');"><i class="layui-icon"></i>微博账户</a></dd>
                        <dd>
                            <a href="javascript:ChangePage('contentIndex');"><i class="layui-icon"></i>QQ账户</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item "><a href="javascript:;">资源管理</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:ChangePage('resourcesIndex');"><i class="layui-icon"></i>图片管理</a>
                        </dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav layui-nav-tree" lay-filter="test" id="left2" style="display: none;">
                <li class="layui-nav-item layui-nav-itemed"><a href="javascript:;">用户管理</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:ChangePage('adminUserList');"><i class="layui-icon">&#xe606;</i>用户</a>
                        </dd>
                        <dd>
                            <a href="javascript:ChangePage('rolsIndex');"><i class="layui-icon">&#xe600;</i>角色管理</a>
                        </dd>
                        <dd>
                            <a href="javascript:ChangePage('nodeindex');"><i class="layui-icon">&#xe600;</i>节点管理</a>
                        </dd>
                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed"><a href="javascript:;">信息管理</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:ChangePage('G_informationList.html?type=1&name=资质荣誉');"><i class="layui-icon">
                                    &#xe602;</i> 管理资质荣誉</a></dd>

                    </dl>
                </li>
                <li class="layui-nav-item layui-nav-itemed"><a href="javascript:;">产品管理</a>
                    <dl class="layui-nav-child">
                        <dd>
                            <a href="javascript:ChangePage('G_productadd.html');"><i class="layui-icon">&#xe61f;</i>
                                产品添加</a></dd>
                        <dd>
                            <a href="javascript:ChangePage('G_productList.html');"><i class="layui-icon">&#xe631;</i>
                                产品管理</a></dd>
                        <dd>
                            <a href="javascript:ChangePage('problemType.html');"><i class="layui-icon">&#xe62a;</i>
                                产品分类管理</a></dd>
                    </dl>
                </li>

            </ul>
        </div>
    </div>
    <!--侧栏END-->
    <!--内容-->
    <div class="layui-body layui-tab-content" id="connn" style="bottom: 0px;">
        <iframe src="indexPage" id="myiframe" style="height: 100%; width: 100%;" frameborder="no"
                border="0" marginwidth="0" marginheight="0" scrolling="yes" allowtransparency="yes">
        </iframe>
    </div>
    <!--<div class="layui-footer footer footer-demo" style="height:24px; text-align:center; padding-top:6px;" id="admin-footer">2017 © Background management system</div>-->
</div>

<script src="/public/admin/js/jquery-1.12.4.js" type="text/javascript"></script>
<script src="/public/layui/layui.js" charset="utf-8"></script>
<script type="text/javascript">
    function ShowHiddenLeft() {
        var sideWidth = $('#SiteSidebar').width();
        if (sideWidth === 200) {
            $('#connn').animate({
                left: '0'
            });
            $('#SiteSidebar').animate({
                width: '0'
            });
        } else {
            $('#connn').animate({
                left: '200px'
            });
            $('#SiteSidebar').animate({
                width: '200px'
            });
        }
    }

    layui.use(['element', 'layer'], function () {
        var element = layui.element()
            , layer = layui.layer;
        if ($("#myiframe").css("height") == "150px") {
            $("#connn").css("height", "781px")
        }
    });
    //跳转iframe
    function ChangePage(strStr) {
        $("#myiframe").attr("src", strStr);
    }

    function switchMy(num) {
        $("[lay-filter='test']").hide();
        $("#left" + num).show();
    }

</script>
</body>
</html>
