<?php

Route::get('/', 'HomeController@index');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('tasks', 'TaskController');
    Route::post('tasks/update', 'TaskController@update')->name('tasks.update');
    Route::get('tasks/destroy/{id}', 'TaskController@destroy');
    Route::post('tasks/updateStatus/{id}', 'TaskController@updateStatus')->name('task.status');

    Route::resource('employees', 'EmployeeController');
    Route::post('employees/update', 'EmployeeController@update')->name('employees.update');
    Route::get('employees/destroy/{id}', 'EmployeeController@destroy');
    Route::post('employees/updateStatus/{id}', 'EmployeeController@updateStatus')->name('employee.status');

    Route::resource('projects', 'ProjectController');
    Route::post('projects/update', 'ProjectController@update')->name('projects.update');
    Route::get('projects/destroy/{id}', 'ProjectController@destroy');
    Route::post('projects/updateStatus/{id}', 'ProjectController@updateStatus')->name('project.status');

    Route::resource('departments', 'DepartmentController');
    Route::post('departments/update', 'DepartmentController@update')->name('departments.update');
    Route::get('departments/destroy/{id}', 'DepartmentController@destroy');

    Route::resource('skills', 'SkillController');
    Route::post('skills/update', 'SkillController@update')->name('skills.update');
    Route::get('skills/destroy/{id}', 'SkillController@destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
