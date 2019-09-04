<?php

Route::get('/', 'HomeController@index');
Route::get('/task/{id}', 'HomeController@show');

// Route::get('/admin/projects/active/{id}', 'ProjectController@active');
// Route::get('/admin/projects/pending/{id}', 'ProjectController@pending');
// Route::get('/admin/projects/deactive/{id}', 'ProjectController@deactive');

// Route::get('/admin/employees/active/{id}', 'EmployeeController@active');
// Route::get('/admin/employees/pending/{id}', 'EmployeeController@pending');
// Route::get('/admin/employees/deactive/{id}', 'EmployeeController@deactive');

// Route::get('/admin/tasks/active/{id}', 'TaskController@active');
// Route::get('/admin/tasks/pending/{id}', 'TaskController@pending');
// Route::get('/admin/tasks/deactive/{id}', 'TaskController@deactive');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('employees', 'EmployeeController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('tasks', 'TaskController');
    Route::resource('projects', 'ProjectController');
    Route::resource('tags', 'TagController');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
