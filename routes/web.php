<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'Login'], function () {
    //登录
    Route::get('login','LoginController@login')->name("login");
    Route::post('verification','LoginController@verification')->name('verification');
    Route::get('quit','LoginController@quit');
});

Route::group(['middleware' => ['CheckAge'],'namespace' => 'Index'], function () {
    //首页
    Route::get('index','IndexController@index')->name('index');
    //首页
    Route::get('indexPage','IndexController@indexPage');
    //用户列表
    Route::get('adminUserList','IndexController@adminUserList');
});
//用户管理
Route::group(['middleware' => ['CheckAge'],'namespace' => 'User'], function () {
    //用户列表
    Route::get('adminUserList','UserController@index')->name('userindex');
    //添加用户
    Route::any('userstore/{id?}','UserController@store')->name('userstore');
    //更新状态
    Route::post('ban/{id?}','UserController@Ban')->name('ban');
    //修改用户密码
    Route::get('create/{id?}','UserController@create');
    //保存用户
    Route::post('useredit/{id?}','UserController@edit')->name('useredit');
    //删除角色
    Route::post('destroy/{id?}','UserController@destroy')->name('namedestroy');
    //接收更改用户密码
    Route::post('update/{id?}','UserController@update')->name('update');
    Route::get('userroles/{id?}','UserController@roles')->name('userroles');
    Route::post('userrolespost/{id?}','UserController@rolesPost')->name('userrolespost');
    //角色列表
    Route::get('rolsIndex','RolesController@index')->name('rolsindex');
    //添加角色
    Route::any('rolsCreate/{id?}','RolesController@create')->name('rolsCreate');
    //保存角色
    Route::post('rolsstore/{id?}','RolesController@store')->name('rolsstore');
    //删除角色
    Route::any('rolsdestroy/{id?}','RolesController@destroy')->name('rolsdestroy');
    //节点管理
    Route::get('nodeindex','NodeController@index')->name('nodeIndex');
    //添加节点
    Route::get('nodeCreate/{id?}','NodeController@create')->name('nodeCreate');
    //保存节点
    Route::post('nodestores','NodeController@store')->name('nodestores');
    //编辑节点
    Route::get('nodeedit/{id?}','NodeController@edit')->name('nodeedit');
    //更新状态
    Route::post('nodestore','NodeController@nodeStore')->name('nodestore');
    //更新保存节点
    Route::get('nodeupdate/{id?}','NodeController@update')->name('nodeupdate');
    //删除
    Route::get('nodedel/{id?}','NodeController@destroy')->name('nodedel');
    //角色与节点关联
    Route::get('roleweight/{id?}','NodeController@weight')->name('roleweight');
    //保存角色与节点关联
    Route::post('roleuweightpost/{id?}','NodeController@weightPost')->name('roleuweightpost');
});
//分组任务设备配置
Route::group(['middleware' => ['CheckAge'],'namespace' => 'Tasks'], function () {
    //分组首页
    Route::get('tasksIndex/{msg?}','TasksController@index')->name('tasksIndex');
    //添加分组
    Route::any('tasksCreate','TasksController@create')->name('tasksCreate');
    //编辑分组
    Route::any('tasksedit/{id?}','TasksController@edit')->name('tasksedit');
    //删除分组
    Route::any('tasksDel/{id?}','TasksController@destroy')->name('tasksDel');
    //删除设备
    Route::any('showdel/{id?}','TasksController@showdel')->name('showdel');
    //显示设备
    Route::any('tasksShow/{id?}','TasksController@show')->name('tasksShow');
    //显示配置项
    Route::get("configIndex/{id?}","TasksconfigureController@index")->name('configIndex');
    //添加配置项
    Route::any("configCreate","TasksconfigureController@create")->name('configCreate');
    //编辑配置项
    Route::get("configEdit/{id?}","TasksconfigureController@edit")->name('configEdit');
    //保存配置信息
    Route::post("configUpdate/{id?}","TasksconfigureController@update")->name('configUpdate');
    //删除配置项
    Route::post("configdestroy/{id?}","TasksconfigureController@destroy")->name('configdestroy');
    //任务首页
    Route::get("contentIndex/{id?}","TaskscontentController@index")->name('contentIndex');
    //更改任务状态
    Route::post("contentState/{id?}","TaskscontentController@state")->name('contentState');
    //添加任务
    Route::any("contentCreate/{id?}","TaskscontentController@create")->name('contentCreate');
    //AJAX数据获取
    Route::post("getConfigs/{id?}","TaskscontentController@getConfigs")->name('getConfigs');
    //编辑任务
    Route::any("contentEdit/{id?}","TaskscontentController@edit")->name('contentEdit');
    //AJAX获取编辑数据
    Route::post("editConfigs/{id?}","TaskscontentController@editConfigs")->name('editConfigs');
//    Route::get('tasksStore','TasksController@store')->name('tasksStore');
});
//账户管理
Route::group(['middleware' => ['CheckAge'],'namespace' => 'Account'],function(){
    //WeChat首页
    Route::get('accountIndex/{msg?}','AccountController@index')->name('accountIndex');
    //添加WeChat账户
    Route::any('accountCreate/{msg?}','AccountController@create')->name('accountCreate');
    //编辑wechat账户
    Route::any('accountEdit/{msg?}','AccountController@edit')->name('accountEdit');
    Route::any('accountdestroy/{msg?}','AccountController@destroy')->name('accountdestroy');
    //ID card首页
    Route::any('idcardIndex/{msg?}','IdcardController@index')->name('idcardIndex');
    //ID card添加
    Route::any('idcardCreate/{msg?}','IdcardController@create')->name('idcardCreate');
    Route::any('idcarddestroy/{msg?}','IdcardController@destroy')->name('idcarddestroy');
    //小号管理
    Route::get('smallindex/{id?}','SmallController@index')->name('smallindex');
    //状态
    Route::post('smallstata/{id?}','SmallController@stata')->name('smallstata');
    //删除
    Route::post('smallDel/{id?}','SmallController@destroy')->name('smallDel');
    //添加
    Route::any('smallCreate/{id?}','SmallController@create')->name('smallCreate');
    Route::any('txtcreate/{id?}','SmallController@txtcreate')->name('txtcreate');
});
//资源管理
Route::group(['middleware' => ['CheckAge'],'namespace' => 'Resources'],function(){
    //WeChat首页
    Route::get('resourcesIndex/{msg?}','ResourcesController@index')->name('resourcesIndex');
    //添加图片
    Route::get('resourcesCreate/{msg?}','ResourcesController@create')->name('resourcesCreate');
    //图片上传类
    Route::post('resourcesUplode/{msg?}','ResourcesController@uplode')->name('resourcesUplode');
    //保存图片上传
    Route::post('resourcesStore/{msg?}','ResourcesController@store')->name('resourcesStore');
});
//接口
Route::group(['namespace' => 'Api'],function(){
    //存储106账号
    Route::get('apismallscreate/{msg?}','ApiController@smalls')->name('apismallscreate');
    //取回账号
    Route::get('redsmalls/{msg?}','ApiController@redsmalls')->name('redsmalls');
    Route::get('smallsstata/{msg?}','ApiController@smallsstata')->name('smallsstata');
    Route::get('smalldata/{msg?}','ApiController@smalldata')->name('smalldata');
    Route::get('smallmoney/{msg?}','ApiController@smallmoney')->name('smallmoney');
});