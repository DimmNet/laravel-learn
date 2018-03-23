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

Route::redirect('/', '/home');

Auth::routes();

Route::get('/home', 'TasksController@showUserTasks')->name('home');
Route::get('/all', 'TasksController@index')->name('tasks.all');
Route::get('/task/{task}/{title}', 'TasksController@show')->name('tasks.show')
    ->where('task', '\d+');
Route::get('/task/create', 'TasksController@create')->name('tasks.create');
Route::post('/task', 'TasksController@store')->name('tasks.store');
Route::get('/task/complete/{task}', 'TasksController@complete')->name('tasks.complete')
    ->where('task', '\d+')->middleware('can:update,task');
Route::get('/task/edit/{task}', 'TasksController@edit')->name('tasks.edit')
    ->where('task', '\d+')->middleware('can:update,task');
Route::post('/task/update/{task}', 'TasksController@update')->name('tasks.update')
    ->where('task', '\d+')->middleware('can:update,task');
Route::delete('task/delete/{task}', 'TasksController@destroy')->name('tasks.delete')
    ->where('task', '\d+')->middleware('can:delete,task');