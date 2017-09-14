<?php

namespace App\Http\Controllers\User;

use App\con_role;
use App\con_user;
use App\Functions\LogAction;
use App\Http\Controllers\Controller;
use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        View::share('ban', [User::BAN_NO=>'正常', User::BAN_YES=>'禁止']);
    }
    public function index()
    {
        $user = new User();
        $content = $user::orderBy('user_id','desc')
            ->paginate(15);
        return view('User/adminUserList', ['content'=>$content]);
    }
    public function Ban(Request $request,$user_id = 0){
        $id = $request->input('id');
        $user = User::find($id);
        if($user->ban == User::BAN_NO) {
            $user->ban = User::BAN_YES;
        }else{
            $user->ban = User::BAN_NO;
        }
        $row = $user->save();
        if($row) {
            LogAction::logAction("操作成功[".$user_id."]");
            return ['code'=>0, 'msg'=>'操作成功', 'data'=>[]];
        }
        return ['code'=>1, 'msg'=>'操作失败', 'data'=>[]];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $user = User::find($id);
        return view('User/create', ['user'=>$user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //添加用户
        if($request->isMethod('post')){
            // 要执行的代码
            $data = $request->all();
            $data = LogAction::data($data);
            $user = new User();
            $content = $user->where('username', $data['adminName'])->first();
            if(!empty($content)){
                return ['msg'=>'用户名已存在'];
            }
            $user->username = $data['adminName'];
            $user->password = bcrypt($data['password']);
            $user->adminRole = $data['adminRole'];
            $value = $user->save();
            if($value){
                LogAction::logAction("新增用户[".$data['adminName']."]成功");
                return redirect()->route('userindex');
            }else{
                LogAction::logAction("新增用户[".$data['adminName']."]失败");
                return false;
            }
        }else{
            return view('User/adduser');
        }

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
    public function edit(Request $request,$id = 0)
    {
        //
        $username = $request->input('username');
        $password = $request->input('password');
        $user = new User();
        $content = $user->where('username', $username)->first();
        if(!empty($content)){
            return ['msg'=>'用户名已存在'];
        }
        $user->username = $username;
        $user->password = bcrypt($password);
        $value = $user->save();
        if($value){
            LogAction::logAction("新增用户[".$username."]成功");
            return ['msg'=>"新增用户[".$username."]",'error'=>true];
        }else{
            LogAction::logAction("新增用户[".$username."]失败");
            return ['msg'=>"新增用户[".$username."]",'error'=>false];
        }
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
        $user_id = $request->get('user_id',null);
        $password = $request->get('password',null);
        $user = User::find($user_id);
        $user->password = bcrypt($password);
        $name['user_id'] = $user_id;
        $password1['password'] = bcrypt($password);
        $msg = $user->where($name)->update($password1);
        if($msg){
            return ['msg'=>'修改成功','error'=>true];
        }else{
            return ['msg'=>'修改失败','errot'=>false];
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
       $user_id = $request->get('id');

       //执行软删除
       $value = User::where('user_id',$user_id)->delete();
        if($value){
            return "true";
//            return ['msg'=>'成功','error'=>true];
        }else{
            return "false";
//            return ['msg'=>'失败','error'=>false];
        }
    }
    public function roles($user_id){
        $myRole  = UserRole::where('user_id',$user_id)->pluck('role_id')->toArray();
        $roleIds =  implode(',',$myRole);
        $result = con_role::select('role_id','pid','rolename as name')->get()->map(function ($v,$k) use(&$myRole) {
            $v->open = true;
            $v->checked = in_array($v->role_id,$myRole);
            return $v;
        })->toJSON();
        return view('User.roles')->with('user_id',$user_id)->with('roleIds',$roleIds)->with('result',$result);
    }

    public function rolesPost(Request $request,$user_id){
        //处理post请求
        $roleIds = $this->filterId($request->get('role_id',0));
        if(!count($roleIds)) {
            return $this->error('请勾选节点');
        }
        UserRole::where('user_id',$user_id)->forceDelete();
        array_map(function($role_id) use($user_id) {
            UserRole::insert(['role_id'=>$role_id,'user_id'=>$user_id]);
        },$roleIds);
        LogAction::logAction($user_id);
        return $this->success(route('userindex'));
    }
}
