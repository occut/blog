<?php

namespace App\Http\Controllers\Tasks;

use App\con_equipment;
use App\con_taskscontent;
use App\con_tasksgroup;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($msg = 0)
    {
        //
        $tasksgroup = con_tasksgroup::orderBy('tasks_id','asc');
        $result = $tasksgroup->get();
//        var_dump($result);
//        die;
//        $result = Category::child($result,0,'node_id','pid');
        return view('Tasks.index',['result'=>$result,'msg'=>$msg]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //createTasks
        $method = $request->method();
        if ($request->isMethod('get')) {
            return view("Tasks.create");
        }else{
            $data = $this->data();
            $flight = con_tasksgroup::where('tasksgroup_name',$data['tasks_name'])->first();
            if(empty($flight)){
                $tasksgroup = new con_tasksgroup();
                $tasksgroup->tasksgroup_name = $data['tasks_name'];
                $tasksgroup->admin_id = Session::get('user')['user_id'];
                $a = $tasksgroup->save();
            }
            $tasks_id = $flight->tasks_id;
            $eq = new con_equipment();
            $array = explode(',',$data['equipments']);
            con_equipment::where('tasks_id',$tasks_id)->delete();
            $con = '';
            foreach ($array as $vo){
                if(!empty($vo)){
                    $con =con_equipment::insert(['equipments'=>$vo,'tasks_id'=>$tasks_id]);
                }
            }
            if($con){
                $msg = "添加成功";
                return redirect()->route('tasksIndex', ['msg' => $msg]);
            }else{
                $msg = "添加失败";
                return view("Tasks.create",['msg'=>$msg]);
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
    public function show($id = 0)
    {
        //equipments
        $result1 = DB::table('con_tasksgroups')
            ->where('admin_id',Session::get('user')['user_id'])
            ->join('con_equipments', 'con_tasksgroups.tasks_id', '=', 'con_equipments.tasks_id')
            ->select('con_equipments.*', 'con_tasksgroups.tasksgroup_name')
            ->get();
        return view('Tasks.equipmentsshow',['result'=>$result1]);

    }

    public function showdel(Request $request){
        $value = $request->input('id');
        $result = DB::table('con_equipments')
            ->where('eq_id',$value)
            ->delete();
        if ($result){
            return ['msg'=>'成功','error'=>true];
        }else{
            return ['msg'=>'失败','error'=>false];
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id = 0)
    {
        //
        if ($request->isMethod('get')) {
            $tasksgroup = con_tasksgroup::where('tasks_id', $id)->first();
            $equipment = con_equipment::where('tasks_id', $id)->get()->toArray();
            $con = '';
//        dump($tasksgroup);
            foreach ($equipment as $vo) {
                $con .= $vo['equipments'] . ",";
            }
            return view('Tasks.tasksedit', ['tasksgroup' => $tasksgroup, 'equipment' => $con]);
        }else{
            echo 123;
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
        //
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
//        $id = $request->all();
//        dump($id);die;
        $id = $request->input('id');
//        dump($id);
        $result = DB::table('con_tasksgroups')
            ->where('tasks_id',$id)
            ->delete();
          DB::table('con_equipments')
             ->where('tasks_id',$id)
             ->delete();
        if ($result){
            return ['msg'=>'成功','error'=>true];
        }else{
            return ['msg'=>'失败','error'=>false];
        }
    }
}
