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
Route::get('/groups/single/{id}', "Admin\GroupController@singleGroupData");

Route::post('/register', "RegisterController@registerUser");
Route::post('/login', "LoginController@login");

Route::get('/access_error', "Admin\UserController@accessError")->name('access_error');

Route::post('upload/image', 'FileController@uploadImage');

Route::middleware(['auth:api', 'isOnline'])->group(function(){
    // Users
    Route::get('/user/access_level', "Admin\UserController@getUserAccessLevel");
    Route::get('/user/userdata', "Admin\UserController@getAllUserData");
    Route::get('/user/logout', "Admin\UserController@logout");
    Route::get('/user/group', "Admin\UserController@getGroup");
    
    Route::get('/education/courses/fulldata/{courseId}', "Admin\Education\CourseController@getFullData");
    
    // Courses
    Route::get('/education/courses', "Admin\Education\CourseController@list");
    Route::get('/education/courses/progress', 'Admin\Education\CourseController@generalProgress');
    Route::get('/education/course/{id}', 'Admin\Education\CourseController@getSingleItem');
    Route::get('/education/course/{id}/themes', 'Admin\Education\ThemeController@list');

    // Themes
    Route::get('/education/theme/{id}', 'Admin\Education\ThemeController@getSingleItem');
    
    // Tasks
    Route::get('/education/tasks/list/{id}', 'Admin\Education\TaskController@list');
    Route::get('/education/task/{id}', 'Admin\Education\TaskController@getSingleTask');
    Route::post('/study/task/complete', 'Dashboard\UserTaskController@complete');

    // Works
    Route::get('/study/activity/{count?}', 'Dashboard\UserTaskController@activity');

    //Settings
    Route::post('/settings/password', 'Admin\UserController@changePassword');
    Route::post('/settings/email', 'Admin\UserController@changeEmail');

    // Admin rights required
    Route::middleware('admin')->group(function(){ 
        // Users
        Route::get('/user/data/count/{type}', "Admin\UserController@count");
        Route::get('/user/data/list/{count?}', "Admin\UserController@list");
        Route::delete('/user/delete/{id}', 'Admin\UserController@delete');
        Route::put('/users/confirm/{id}', 'Admin\UserController@confirm');
        Route::put('/users/access/{id}', 'Admin\UserController@change');

        // Gropus
        Route::get('/groups/list', "Admin\GroupController@list");
        Route::get('/groups/{id}/students', "Admin\GroupController@getAllStudents");
        Route::post('/groups/create', 'Admin\GroupController@create');
        Route::delete('/groups/delete/{id}', 'Admin\GroupController@delete');
        Route::put('/groups/update/{id}', 'Admin\GroupController@update'); 
        Route::put('/groups/setup/{id}', 'Admin\GroupController@setup');

        //Courses
        Route::post('/education/course/create', 'Admin\Education\CourseController@create');
        Route::delete('/education/course/delete/{id}', 'Admin\Education\CourseController@delete');
        Route::put('/education/course/update/{id}', 'Admin\Education\CourseController@update');

        //Themes
        Route::get('/education/theme/access/{id}', 'Admin\AccessabilityController@getGroupAccess');
        Route::post('/education/theme/create', 'Admin\Education\ThemeController@create');
        Route::delete('/education/theme/delete/{id}', 'Admin\Education\ThemeController@delete');
        Route::put('/education/theme/update/{id}', 'Admin\Education\ThemeController@update');
        Route::post('/education/theme/grant-access', 'Admin\AccessabilityController@create');

        //Tasks
        Route::delete('/education/task/delete/{id}', 'Admin\Education\TaskController@delete');
        Route::post('/education/task/create', 'Admin\Education\TaskController@create');
        Route::put('/education/task/update/{id}', 'Admin\Education\TaskController@update');

        //Check
        Route::get('/works/get/{courseId}/{groupId}/{userId?}', 'Dashboard\UserTaskController@getWorksToCheck');
        Route::get('/works/get/{id}', 'Dashboard\UserTaskController@single');
        Route::put('/admin/check/complete/{id}', 'Dashboard\UserTaskController@check');
        Route::delete('/admin/check/reject/{id}', 'Dashboard\UserTaskController@reject');
    });

});

//Route::get('/user/data', "UserController@list")->middleware('admin');

// Route::middleware('auth:api')->get('/user', function(Request $request){
//     return $request->user();
// });

