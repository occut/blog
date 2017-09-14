<?php

namespace App\Http\Middleware;

use App\con_node;
use App\Node;
use App\RoleNode;
use App\User;
use App\UserRole;
use Closure;
use Route;
use Illuminate\Support\Facades\Session;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty($request->session()->get('user'))){
            return redirect()->route('login');
        }
        if(Session::get('user')['user_id'] !== 1){
//            var_dump(Session::get('user')['user_id']);
//            die;
            if(self::hasAuth(Session::get('user')['user_id']) === false) {
                return redirect()->route('error');
            }
        }
//        $auth = Route::current()->getActionName();
//        dump($auth);
        return $next($request);
    }
    protected static function hasAuth($user_id)
    {
        $auth = Route::current()->getActionName();
//        dump($auth);
//        die;
        if(con_node::isExceptAuth($auth)) return true;
        $nodeID = con_node::where('auth', $auth)->pluck('node_id');
        if(is_null($nodeID)) return false;
        $nodeRoleIds = RoleNode::where('node_id',$nodeID)->pluck('role_id');
        if($nodeRoleIds->count() == 0) return false;
//        var_dump($user_id);
//        die;
        $userRoleIds = UserRole::where('user_id',$user_id)->pluck('role_id');
//        var_dump($userRoleIds);
//        die;
        if($userRoleIds->count() == 0) return false;
        $intersect = $nodeRoleIds->intersect($userRoleIds);
        if($intersect->count()) {
            return true;
        }
        return false;
    }
}
