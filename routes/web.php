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


Route::group(['middleware' => 'auth'], function() {

    Route::resource('ratings', 'RatingsController');
    Route::resource('comments', 'CommentsController')->except('index');
    Route::resource('users', 'ManageUsersController');
    Route::post('/users/{id}', [
        'uses' => 'ManageUsersController@update',
        'as' => 'users.update'
    ]);
}); 


Route::auth();

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home'
]);
Route::get('/shows/{id}', [
    'uses' => 'ShowsController@index',
    'as' => 'shows.index'
]); 
Route::get('/shows/{show_id}/seasons/{season_id}', [
    'uses' => 'ShowsController@show',
    'as' => 'shows.season'
]);
Route::post('/shows/{show_id}/comments/', [
    'uses' => 'CommentsController@store',
    'as' => 'comments.store'
]);






