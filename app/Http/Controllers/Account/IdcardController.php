<?php

namespace App\Http\Controllers\Account;

use App\con_idcard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IdcardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($msg = 0)
    {
        //idcard首页
        $result = DB::table('con_idcard')
//            ->where('admin_id',Session::get('user')['user_id'])
            ->paginate(500);
        $num = DB::table('con_idcard')
            ->get();
        $num = count($num);
        return view("Account.accountIndex",['result'=>$result,'msg'=>$msg,'num'=>$num]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //idcareate添加
        if ($request->isMethod('get')) {
            //添加微信账号
            return view('Account.idcardCreate');
        }else{
            $data = $this->data();

            $result = preg_split('/[;\r\n]+/s',$data['desc']);
            if(!empty($data['desc'])){
                foreach ($result as $vo) {
                    $value = explode("----", $vo);
                    $card_name = $value[0];
                    $result = DB::table('con_idcard')
                        ->where('card_name', $card_name)
                        ->first();
                    if (empty($result)) {
                        $con_account = new con_idcard();
                        $con_account->card_name = $value[0];
                        $con_account->	card_number = $value[1];
                        $con_account->admin_id = Session::get('user')['user_id'];
                        $data = $con_account->save();
                    }
                }
                if ($data) {
                    $msg = "添加成功";
                    return redirect()->route('idcardIndex', ['msg' => $msg]);
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
    public function destroy(Request $request,$id=0)
    {
        //
        $id = $request->input('id');
//        dump($id);
        if(is_array($id)){
            foreach ($id as $vo){
                $result = DB::table('con_idcard')
                    ->where('card_id',$vo)
                    ->delete();
            }
        }else{
            $result = DB::table('con_idcard')
                ->where('card_id',$id)
                ->delete();
        }

        if ($result){
            return ['msg'=>'成功','error'=>true];
        }else{
            return ['msg'=>'失败','error'=>false];
        }
    }
}
