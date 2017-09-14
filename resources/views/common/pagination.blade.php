@if(isset($result) && method_exists($result,'total') && method_exists($result,'perPage') && method_exists($result,'currentPage'))
    <div id="pagination" style="width:500px;margin:auto;"></div>
    <script type="text/javascript">
        window.onload = function () {
            layui.use(['layer','laypage', 'urlSearch'], function() {
                layui.laypage({
                    cont: 'pagination',
                    pages: {{$result->total() > 0 ? ceil($result->total() / $result->perPage()) : 0}},
                    curr: {{$result->currentPage()}},
                    jump: function(obj, first) {
                        if(!first) {
                            layui.layer.load();
                            var url = window.location.origin+window.location.pathname+'?'+layui.urlSearch.append({page:obj.curr});
                            window.location.href = url;
                        }
                    }
                });
            });
        };
    </script>
@endif