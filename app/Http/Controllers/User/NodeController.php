<?php

namespace App\Http\Controllers\User;

use App\ClassLib\Category;
use App\con_node;
use App\Functions\LogAction;
use App\Http\Controllers\Controller;
use App\RoleNode;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Response;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rbacNode = con_node::orderBy('node_id','asc');
        $result = $rbacNode->get()->toArray();
        $result = Category::child($result,0,'node_id','pid');
//        var_dump($result);
//        die;
        return view('Node.index')->with('result',$result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($node_id=0)
    {
        //
        $nodename = null;
        if($node_id > 0) {
            $nodename = con_node::where('node_id',$node_id)->value('nodename');
            if(is_null($nodename)) {
                return $this->error('id错误');
            }
        }

        return view('Node.create')->with('nodename',$nodename)->with('pid',$node_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->data();
//        dump($data);
//        die;
        if(isset($data['url'])) {
            $data['url'] = rtrim($data['url'],'/');
        }
//        $validator = Validator::make($data,[
//            'nodename' => 'required',
//            'auth'     => 'auth',
//            'pid'      => 'nullable|integer|exists:rbac_node,node_id',
//        ],[
//            'nodename.required' => '请填写节点名',
//            'auth.auth'         => '请填写正确的权值',
//            'pid.integer'       => 'pid错误',
//            'pid.exists'        => 'pid错误',
//        ]);
//        if($validator->fails()) {
//            return $this->error($validator);
//        }
        $data['pid'] = isset($data['pid'])?$data['pid']:0;
        $node = con_node::insertGetId($data);
        if ($node){
//            RbacLog::logIds($node);
            LogAction::logAction('用户【'.$node.'】登录成功');
            return $this->success(route('nodeIndex'));
//            return 1;
        }
        return $this->error('新增错误！');
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
    public function edit($node_id)
    {
//        var_dump($node_id);
//        die;
        $result = con_node::find($node_id);
//        var_dump($result);
//        die;
        if(!$result) {
            return $this->error('id错误');
        }
        $con_node = con_node::orderBy('sortid','asc');
        $node = $con_node->get()->toArray();
        $node = Category::one($node,0,'pid','node_id');
//        var_dump($node);
//        die;
        return view('Node.edit')->with('result',$result)->with('node',$node);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $node_id
     * @return \Illuminate\Http\Response
     * @internal param Request $request
     * @internal param int $id
     */
    public function update($node_id = 0)
    {
//        var_dump(123);
//        die;
        $data = $this->data();
        if(isset($data['url'])) {
            $data['url'] = rtrim($data['url'],'/');
        }
//        $validator = Validator::make($data,[
//            'nodename' => 'required',
//            'auth'     => 'auth',
//        ],[
//            'rolename.required' => '请填写节点名',
//            'auth.auth'         => '请填写正确的权值',
//        ]);
//        if($validator->fails()) {
//            return $this->error($validator);
//        }

        $row = con_node::where('node_id',$node_id)->update($data);
        if($row) {
//            RbacLog::logIds($node_id);
            LogAction::logAction($node_id);

            return $this->success(route('nodeIndex'));
        }
        return $this->error('操作失败');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($node_id=null)
    {
        if(empty($node_id)) {
            $node_id = $this->data('id', '');
        }
        $id = $this->filterId($node_id);
        if(empty($id)) {
//            return Response::json(['msg'=>'id错误','code'=>1]);
        }
        //收集被删除的node_id
        $nodeIds = [];

        //遍历删除数据
        con_node::whereIn('node_id',$id)->get()->map(function ($node,$key) use(&$nodeIds) {
            if(!con_node::where('pid',$node->node_id)->first()) { //验证是否有子级
                $nodeIds[] = $node->node_id;
                LogAction::logAction($node->node_id);
                $node->forceDelete();
                RoleNode::where('node_id',$node->node_id)->forceDelete();
            }
        });
        return redirect()->route('nodeIndex');
    }

    public function weight($role_id){
        //渲染模板
        $myNode  = RoleNode::where('role_id',$role_id)->pluck('node_id')->toArray();
        $nodeIds =  implode(',',$myNode);
        $result = con_node::select('node_id','pid','nodename as name', 'auth')->orderBy('sortid', 'asc')->get()->map(function ($v,$k) use(&$myNode) {
            $v->open = true;
            $v->checked = in_array($v->node_id,$myNode);
//                $v->chkDisabled = RbacNode::isExceptAuth($v->auth);
            return $v;
        })->toJSON();
        return view('Roles.weight')->with('role_id',$role_id)->with('nodeIds',$nodeIds)->with('result',$result);
//
    }

    public function weightPost(Request $request,$role_id){
        //处理post请求
        $nodeIds = $this->filterId($request->get('node_id',0));

        if(!count($nodeIds)) {
            return $this->error('请勾选节点');
        }

        RoleNode::where('role_id',$role_id)->forceDelete();

        array_map(function($node_id) use($role_id) {

            RoleNode::insert(['node_id'=>$node_id,'role_id'=>$role_id]);

        },$nodeIds);



        LogAction::logAction($role_id);

        return $this->success(route('rolsindex'));
    }

    public function nodeStore(Request $request){
        $value = $request->input('id');
        $ids = $request->input('ids');
//        dump($ids == "true");
        if($ids == "true"){
            $ids = 1;
        }else{
            $ids = 2;
        }

//        dump($ids);
        con_node::where('node_id', $value)
            ->update(['nav'=> $ids]);



    }
}
