<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

header('Access-Control-Allow-Origin: http://localhost:8080');
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type, authorization');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function(Request $request){return json_encode(["status"=>true]);});

Route::get('/groups', "Admin\GroupController@list");

Route::post('/register', "RegisterController@registerUser");
Route::post('/login', "LoginController@login");

Route::get('/access_error', "UserController@accessError")->name('access_error');

Route::middleware('auth:api')->group(function(){
    Route::get('/user/access_level', "UserController@getUserAccessLevel");
    Route::get('/user/userdata', "UserController@getAllUserData");
    Route::get('/user/logout', "UserController@logout");
});

Route::middleware('auth:api')->get('/user', function(Request $request){
    return $request->user();
});

