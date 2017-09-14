<?php

namespace App\Http\Controllers\Api;

use App\con_idcard;
use App\con_small;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    //
    public function smalls(Request $request){
        $value = $request->all();
        $username = $request->input('name');
        $password = $request->input('password');
        $con_small = new con_small;
        $con_small->small_name = $username;
        $con_small->small_password = $password;
        $value = $con_small->save();
        if($value){
            return 1;
        }else{
            return 0;
        }
    }

    public function redsmalls(){
        $result = DB::table('con_smalls')
            ->where('small_state',0)
            ->first();
//        dump($result);

        if(empty($result)){
            return 0;
        }else{
            DB::table('con_smalls')
                ->where('small_id',$result->small_id)
                ->update(['small_state' => 1]);
            return $result->small_id.'|'.$result->small_name.'|'.$result->small_password;
        }

    }

    //更新状态
    public function smallsstata(Request $request){
        $stata = $request->input('stata');
        $small_id = $request->input('small_id');
        DB::table('con_smalls')
            ->where('small_id',$small_id)
            ->update(['small_state' => $stata]);
    }
    //更新账号备注
    public function smalldata(Request $request){
        $stata = $request->input('stata');
        $small_id = $request->input('small_id');
        $small_data = $request->input('small_data');
        DB::table('con_smalls')
            ->where('small_id',$small_id)
            ->update(['small_state' => $stata,'small_data'=>$small_data]);
    }

    public function smallmoney(Request $request){
        $username = $request->input('name');
        $password = $request->input('password');
        $data = $request->input('data');
        $con_account = new con_idcard;
        $con_account->card_name = $username;
        $con_account->card_number = $password;
        $con_account->card_state = $data;
//        $con_account->admin_id = Session::get('user')['user_id'];
        $data = $con_account->save();
    }
}
