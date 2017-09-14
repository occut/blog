<?php

namespace App\Http\Controllers\Tasks;

use App\con_tasksconfigur;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TasksconfigureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($msg = 0)
    {
        //配置项首页
        $result = DB::table('con_tasksconfigures')
            ->where('admin_id',Session::get('user')['user_id'])
            ->get();
        return view("Tasks.tasksconfig",['result'=>$result,'msg'=>$msg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //添加配置项
        if ($request->isMethod('get')) {
            return view("Tasks.configcreate");
        }else{
            $data = $this->data();
//            dump($data);
            $tasksconfigur = new con_tasksconfigur();
            $tasksconfigur->config_name = $data['config_name'];
            $tasksconfigur->config_config = $data['config_config'];
            $tasksconfigur->config_images = $data['config_images'];
            $tasksconfigur->admin_id = Session::get('user')['user_id'];
            $value = $tasksconfigur->save();
            if($value){
                $msg = "添加成功";
                return redirect()->route('configIndex', ['msg' => $msg]);
            }else{
                $msg = "添加失败";
                return view("Tasks.configcreate",['msg'=>$msg]);
            }
        }

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
    public function edit($id = 0)
    {
        //
        $request = new Request;
        if ($request->isMethod('get')){
            $result = DB::table('con_tasksconfigures')
                ->where('config_id',$id)
                ->first();
            return view("Tasks.configedit",['result'=>$result]);
        }else{
//
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id = 0)
    {
        //
        $data = $this->data();
//            dump($data);
            $a['config_name'] = $data['config_name'];
            $a['config_config'] = $data['config_config'];
            $a['config_images'] = $data['config_images'];
//        die;
        $result = DB::table('con_tasksconfigures')
            ->where('config_id', $data['config_id'])
            ->update($a);
//        dump($result);
        if($result){
            return redirect()->route('configIndex');
        }else{
            $msg = "添加失败";
            return redirect()->route('configEdit',['id'=>$data['config_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id = 0)
    {
        //
        $id = $request->input('id');
//        dump($id);
        $result = DB::table('con_tasksconfigures')
            ->where('config_id',$id)
            ->delete();
        if ($result){
            return ['msg'=>'成功','error'=>true];
        }else{
            return ['msg'=>'失败','error'=>false];
        }
    }
}
