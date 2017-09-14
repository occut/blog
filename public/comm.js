/**
 * 公共js
 */
layui.define(['jquery', 'layer'], function(exports) {
    var $     = layui.jquery;
    var layer = layui.layer;

    /**
     * 获取表单元素值
     * @param selector
     * @returns {{}}
     */
    function getFormData(selector) {
        var o = $(selector);
        if(selector.substr(0,1) == '.') {
            o = o.eq(0);
        }
        var data = o.serializeArray();
        var json = {};
        $.each(data, function(){
            if(json[this.name] !== undefined) {
                if(!json[this.name].push) {
                    json[this.name] = [json[this.name]];
                }
                json[this.name].push(this.value || '');
            }else{
                json[this.name] = this.value || '';
            }
        });
        return json;
    }

    /**
     * 获取单个元素data值
     * @param mixed
     * @returns {{}}
     */
    function getElementData(mixed) {
        if(typeof mixed == 'string') {
            var o = $(mixed);
            if(mixed.substr(0,1) == '.') {
                o = o.eq(0);
            }
            var DOMobject = o[0];
        }else{
            var DOMobject = typeof mixed[0] == 'undefined' ? mixed : mixed[0];
        }

        var result = {};
        for(var i=0,len=DOMobject.attributes.length;i<len;i++) {
            if(DOMobject.attributes[i]['name'].substr(0,5) == 'data-') {
                var key = DOMobject.attributes[i]['name'].substr(5,DOMobject.attributes[i]['name'].length);
                if(key.length) {
                    result[key] = DOMobject.attributes[i]['value'];
                }
            }
        }

        result.pull = function (k,v) {
            if(this.hasOwnProperty(k)) {
                var tmp = this[k];
                delete this[k];
                return tmp;
            }
            if(v != undefined) return v;
            return null;
        };

        return result;
    }

    /**
     * 执行用户自定义函数
     */
    function callUserFunc(callback, param) {
        var func = window[callback];
        return func.call(callback, param);
    }

    /**
     * 解析json字符串
     * @param mixed
     * @returns {*}
     */
    function parseJSON(mixed) {
        if(typeof mixed == 'object') {
            return mixed;
        }
        return $.parseJSON(mixed);
    }

    /**
     * 滚动页面到指定id
     * @param id
     */
    function scrollPage(id) {
        var scroll = function (id) {
            var o = document.getElementById(id);
            if(o) {
                o.scrollIntoView();
            }
        };
        if(id == undefined) {
            var reg = /#(sp-.+)/;
            var flag = reg.exec(window.location.hash); //hash示例： #sp-29 || '#sp-29#100#2'
            if(flag != null) {
                flag = flag[1].split('#', 1);
                id = flag[0]; //id格式示例：sp-29
                scroll(id);
            }
        }else{
            scroll(id);
        }
    }

    /**
     * 获取选中 checkbox 的属性
     */
    function getChecked(targetClass, isAttr) {
        isAttr = isAttr || 0;
        targetClass = targetClass || '.check-target';
        var result = new Array();
        $(targetClass).each(function() {
            var obj = $(this);
            if(obj.attr('type') != 'checkbox') {
                obj = $(this).find("input[type='checkbox']").eq(0);
            }
            if(obj.prop('checked')) {

                var val = obj.val();
                if(val == 'on' || val == undefined) {
                    val = null;
                }

                var name = obj.attr('name');
                if(!name) {
                    name = 'value';
                }

                if(isAttr) {
                    var tmp = getElementData(obj);
                    delete tmp.pull;
                    if(!isEmpty(tmp)) {
                        if(val != null) {
                            tmp[name] = val;
                        }
                        result.push(tmp);
                    }
                }else{
                    if(val != null) {
                        result.push(val);
                    }
                }
            }
        });
        if(!isAttr) {
            result = result.join();
        }
        return result;
    }

    /**
     * 判断对象是否为空
     */
    function isEmpty(obj) {
        for (var name in obj) {
            return false;
        }
        return true;
    }

    /**
     * 判断对象中是否存在某个下标
     */
    function isset(obj, key) {
        if(key === '' || key === undefined || key === null) {
            return false;
        }
        key = key.split('.');
        var flag = true;
        for(var i in key) {
            if(obj.hasOwnProperty(key[i]) === false) {
                flag = false;
                break;
            }
            obj = obj[key[i]];
        }
        return flag;
    }

    exports('comm', {
        scrollPage:scrollPage,
        parseJSON:parseJSON,
        callUserFunc:callUserFunc,
        getElementData:getElementData,
        getFormData:getFormData,
        getChecked:getChecked,
        isEmpty:isEmpty,
        isset:isset
    });
});