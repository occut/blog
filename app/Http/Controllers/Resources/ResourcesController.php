<?php

namespace App\Http\Controllers\Resources;

use App\con_upload;
use App\con_user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use YuanChao\Editor\EndaEditor;
use Redirect, Input, Response;

class ResourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //图片管理首页
        $result = DB::table('con_uploads')
            ->where('admin_id',Session::get('user')['user_id'])
            ->get();
//        print_r($result);

        return view("Resources.imageindex",['result'=>$result]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //添加图片
        return view("Resources.imagecreate");
    }
    public function uplode(Request $request){
        //上传图片
        $file = \Illuminate\Support\Facades\Input::file('file');
        $id = \Illuminate\Support\Facades\Input::get('id');
        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return ['msg' => 'You may only upload png, jpg or gif.'];
        }
        $destinationPath = 'uploads/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = $file -> getClientOriginalName();
//        $fileName = str_random(10).'.'.$extension;
        $file->move($destinationPath, $fileName);
        return Response::json(
            [
                'msg' => "上传成功",
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
        $value = $request->all();
        $str = strrpos($value['image'],'/');
        $a = substr($value['image'],$str+1);
        $name = explode('.',$a);
//        dump($name[0]);
//        dump($value['image']);
        $path = '/uploads/images/'.$a;
//        dump($path);
        $upload = new con_upload();
        $upload->up_path = $path;
        $upload->up_date = $name[0];
        $upload->admin_id = Session::get('user')['user_id'];
        $value = $upload->save();
        if($value){
            return ['msg'=>'图片保存成功','error'=>true];
        }else{
            return ['msg'=>'图片保存失败'];
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
