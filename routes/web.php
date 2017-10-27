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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/p/{id}/promo', "ParticipantPromoController@index");
Route::get('/p/{id}/ranking', "ParticipantPromoController@ranking");

Route::get('/p/{id}/newsletter', "ParticipantPromoController@newsletter");

Route::get('/p/{id}/tutorial', "ParticipantPromoController@tutorial");



Route::get('/p/{id}/newsletter-raw', "NewsletterController@index");
Route::get('/p/{id}/download', "NewsletterController@download");