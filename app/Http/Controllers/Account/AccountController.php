<?php

namespace App\Http\Controllers\Account;

use App\con_account;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($msg = 0)
    {
        //wechat首页
        $result = DB::table('con_accounts')
            ->where('admin_id',Session::get('user')['user_id'])
            ->paginate(500);
        $num = DB::table('con_accounts')
            ->get();
        $num = count($num);
        return view('Account.index',['result'=>$result,'msg' => $msg,'num'=>$num]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('get')) {
            //添加微信账号
            return view('Account.create');
        }else{
            $data = $this->data();
            $result = preg_split('/[;\r\n]+/s',$data['desc']);
//            dump($result);
            if(!empty($data['desc'])){
                foreach ($result as $vo) {
                    $value = explode("----", $vo);
                    $name = $value[0];
                    dump($value);
                    $result = DB::table('con_accounts')
                        ->where('wechat_name', $name)
                        ->first();
                    if (empty($result)) {
                        $con_account = new con_account;
                        $con_account->wechat_name = $value[0];
                        $con_account->wechat_password = $value[1];
                        $con_account->wechat_data = $value[2];
                        $con_account->admin_id = Session::get('user')['user_id'];
                        $data = $con_account->save();
                    }
                }
                    if ($data) {
                        $msg = "添加成功";
                        return redirect()->route('accountIndex', ['msg' => $msg]);
                    } else {
                        $msg = "添加失败";
                        return view("Account.create", ['msg' => $msg]);

                }
            }
            $msg = "账号已重复";
            return view("Account.create",['msg'=>$msg]);
        }
        $msg = "添加内容为空";
        return view("Account.create",['msg'=>$msg]);
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
    public function edit(Request $request,$id = 0){
        //wechat编辑
        if ($request->isMethod('get')) {
            $result = DB::table('con_accounts')
                ->where('wechat_id',$id)
                ->first();
            return view('Account.edit',['result'=>$result]);
        }else{
            //保存编辑
            $data = $this->data();
            $a['wechat_password'] = $data['wechat_password'];
            $a['wechat_data'] = $data['wechat_data'];
            $a['wechat_Remarks'] = $data['wechat_Remarks'];
            $result = DB::table('con_accounts')
                ->where('wechat_id', $data['wechat_id'])
                ->update($a);
            var_dump($result);
            if ($result) {
                $msg = "编辑成功";
                return redirect()->route('accountIndex', ['msg' => $msg]);
            } else {
                return redirect()->route('accountEdit', ['id' =>$data['wechat_id']]);
            }
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
        $id = $request->input('id');
//        $ids = $request->all();
//        dump($ids);
        if(is_array($id)){
            foreach ($id as $vo){
                $result = DB::table('con_accounts')
                    ->where('wechat_id',$vo)
                    ->delete();
            }
        }else{
            $result = DB::table('con_accounts')
                ->where('wechat_id',$id)
                ->delete();
        }

        if ($result){
            return ['msg'=>'成功','error'=>true];
        }else{
            return ['msg'=>'失败','error'=>false];
        }
    }
}
