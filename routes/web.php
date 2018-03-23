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
Route::get('/all', 'TasksController@showAllTasks')->name('tasks.all');

Route::prefix('task')->name('tasks.')->group(function (){
    Route::get('/{task}/{title}', 'TasksController@show')->name('show')
        ->where('task', '\d+');

    Route::get('/create', 'TasksController@create')->name('create');
    Route::post('/', 'TasksController@store')->name('store');

    Route::get('/complete/{task}', 'TasksController@complete')->name('complete')
        ->where('task', '\d+')->middleware('can:update,task');

    Route::get('/edit/{task}', 'TasksController@edit')->name('edit')
        ->where('task', '\d+')->middleware('can:update,task');
    Route::post('/update/{task}', 'TasksController@update')->name('update')
        ->where('task', '\d+')->middleware('can:update,task');

    Route::delete('delete/{task}', 'TasksController@destroy')->name('delete')
        ->where('task', '\d+')->middleware('can:delete,task');
});