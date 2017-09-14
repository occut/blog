<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Index/index');
    }
    public function indexPage(){
        //用户
        $user = DB::table('con_users')
            ->get()->toArray();
        //任务
        $tasks = DB::table('con_taskscontents')
            ->get()->toArray();
        //资源总数con_equipments
        $uploads = DB::table('con_uploads')
            ->get()->toArray();
        //设备总数
        $equipments = DB::table('con_equipments')
            ->get()->toArray();
        //配置总数
        $tasksconfigures = DB::table('con_tasksconfigures')
            ->get()->toArray();
        //分组总数
        $tasksgroups = DB::table('con_tasksgroups')
            ->get()->toArray();
        return view('Index/indexPage',[
            'user'=>count($user),
            'tasks'=>count($tasks),
            'uploads'=>count($uploads),
            'equipments'=>count($equipments),
            'tasksconfigures'=>count($tasksconfigures),
            'tasksgroups'=>count($tasksgroups),
            ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
