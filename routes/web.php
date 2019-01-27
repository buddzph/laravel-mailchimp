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

Auth::routes();

Route::group(['prefix'  => ''], function() {
    Route::get('',                              'MailchimpController@index');
    Route::get('/create',                       'MailchimpController@viewCreate');
    Route::post('/create',                      'MailchimpController@create');
    Route::get('/update/{id}',                  'MailchimpController@viewUpdate');
    Route::post('/update/{id}',                 'MailchimpController@update');
    Route::get('/delete/{id}',                  'MailchimpController@delete');
});