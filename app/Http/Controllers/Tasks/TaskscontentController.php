<?php

namespace App\Http\Controllers\Tasks;

use App\con_taskscontent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TaskscontentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($msg = 0)
    {
        //任务管理

        $result = DB::table('con_taskscontents')
            ->where('con_taskscontents.admin_id',Session::get('user')['user_id'])
            ->join('con_tasksgroups', 'con_taskscontents.tasks_id', '=', 'con_tasksgroups.tasks_id')
            ->select('con_taskscontents.*', 'con_tasksgroups.tasksgroup_name')
            ->get();
//        dump($result);
//        die;
        return view("Tasks.taskscontent",['result'=>$result,'msg'=>$msg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if ($request->isMethod('get')) {
            $result = DB::table('con_tasksgroups')
                ->where('admin_id',Session::get('user')['user_id'])
                ->get();
            $result1 = DB::table('con_tasksconfigures')
                ->where('admin_id',Session::get('user')['user_id'])
                ->get();
//            dump($result1);
            $navLen = count($result1);
            $firstNavId = null;
            if($navLen > 0){
                $firstNavId = $result1[0]->config_id;
            }
            return view("Tasks.taskscontentcreate",["result"=>$result,"result1"=>$result1,"firstNavId"=>$firstNavId]);
        }else{
            $data = $this->data();
//            dump($data);	content_config
            $array = [];
            foreach ($data['taskkey'] as $k=>$a){
                    $array[] = $a.':'.$data['taskvalue'][$k];
            }
            $config = '';
            foreach ($array as $value){
                $config .=$value.";";
            }
            $data['content_config'] = $config;
            $result = DB::table('con_tasksconfigures')
                ->where('config_id',$data['content_name'])
                ->first();
            $data['content_name'] = $result->config_name;
            $data['admin_id'] = Session::get('user')['user_id'];
            unset($data['taskkey']);
            unset($data['taskvalue']);
            unset($data['image']);
            $contents = DB::table('con_taskscontents')->insert($data);
            if($contents){
                $msg = "添加成功";
                return redirect()->route('contentIndex');
            }else{
                $msg = "添加失败";
                return view("Tasks.configcreate",['msg'=>$msg]);
            }
        }

    }
    /*
 * ajax调取数据
 */
    public function getConfigs(Request $request,$id = 0){
        $a = $request->all();
        $conid = $request->input('configId');
        $result = DB::table('con_tasksconfigures')
            ->where('admin_id',Session::get('user')['user_id'])
            ->where('config_id',$conid)
            ->first();
        $config = $result->config_config;
        $navconfig=explode(',',$config);
        $str='';
        foreach( $navconfig as $v){
            $str.= "<div class='layui-form-item'>";
            $str.= "<input class='layui-form-label' style='border:none;' name='taskkey[]' value='$v' >";
            $str.= "<div class='layui-input-block'>";
            $str.= "<input type='text' name='taskvalue[]' required  lay-verify='required' placeholder='请输入标题' autocomplete='off' class='layui-input'>";
            $str.= " </div></div>";
        }
        $navimg = $result->config_images;
//        dump($navimg);
        $navid = $result->config_id;
        $userdata = array(
            'content' => $str,
            'uploadimg'=>$navimg,
            'id'=>$navid,
        );
        return json_encode($userdata);
//        echo 1;
    }
    public function editConfigs(Request $request,$id = 0){
        $a = $request->all();
        $conid = $request->input('configId');
        $id = $request->input('id');
        $content = DB::table('con_taskscontents')
            ->where('content_id',$id)
            ->first();
        $value = $content->content_config;
        $value = explode(';',$value);
        array_pop($value);
//        dump($value);die;
        foreach ($value as $vo){
           $value1 = explode(':',$vo);
            $value2[] = $value1[1];
        }
//        dump($value2);
        $result = DB::table('con_tasksconfigures')
            ->where('admin_id',Session::get('user')['user_id'])
            ->where('config_id',$conid)
            ->first();
        $config = $result->config_config;
        $navconfig=explode(',',$config);
        $str='';
        foreach( $navconfig as $k=>$v){
            $str.= "<div class='layui-form-item'>";
            $str.= "<input class='layui-form-label' style='border:none;' name='taskkey[]' value='$v' >";
            $str.= "<div class='layui-input-block'>";
            $str.= "<input type='text' name='taskvalue[]' value='$value2[$k]' required  lay-verify='required' placeholder='请输入标题' autocomplete='off' class='layui-input'>";
            $str.= " </div></div>";
        }
        $navimg = $result->config_images;
//        dump($navimg);
        $navid = $result->config_id;
        $userdata = array(
            'content' => $str,
            'uploadimg'=>$navimg,
            'id'=>$navid,
        );
        return json_encode($userdata);
//        echo 1;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id=0)
    {
        //编辑
        if ($request->isMethod('get')){
            //查询任务表
                $content = DB::table('con_taskscontents')
                    ->where('content_id',$id)
                    ->first();
                //查询分组表
                $result = DB::table('con_tasksgroups')
                    ->where('admin_id',Session::get('user')['user_id'])
                    ->where('tasks_id',$content->tasks_id)
                    ->get();
        //        dump($content->content_name);
                    //查询配置表
                $result1 = DB::table('con_tasksconfigures')
                    ->where('config_name',$content->content_name)
                    ->get();
        //            dump($result1);
                $navLen = count($result1);
                $firstNavId = null;
                if($navLen > 0){
                    $firstNavId = $result1[0]->config_id;
                }
                return view("Tasks.contentedit",["content"=>$content,"result"=>$result,"result1"=>$result1,"firstNavId"=>$firstNavId]);
        }else{
            //保存
            $data = $this->data();
//            dump($data);	content_config
            $array = [];
            foreach ($data['taskkey'] as $k=>$a){
                $array[] = $a.':'.$data['taskvalue'][$k];
            }
            $config = '';
            foreach ($array as $value){
                $config .=$value.";";
            }
            $data['content_config'] = $config;
            $result = DB::table('con_tasksconfigures')
                ->where('config_id',$data['content_name'])
                ->first();
            $data['content_name'] = $result->config_name;
            $data['admin_id'] = Session::get('user')['user_id'];
            $id = $data['id'];
            unset($data['id']);
            unset($data['taskkey']);
            unset($data['taskvalue']);
            unset($data['image']);
            dump($data);
            $content = DB::table('con_taskscontents')
                ->where('content_id',$id)
                ->update($data);
           if($content){
               $msg = "添加成功";
               return redirect()->route('contentIndex');
           }else{
               $msg = "添加失败";
               return redirect()->route('contentEdit',['id'=>$id]);
           }
        }
        }
    /**
     * *更高任务状态
     */
    public function state(Request $request,$id = 0){
        $conid = $request->input('configId');
        $content_id = $request->input('content_id');
//        return $conid."+".$content_id;
        $data['content_status'] = $conid;
        $content = DB::table('con_taskscontents')
            ->where('content_id',$content_id)
            ->update($data);
        if($content){
            return 1;
        }else{
            return 0;
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //编辑提交

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
