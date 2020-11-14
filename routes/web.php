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

Route::get('/', "HomeController@getHome")->name('main');
Route::get('/register/done', "AuthController@registerDone");
Route::get('/logout', "AuthController@logout");
Route::get('/access_error', "HomeController@getInfo")->name('access_error');

Route::post('/register', "AuthController@register");
Route::post('/login', "AuthController@login");

Route::middleware(['auth', 'admin'])->group(function(){
    /*Get*/
    
    Route::get('/admin/home', 'Admin\AdminController@getHome');

        /*@Groups*/

    Route::get('/admin/groups', 'Admin\AdminController@getGroupsMain');
    Route::get('/admin/groups/create', 'Admin\AdminController@getGroupsCreate');
    Route::get('/admin/groups/edit/{id}', 'Admin\AdminController@getGroupsEdit');
    Route::get('/admin/groups/manage/{id}', 'Admin\AdminController@getGroupsManage');

        /*@Education*/

    Route::get('/admin/education', 'Admin\AdminController@getEducationMain');
    Route::get('/admin/education/course/create', 'Admin\AdminController@getCreateCourse');
    Route::get('/admin/education/course/edit/{id}', 'Admin\AdminController@getEditCourse');
    Route::get('/admin/education/course/manage/{id}', 'Admin\AdminController@getCourseManage');
    Route::get('/admin/education/theme/create/{id}', 'Admin\AdminController@getCreateTheme');
    Route::get('/admin/education/theme/edit/{id}', 'Admin\AdminController@getEditTheme');
    Route::get('/admin/education/theme/manage/{id}', 'Admin\AdminController@getManageTheme');
    Route::get('/admin/education/task/create/{id}', 'Admin\AdminController@getCreateTask');
    Route::get('/admin/education/task/edit/{id}', 'Admin\AdminController@getEditTask');
    Route::get('/admin/education/task/view/{id}', 'Admin\AdminController@getViewTask');

        /*@Users*/

    Route::get('/admin/users/', 'Admin\AdminController@getUsersMain');

        /*@Check*/

    Route::get('/admin/check/', 'Admin\AdminController@getCheckMain');
    Route::get('/admin/check/{id}', 'Admin\AdminController@getCheckCourse');
    Route::get('/admin/check/{courseId}/task/{taskId}', 'Admin\AdminController@getCheckWorks');
    Route::get('/admin/check/work/{id}', 'Admin\AdminController@getConcreteWork');

    /*Create*/
        /*Groups*/
    Route::post('/admin/groups/create', 'Admin\GroupController@create');
        /*@Education*/
    Route::post('/admin/education/course/create', 'Admin\Education\CourseController@create');
    Route::post('/admin/education/theme/create', 'Admin\Education\ThemeController@create');
    Route::post('/admin/education/task/create', 'Admin\Education\TaskController@create');
    Route::post('/admin/education/theme/open', 'Admin\AccessabilityController@create');
    /*Update*/
        /*Groups*/
    Route::put('/admin/groups/update/{id}', 'Admin\GroupController@update');
    Route::put('/admin/groups/setup/{id}', 'Admin\GroupController@setup');
        /*@Education*/
    Route::put('/admin/education/course/update/{id}', 'Admin\Education\CourseController@update');
    Route::put('/admin/education/theme/update/{id}', 'Admin\Education\ThemeController@update');
    Route::put('/admin/education/task/update/{id}', 'Admin\Education\TaskController@update');
        /*@Users*/
    Route::put('/admin/users/access/{id}', 'Admin\UserController@change');
        /*Users*/
    Route::put('/admin/users/confirm/{id}', 'Admin\UserController@confirm');
        /*Check*/
    Route::put('/admin/check/complete/{id}', 'Dashboard\UserTaskController@check');
    /*Delete*/
        /*Groups*/
    Route::delete('/admin/groups/delete/{id}', 'Admin\GroupController@delete');
        /*Users*/
    Route::delete('/admin/users/delete/{id}', 'Admin\UserController@delete');
        /*Education*/
    Route::delete('admin/education/course/delete/{id}', 'Admin\Education\CourseController@delete');
    Route::delete('admin/education/theme/delete/{id}', 'Admin\Education\ThemeController@delete');
    Route::delete('admin/education/task/delete/{id}', 'Admin\Education\TaskController@delete');
        /*Check*/
    Route::delete('/admin/check/reject/{id}', 'Dashboard\UserTaskController@reject');

    /*Get data*/

    Route::get('data/groups/list', 'Admin\GroupController@list');
    Route::get('data/groups/students/list/{id}/{confirmation}', 'Admin\GroupController@students');
    Route::get('data/courses/list', 'Admin\Education\CourseController@list');
    Route::get('data/themes/list/{id}', 'Admin\Education\ThemeController@list');
    Route::get('data/tasks/list/{id}', 'Admin\Education\TaskController@list');
    Route::get('/data/users/list', 'Admin\UserController@list');


    Route::post('/upload-image', 'Admin\AdminController@uploadImage');
});


Route::middleware(['auth', 'isOnline'])->group(function(){
    Route::get('/dashboard/home', 'Dashboard\DashboardController@home');
    Route::get('/dashboard/study', 'Dashboard\DashboardController@study');
    Route::get('/dashboard/study/{id}', 'Dashboard\DashboardController@course');
    Route::get('/dashboard/study/task/{id}', 'Dashboard\DashboardController@task');
    Route::get('/dashboard/settings/', 'Dashboard\DashboardController@settings');
    Route::get('/dashboard/activity/', 'Dashboard\DashboardController@activity');

    Route::post('/dashboard/study/task/complete', 'Dashboard\UserTaskController@complete');
    Route::post('/dashboard/settings/email/{id}', 'Admin\UserController@changeEmail');
    Route::post('/dashboard/settings/password/{id}', 'Admin\UserController@changePassword');
});
