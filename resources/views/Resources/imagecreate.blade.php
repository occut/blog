<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>添加任务</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="/public/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/public/admin/css/myCss.css">
    <script src="/public/layui/layui.js" charset="utf-8"></script>
    <script src="/public/admin/js/jquery-1.12.4.js" type="text/javascript"></script>
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
<blockquote class="layui-elem-quote">上传图片</blockquote>
</p>
<hr />
<br />
<div class="layui-tab-item layui-show">
    <form class="layui-form" action="{{route("resourcesStore")}}" method="post">
        <div class="layui-tab-item" id="main"  style="display:block">
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
            <div class="layui-input-block">
                {{csrf_field()}}
                <button class="layui-btn" lay-submit lay-filter="add">上传</button>
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
        layui.use('upload', function(){
            layui.upload({
                url: "{{route("resourcesUplode")}}",
                ext: 'jpg|png|gif|jpeg',
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
                        var src = result.pic;
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
        layer.photos({
            photos: '.layer-photos'
//                    ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
        });
        //处理 商品配图 已经上传的图片  删除 移动位置
        $('#thumpic').on('change',function () {
            var photos = $('.layer-photos');
            var mDiv;
            var val    = $.grep($(this).val().split(','), function(n) {return $.trim(n).length > 0;});
            var iObj   = photos.find('.show-img').eq(0);
            iObj.nextAll().remove();
            if(val.length !== 0){
                for(var i = 0;i < val.length; i++){
                    mDiv   = photos.find('.show-img').eq(0).clone();
                    mDiv.find('img').attr('src',val[i]);
                    mDiv.find('img').attr('layer-src',val[i]);
                    mDiv.find('img').attr('alt',val[i]);
                    mDiv.find('a').attr('index',i);
                    mDiv.css('display','inline-block');
                    iObj.after(mDiv);
                    iObj = photos.find('.show-img').last();
                }
            }
        });
        $('.layer-photos').on('click','a.prev',function () {
            //往前 一步 操作 input值
            var val   = $.grep($('#thumpic').val().split(','), function(n) {return $.trim(n).length > 0;});
            //获取 当前 index
            var index = $(this).attr('index');
            if(index != 0){
                val[index] = val.splice((index-1),1,val[index])[0];
                $('#thumpic').val(val.join(','));
                $('#thumpic').trigger('change');
            }
        });
        $('.layer-photos').on('click','a.next',function () {
            //往前 一步 操作 input值
            var val   = $.grep($('#thumpic').val().split(','), function(n) {return $.trim(n).length > 0;});
            //获取 当前 index
            var index = $(this).attr('index');
            if((val.length-1 != index)){
                val[index] = val.splice((index+1),1,val[index])[0];
                $('#thumpic').val(val.join(','));
                $('#thumpic').trigger('change');
            }
        });

        $('.layer-photos').on('click','a.del',function () {
            //往前 一步 操作 input值
            var val   = $.grep($('#thumpic').val().split(','), function(n) {return $.trim(n).length > 0;});
            //获取 当前 index
            var index = $(this).attr('index');
            val.splice(index,1);
            $('#thumpic').val(val.join(','));
            $('#thumpic').trigger('change');
        });
        form.on('submit(add)',function(data) {
            var action = $('.layui-form').attr('action');
            var result = post(action,data.field);
            if(result.error){
                layer.alert(result.msg,{ icon: 1,skin: 'layer-ext-moon' },function(){
                    parent.location.reload();
                });
            }else{
                layer.alert(result.msg,{icon:2, skin:'layer-ext-moon' });
            }
            return false;
        });
    })

</script>
</body>
</html>