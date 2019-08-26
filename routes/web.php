<?php

Route::get('/', 'HomeController@index');
Route::get('/task/{id}', 'HomeController@show');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('employees', 'EmployeeController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('tasks', 'TaskController');
    Route::resource('projects', 'ProjectController');
    Route::resource('tags', 'TagController');
    Route::resource('jobs', 'JobController');
});
