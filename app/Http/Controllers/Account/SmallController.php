<?php

namespace App\Http\Controllers\Account;

use App\con_small;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect, Input, Response;

class SmallController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $value = $request->input('small_state');
//        print_r($value);
        if(empty($value)){
            $result = DB::table('con_smalls')
                ->paginate(500);
            $num = DB::table('con_smalls')
                ->get();
            $num = count($num);
        }else{
            if($value == '正常'){

                $a = 0;
            }else{
                $a = 1;
            }
            $result = DB::table('con_smalls')
                ->where('small_state',$a)
                ->paginate(500);
            $num = DB::table('con_smalls')
                ->where('small_state',$a)
                ->get();
            $num = count($num);
        }

//        print_r($num);
        return view('Account.smallindex',['result'=>$result,'num'=>$num,'value'=>$value]);
    }

    /**
     * 状态
     */
    public function stata(Request $request){
        $stata = $request->all();
        $small_id = $request->input('small_id');
        $small_state = $request->input('stata');
        $result = DB::table('con_smalls')
            ->where('small_id',$small_id)
            ->update(['small_state' => $small_state]);
        if ($result){
            return ['msg'=>'成功','error'=>true];
        }else{
            return ['msg'=>'失败','error'=>false];
        }
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
            //添加微信账号
            return view('Account.smallCreate');
        }else{
            $data = $this->data();
            $result = preg_split('/[;\r\n]+/s',$data['desc']);
            if(!empty($data['desc'])){
                foreach ($result as $vo) {
                    $value = explode("----", $vo);
//                    dump($value);
                    $name = $value[0];
                    $result = DB::table('con_smalls')
                        ->where('small_name', $name)
                        ->first();
                    if (empty($result)) {
                        $con_account = new con_small;
                        $con_account->small_name = $value[0];
                        $con_account->small_password = $value[1];
                        $data = $con_account->save();

                    }
                }
//                die;
                if ($data) {
                    $msg = "添加成功";
                    return redirect()->route('smallindex');
                } else {
                    $msg = "添加失败";
                    return view("Account.smallCreate", ['msg' => $msg]);
                }
            }
            $msg = "账号已重复";
            return view("Account.smallCreate",['msg'=>$msg]);
        }
        $msg = "添加内容为空";
        return view("Account.smallCreate",['msg'=>$msg]);
    }
    //txt添加

    /**
     * @param Request $request
     * @return array
     */
    public function txtcreate(Request $request){
        $file = \Illuminate\Support\Facades\Input::file('file');
        $id = \Illuminate\Support\Facades\Input::get('id');
        $allowed_extensions = ["txt"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['msg' => 'You may only upload png, txt.'];
        }
        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = $file -> getClientOriginalName();
//        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        $aa = './'.$destinationPath.$fileName;
        $content = file_get_contents($aa);
        $result = preg_split('/[;\r\n]+/s',$content);
            foreach ($result as $vo) {
                $value = explode("----", $vo);
//                    dump($value);
                $name = $value[0];
                $result = DB::table('con_smalls')
                    ->where('small_name', $name)
                    ->first();
                if (empty($result)) {
                    if(!empty($value[1])){
                        $con_account = new con_small;
                        $con_account->small_name = $value[0];
                        $con_account->small_password = $value[1];
                        $data = $con_account->save();
                    }
                }
            }
        unlink($aa);
        return Response::json(
            [
                'msg' => "添加成功",
                'success' => true,
                'pic' => asset($destinationPath.$fileName),
                'id' => $id
            ]
        );
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
    public function destroy(Request $request,$id = 0)
    {
        //
        $id = $request->input('id');
//        $ids = $request->all();
//        dump($ids);
        if(is_array($id)){
            foreach ($id as $vo){
                $result = DB::table('con_smalls')
                    ->where('small_id',$vo)
                    ->delete();
            }
        }else{
            $result = DB::table('con_smalls')
                ->where('small_id',$id)
                ->delete();
        }

        if ($result){
            return ['msg'=>'成功','error'=>true];
        }else{
            return ['msg'=>'失败','error'=>false];
        }
    }
}
