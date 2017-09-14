/**
 * 添加参数到 url search
 */
layui.define(function(exports) {
    /**
     * 解析 window.location.search 成一个json对象
     * @returns {{}}
     */
    function parse() {
        var result = {};
        var search = window.location.search;
        if(search !== '') {
            if(search.indexOf('?') == 0) {
                search = search.substr(1, search.length);
            }
            search = search.split('&');

            for(var i in search) {
                search[i] = search[i].split('=');
                result[search[i][0]] = search[i][1];
            }
        }
        return result;
    }

    /**
     * 从 window.location.search 获取一个参数
     * @param key
     * @returns {*}
     */
    function get(key) {
        var search = parse();
        if(search.hasOwnProperty(key)) return search[key];
        return null;
    }

    /**
     * 给 window.location.search 添加参数
     * @param data
     * @returns {string}
     */
    function append(data) {
        var search = parse();

        for(var i in data) {
            if(typeof data[i] == 'object') {
                for(var j in data[i]) {
                    search[j] = data[i][j];
                }
            }else{
                search[i] = data[i];
            }
        }

        var result = ''
        for(var i in search) {
            result += '&' + i + '=' + search[i];
        }

        if(result.indexOf('&') == 0) {
            result = result.substr(1, result.length);
        }

        return result;
    }

    /**
     * 导出接口
     */
    exports('urlSearch', {parse:parse, append:append, get:get});
});