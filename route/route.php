<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\facade\Route;

Route::post(':version/token','api/:version.token/token');  //生成access_token

Route::get(':version/address/:id','api/:version.user/address');  //一般路由规则，
//
Route::resource(':version/user','api/:version.user');       //资源路由

Route::resource(':version/car/data', 'api/:version.CarDataRest');
Route::resource(':version/car/image', 'api/:version.CarImageRest');

Route::controller(':version/notoken/car', 'api/:version.GetData');
//所有路由匹配不到情况下触发该路由
Route::miss('\app\api\controller\Exception::miss');
