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

Route::get('/home', 'TasksController@index')->name('home');
Route::get('/task/{task}/{title}', 'TasksController@show')->name('tasks.show')
    ->where('task', '\d+');
Route::post('/task/{task}', 'NewsController@complete')->name('tasks.complete')
    ->where('task', '\d+')->middleware('can:update,task');
Route::get('/task/edit/{task}', 'TasksController@edit')->name('tasks.edit')
    ->where('task', '\d+')->middleware('can:update,task');
Route::delete('task/{task}', 'TasksController@destroy')->name('tasks.delete')
    ->where('task', '\d+')->middleware('can:delete,task');