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

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('')->namespace('Backstage')->as('backstage.')->group(function (){
    Route::resource('anime','AnimesController');
    Route::resource('episode','EpisodeController');
    Route::get('anime/{id}/episode/','EpisodeController@index')->name('episode.index');
//    Route::get('anime/episode/{id}','EpisodeController@index')->name('episode.index');
});