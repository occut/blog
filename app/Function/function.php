<?php
namespace App\Functions;

use Illuminate\Http\Request;



class LogAction{
    public static function data($data){
        unset($data['_token']);
        return $data;
    }
    /*
   * 记录日志
   */
    public static function logAction($action){
        $table = new \App\kai_journal();
        $request = new Request();
        $table->username = session()->get('user')['username'];
        $table->action = $action;
        $table->ids = 1;
        $table->ip = request()->ip();
        $value = $table->save();
        return $value;
    }
    /*
     * get
     */
    static public function get($url, $data_type = 'text', $USERPWD = null)
    {
        $cl = curl_init();
        if (stripos($url, 'https://') !== FALSE) {
            curl_setopt($cl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($cl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($cl, CURLOPT_SSLVERSION, 1);
        }
        curl_setopt($cl, CURLOPT_URL, $url);
        curl_setopt($cl, CURLOPT_RETURNTRANSFER, 1);
        if ($USERPWD !== null) {
            curl_setopt($cl, CURLOPT_USERPWD, $USERPWD);
        }
        $content = curl_exec($cl);
        $status = curl_getinfo($cl);
        curl_close($cl);
        if (isset($status['http_code']) && $status['http_code'] == 200) {
            if ($data_type == 'json') {
                $content = json_decode($content);
            }
            if ($data_type == 'array') {
                $content = json_decode($content, true);
            }
            return $content;
        } else {
            return FALSE;
        }
    }

/*
 * post
 */
    static public function post($url, $fields, $data_type = 'text', $USERPWD = null)
    {
        $cl = curl_init();
        if (stripos($url, 'https://') !== FALSE) {
            curl_setopt($cl, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($cl, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($cl, CURLOPT_SSLVERSION, 1);
        }
        curl_setopt($cl, CURLOPT_URL, $url);
        curl_setopt($cl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cl, CURLOPT_POST, true);
        if ($USERPWD !== null) {
            curl_setopt($cl, CURLOPT_USERPWD, $USERPWD);
        }
        curl_setopt($cl, CURLOPT_POSTFIELDS, $fields);
        $content = curl_exec($cl);
        $status = curl_getinfo($cl);
        curl_close($cl);
        if (isset($status['http_code']) && $status['http_code'] == 200) {
            if ($data_type == 'json') {
                $content = json_decode($content);
            }
            if ($data_type == 'array') {
                $content = json_decode($content, true);
            }
            return $content;
        } else {
            return FALSE;
        }
    }
}
class Category
{
    /**
     * 取分类的所有子分类 返回 树形结构数组
     * @return array
     */
    public static function child($array, $id, $idname='id',$pidname='pid',$child='child') {
        $tree = array();
        $new_array = array();
        foreach ($array as $key => $value) {
            $new_array[$value[$idname]] =& $array[$key];
        }
        foreach ($array as $key => $value) {
            $pid =  $value[$pidname];
            if ($id == $pid) {
                $tree[$array[$key][$idname]] =& $array[$key];
            }else{
                if (isset($new_array[$pid])) {
                    $parent =& $new_array[$pid];
                    $parent[$child][$array[$key][$idname]] =& $array[$key];
                }
            }
        }
        return $tree;
    }

    /**
     * 迭代 树形结构数组
     * @param  child 方法的返回值
     * @param  回调函数
     * @param  每个子节点的key值
     */
    public static function treeMap($treeArray,$callback,$child='child') {
        if(!is_callable($callback)) return false;
        foreach ($treeArray as $key => $value) {
            call_user_func($callback,$value);
            if(isset($value[$child]) && count($value[$child])) {
                self::treeMap($value[$child],$callback,$child);
            }
        }
    }

    public static  function one($items, $pid = 0,$pidName = 'parentId',$idName = 'catId',$delimiter = '--', $level = 0) {
        $arr = [];
        foreach ($items as $v) {
            if ($v[$pidName] == $pid) {
                $v['level'] = $level + 1;
                $v['delimiter'] = str_repeat($delimiter, $level);
                $arr[] = $v;
                $arr = array_merge($arr, self::one($items, $v[$idName],$pidName,$idName,$delimiter, $v['level']));
            }
        }
        return $arr;
    }
}


if (!function_exists('input')) {
    function input($key = null, $value = '')
    {
        if (is_null($key)) {
            return request()->all();
        }
        return request()->get($key, $value);
    }
}