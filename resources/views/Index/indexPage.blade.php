<!DOCTYPE>
<html>
<head >
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/public/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/public/admin/css/myCss.css">
    <script src="/public/layui/layui.js" charset="utf-8"></script>
    <script src="/public/admin/js/jquery-1.12.4.js" type="text/javascript"></script>
    <style>
        .ht-box {
            display: inline-block;
            text-align: center;
            margin: 15px;
            padding: 15px 0;
            color: #fff;
            width: 12%;
        }
        .ht-box p:first-child {
            font-size: 40px;
        }
    </style>
</head>
<body>

    <div class="layui-tab-content" >
        <div class="layui-tab-item layui-show" style="margin:auto;">
            <div style="margin:auto;text-align:center">
            <p style="padding: 10px 15px;text-align: center;border:1px solid #ddd;display:inline-block;">
                    上次登陆
                    <span style="padding-left:1em;">IP：{{Session::get('user')['prevIp']}}</span>
                    <span style="padding-left:1em;">地点：{{Session::get('user')['prevCity']}}</span>
                    <span style="padding-left:1em;">时间：{{Session::get('user')['prevTime']}}</span>
                </p>
            </div>
                <fieldset class="layui-elem-field layui-field-title">
                    <legend>统计信息</legend>
                    <div class="layui-field-box">
                        <div style="display: inline-block; width: 100%;">
                            <div class="ht-box layui-bg-blue">
                                <p>{{$user}}</p>
                                <p>用户总数</p>
                            </div>
                            <div class="ht-box layui-bg-red">
                                <p>{{$tasks}}</p>
                                <p>任务总数</p>
                            </div>
                            <div class="ht-box layui-bg-black">
                                <p>{{$tasksgroups}}</p>
                                <p>分组总数</p>
                            </div>
                            <div class="ht-box layui-bg-orange">
                                <p>{{$equipments}}</p>
                                <p>设备总数</p>
                            </div>
                            <div class="ht-box layui-bg-cyan">
                                <p>{{$tasksconfigures}}</p>
                                <p>配置总数</p>
                            </div>
                            <div class="ht-box layui-bg-green">
                                <p>{{$uploads}}</p>
                                <p>资源总数</p>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
</body>
</html>
