<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\projectcontroller;


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




Auth::routes();

Route::middleware(['auth'])->group(function(){

    Route::get('/', 'App\Http\Controllers\projectcontroller@index')->name('index');

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('companies','App\Http\Controllers\CompaniesController');

    Route::get('/companies', 'App\Http\Controllers\CompaniesController@view')->name('view');

    Route::resource('tasks','App\Http\Controllers\TasksController');

    Route::patch('tasks/{task}/completed','App\Http\Controllers\TasksController@completed');

    Route::get('/companytask/{company_name}','App\Http\Controllers\projectcontroller@companytask');

    Route::get('/design','App\Http\Controllers\projectcontroller@design');

    Route::get('/web','App\Http\Controllers\projectcontroller@web');

    Route::get('/print','App\Http\Controllers\projectcontroller@print');

    Route::get('/completed','App\Http\Controllers\projectcontroller@completed');


});
