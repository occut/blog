<?php

namespace App\ClassLib;
/**
 * 无限级分类处理类
 * @author  buexplain
 */
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