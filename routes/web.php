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

Route::get('/', function()
{
    return view('welcome');
});

Route::get('/p', function()
{
    abort(404);
});

Route::get('/p/{participant}', function($participant)
{
    return redirect()->action("PromoController@index", compact("participant"));
});

Route::get('/~{hash}', "PromoFacebookController@index")->where("hash", "[a-zA-Z0-9]+");
Route::get('/~{hash}/p', "PromoFacebookController@preview")->where("hash", "[a-zA-Z0-9]+");


Route::get('/ninja', "RefericonController@index");



/**
*
* BEGIN PROMO ROUTES
*
**/





Route::prefix('p/{participant}')->group(function()
{



	Route::prefix('promo')->group(function()
	{
	   

		Route::get('ranking', "PromoController@ranking");

		Route::get('creatives/{creative}/generate', "PromoCreativeController@generate");

		Route::resource('creatives', "PromoCreativeController");

		Route::get('logistics', "PromoController@logistics");
		Route::get('learn', "PromoController@learn");


		Route::get('newsletters/{newsletterId}/zip', "PromoNewsletterController@zip");

		Route::get('newsletters/{newsletterId}/raw', "PromoNewsletterController@raw");

		Route::get('newsletters/{newsletterId}/download',"PromoNewsletterController@download");

		Route::get('newsletters/{newsletterId}/source', "PromoNewsletterController@source");

		Route::get('newsletters/{newsletterId}/send', "PromoNewsletterSendController@index");

		Route::get('newsletters/{newsletterId}', "PromoNewsletterController@show");

		Route::get('newsletters', "PromoNewsletterController@index");


		Route::get('/', "PromoController@index");


	});


	Route::get('scanner', "ScannerController@index");

});


