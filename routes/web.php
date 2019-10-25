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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

//Route::get('/', function () {
//    return view('welcome');
//});

Route::prefix('')->namespace('Backstage')->middleware('auth')->as('backstage.')->group(function (){
    Route::view('/','backstage.index');

    Route::resource('anime','AnimesController');
    Route::resource('episode','EpisodeController');
    Route::get('anime/{id}/episode/','EpisodeController@index')->name('episode.index');
    Route::get('anime/{id}/episode/create','EpisodeController@create')->name('episode.create');
    Route::resource('resource','ResourceController');
    Route::get('episode/{id}/resource','ResourceController@index')->name('resource.index');
    Route::get('episode/{id}/resource/create','ResourceController@create')->name('resource.create');
    Route::get('episode/resource/player','ResourceController@player')->name('resource.player');

    Route::resource('tag','TagController');
});
Route::prefix('administrator/')->namespace('Admin')->middleware('auth')->as('admin.')->group(function (){
    Route::resource('user','AdminController');

    Route::resource('setting','SettingController');
    Route::get('/setting','SettingController@index')->name('setting.index');
    Route::get('/setting/create','SettingController@create')->name('setting.create');
    Route::post('/setting','SettingController@store')->name('setting.store');
    Route::post('/setting/update','SettingController@update')->name('setting.update');
    Route::post('setting/upload','SettingController@upload')->name('upload');
});

Route::get('/home', 'HomeController@index')->name('home');
