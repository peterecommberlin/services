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


Route::get('/marek', function () {
    return Artisan::call('contestants:votes', [
        
        //'--domain' => 'ecommerceberlin.com'
        '--domain' 	=> 'ecommercegermanyawards.com',
        '--role' 	=> 'contestant_company'
    ]);

    //
});


Route::get('/p', function()
{
    abort(404);
});

// Route::get('/p/{participant}', function($participant)
// {
//     return redirect()->action("PromoController@index", compact("participant"));
// });



Route::get('/~{hash}', "PromoFacebookController@index")->where("hash", "[a-zA-Z0-9]+");
Route::get('/~{hash}/p', "PromoFacebookController@preview")->where("hash", "[a-zA-Z0-9]+");



// Route::get('/ninja', "RefericonController@index");
// Route::get('/ninja2', "RefericonController@indexWinners");



Route::get('/invites', "InvitesGeneratorController@index");


Route::get("/trackinglinks", "TrackingLinkController@index");




Route::get('/rsvp', "RsvpController@index");
Route::get('/rsvp/{id}/reject', "RsvpController@reject");
Route::get('/rsvp/{id}/approve', "RsvpController@approve");
Route::get('/rsvp/{id}/ignore', "RsvpController@ignore");
Route::get('/meetup-mute/', "MeetupController@mute");
Route::get('/meetup-block/', "MeetupController@index");
Route::get('/meetup-confirm/', "MeetupController@index");



Route::get('/email-preview/{name}', "EmailPreviewController@index");


Route::get("/unsubscribe/{hash}", "UnsubscribeController@index")->where("hash", "[a-zA-Z0-9]+");
Route::get("/unsubscribe/{hash}/group", "UnsubscribeController@muteGroup")->where("hash", "[a-zA-Z0-9]+");
Route::get("/unsubscribe/{hash}/event", "UnsubscribeController@muteEvent")->where("hash", "[a-zA-Z0-9]+");
Route::get("/unsubscribe/{hash}/location", "UnsubscribeController@muteLocation")->where("hash", "[a-zA-Z0-9]+");


/**
*
* BEGIN PROMO ROUTES
*
**/





Route::prefix('p/{participant}')->group(function()
{

	Route::prefix('promo')->group(function()
	{
	   
		Route::get('creatives/{creative}/generate', "PromoCreativeController@generate");
		Route::resource('creatives', "PromoCreativeController");
		Route::get('logistics', "PromoController@logistics");
		Route::get('learn', "PromoController@learn");
		Route::get('/', "PromoController@index");


	});


	Route::get('scanner', "ScannerController@index");

});


