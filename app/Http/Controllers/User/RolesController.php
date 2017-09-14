<?php

namespace App\Http\Controllers\User;

use App\ClassLib\Category;
use App\con_node;
use App\kai_role;
use App\Functions\LogAction;
use App\Http\Controllers\Controller;
use App\RoleNode;
use App\UserRole;
use Illuminate\Http\Request;
use PhpParser\Node;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //首页
        $con_role = kai_role::orderBy('created_at', 'desc');
        $result = $con_role->get();
        return view('Roles/index', ['content'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     * @param int $role_id
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //添加角色
        if($request->isMethod('post')){
            $role = new kai_role();
            $role->rolename = $request->get('roleName');
            $role->pid = $request->get('pid',0);
            $result = $role->save();
            if($result){
                LogAction::logAction("新增角色[".$request->get('roleName')."]成功");
                return redirect()->route('rolsindex');
            }else{
                return redirect()->route('rolsindex');
            }
        }else{
            return view('Roles/create');
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
    public function update(Request $request)
    {
        //
        $role = new RbacRole();
        $role->rolename = $request->get('rolename');
        $role->pid = $request->get('pid',0);
        $role->save();
        RbacLog::logIds($role->role_id);
        return $this->success(route('admin.roles'));
        return ['msg'=>'修改成功','error'=>true];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$ids = 1)
    {
        //        return ['msg'=>123];die;
        $id = $request->input('id');
//        dump($id);
//        die;
        if(empty($id)) {
            return ['msg'=>'id错误','error'=>false];
        }
        //收集被删除的 id
        //遍历删除数据
        $value = con_role::where('pid',$id)->get();
        $con = '';
        if(!empty($value)){
            $con = con_role::where('role_id',$id)->delete();
            RoleNode::where('role_id',$id)->delete();
            UserRole::where('role_id',$id)->delete();
        }
       if($con){
            return ['msg'=>'删除成功','error'=>true];
       }else{
           return ['msg'=>'删除失败','error'=>false];
       }



    }

}
