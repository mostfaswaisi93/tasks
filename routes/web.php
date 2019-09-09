<?php

Route::get('/', 'HomeController@index');
Route::get('/task/{id}', 'HomeController@show');

Route::get('/admin/projects/pending/{id}', 'ProjectController@pending');
Route::get('/admin/projects/in_progress/{id}', 'ProjectController@in_progress');
Route::get('/admin/projects/done/{id}', 'ProjectController@done');
Route::get('/admin/projects/completed/{id}', 'ProjectController@completed');
Route::get('/admin/projects/cancel/{id}', 'ProjectController@cancel');
Route::get('/admin/projects/late/{id}', 'ProjectController@late');

Route::get('/admin/employees/pending/{id}', 'EmployeeController@pending');
Route::get('/admin/employees/in_progress/{id}', 'EmployeeController@in_progress');
Route::get('/admin/employees/completed/{id}', 'EmployeeController@completed');
Route::get('/admin/employees/inactive/{id}', 'EmployeeController@inactive');
Route::get('/admin/employees/leave/{id}', 'EmployeeController@leave');


Route::get('/admin/tasks/pending/{id}', 'TaskController@pending');
Route::get('/admin/tasks/in_progress/{id}', 'TaskController@in_progress');
Route::get('/admin/tasks/done/{id}', 'TaskController@done');
Route::get('/admin/tasks/completed/{id}', 'TaskController@completed');
Route::get('/admin/tasks/cancel/{id}', 'TaskController@cancel');
Route::get('/admin/tasks/late/{id}', 'TaskController@late');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('employees', 'EmployeeController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('tasks', 'TaskController');
    Route::resource('projects', 'ProjectController');
    Route::resource('skills', 'SkillController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
