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
    <link href="/public/lightbox2/2.8.1/css/lightbox.css" rel="stylesheet" type="text/css" >
</head>
<body>
<p>
<blockquote class="layui-elem-quote">图片资源管理</blockquote>
</p>
&nbsp;
<button class="layui-btn" onclick="add('添加模型','{{route('resourcesCreate')}}')"><i class="layui-icon">&#xe608;</i>上传图片</button>
<a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"  href="javascript:location.replace(location.href);" title="刷新"><i class="layui-icon" style="line-height:30px">ဂ</i></a>
<hr />
<br />
<script>
    function add(title,url,w,h){
        x_admin_show(title,url,w,h);
    }
</script>
@if(!empty($msg))
    <div id="click" style="background: #CAE1FF;height:40px;line-height:40px;"><a style="width:80px;margin-left:10px;float:left;">{{$msg}}</a><a style="width:20px;float:right;color:red;" onclick="return value1()">X</a></div>
@endif
<script>
    function value1(){
        document.getElementById("click").style.display="none";
    }
</script>
        <div style="">
            <div style="margin:15px;">
                @if(isset($result))
                    @foreach ($result as $vo)
                    <ul class="cl portfolio-area" style="margin:0px;text-align: center;">
                        <li class="item">
                            <div class="portfoliobox" style=" float:left;margin:5px 5px;">
                                <div class="picbox" ><a href="{{$vo->up_path}}" data-lightbox="gallery" data-title="{{$vo->up_date}}"><img  style = "width:180px;" src="{{$vo->up_path}}"></a></div>
                                <div class="">{{ substr($vo->up_date,0,20)}}</div>
                                <a href="">删除</a>
                            </div>
                        </li>
                    </ul>
                @endforeach
                @endif
            </div>
        </div>
    </div>
<script src="/public/js/script.js" charset="utf-8"></script>
<script type="text/javascript" src="/public/admin/js/script.js"></script>
<script type="text/javascript" src="/public/admin/treeTable/jquery.treetable.js"></script>
<script type="text/javascript" src="/public/lightbox2/2.8.1/js/lightbox.min.js"></script>
</body>
</html>