<?php

use Illuminate\Support\Facades\Artisan;

Route::get('/clear', function () {
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    return "config,view,route and cache all are cleared.";
});

Route::redirect('/',url('/login'));
Auth::routes(['register' => false]);

Route::resource('promotionalfair', 'promotionalfairController');
Route::get('/getAllAirPortCodes/{q?}','promotionalfairController@getAllAirPorts')->name('getAllAirPorts');
Route::group(['middleware' => 'usertype'],function(){
	Route::get('dashboard', 'HomeController@dashboard')->name('dashboard');
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/customer_emails', 'HomeController@customer_emails')->name('customer_emails');
	// Route::get('/category', 'HomeController@index')->name('category');
	// Route::get('/subcat', 'HomeController@subcat')->name('subcat');


	Route::resource('category', 'categoryController');
	Route::resource('subcat', 'subcatController');
	Route::resource('package', 'packageController');
	Route::resource('packagDetails', 'packageDetailsController');
	Route::resource('accomodation', 'accomodationController');
	Route::resource('itnry', 'itineraryController');
	Route::resource('inclusion', 'inclusionController');
	Route::resource('exclusion', 'exclusionController');
	Route::resource('policy', 'policyController');
	Route::resource('pkgimages', 'pkgimagesController');
	Route::resource('subscribe', 'SubscribeController');
	Route::resource('bookings', 'bookingsController');
	Route::resource('markup', 'markupController');

	Route::post('getsubcat', 'packageController@getsubcat');
	Route::post('update_pnr', 'bookingsController@update_pnr')->name('update_pnr');
	Route::post('update_paymnt_status', 'bookingsController@update_paymnt_status')->name('update_paymnt_status');
	Route::post('update_ticket_number', 'bookingsController@update_ticket_number')->name('update_ticket_number');

	Route::resource('banner', 'bannerController');
	// Route::resource('homedeals', 'dealsController');
	// Route::resource('flightdeals', 'flightdealsController');
	Route::resource('inspiration', 'inspirationController');
	// Route::resource('secretdeals', 'secretdealsController');
	// Route::resource('generalcomments', 'generalcommentsController');

	Route::get('/get_cities', 'topDestinationController@get_cities')->name('get_cities');
	Route::resource( 'topDestination' , 'topDestinationController' );
	Route::get('/get_airport', 'topFlightController@get_airport')->name('get_airport');
	Route::resource( 'topFlight' , 'topFlightController' );


	// Route::resource('flightsearchpage', 'flightsearchpageController');
	// Route::resource('hotelsearchpage', 'hotelsearchpageController');
	// Route::resource('transfersearchpage', 'transfersearchpageController');
	// Route::resource('actsearchpage', 'actsearchpageController');


	Route::get('searchlogsflight', 'logsController@searchlogsflight')->name('searchlogsflight');
	Route::get('searchlogshotel', 'logsController@searchlogshotel')->name('searchlogshotel');
	Route::get('searchlogstransfer', 'logsController@searchlogstransfer')->name('searchlogstransfer');
	Route::get('searchlogsactivity', 'logsController@searchlogsactivity')->name('searchlogsactivity');
	/////////////////////////////////flight/////////////////////////////////////

	Route::get('flightdetail/{searchdate}', 'logsController@flightdetail')->name('flightdetail');

	Route::get('flightpdf/{month}/{date}/{year}', 'logsController@flightpdf')->name('flightpdf');
	Route::get('flightlocation/{month}/{date}/{year}/{location}', 'logsController@flightlocation')->name('flightlocation');
	Route::get('flightlocationpdf/{date}/{location}', 'logsController@flightlocationpdf')->name('flightlocationpdf');

	////////////////////////////////hotel////////////////////////////////////////////////

	Route::get('hoteldetail/{searchdate}', 'logsController@hoteldetail')->name('hoteldetail');

	Route::get('hotelpdf/{month}/{date}/{year}', 'logsController@hotelpdf')->name('hotelpdf');
	Route::get('hotellocation/{month}/{date}/{year}/{location}', 'logsController@hotellocation')->name('hotellocation');
	Route::get('hotellocationpdf/{date}/{location}', 'logsController@hotellocationpdf')->name('hotellocationpdf');


	/////////////////////////////////////////////////////////////////////////////

	////////////////////////////////activity////////////////////////////////////////////////

	Route::get('activitydetail/{searchdate}', 'logsController@activitydetail')->name('activitydetail');

	Route::get('activitypdf/{month}/{date}/{year}', 'logsController@activitypdf')->name('activitypdf');
	Route::get('activitylocation/{month}/{date}/{year}/{location}', 'logsController@activitylocation')->name('activitylocation');
	Route::get('activitylocationpdf/{date}/{location}', 'logsController@activitylocationpdf')->name('activitylocationpdf');


	/////////////////////////////////////////////////////////////////////////////

	////////////////////////////////transfer////////////////////////////////////////////////

	Route::get('transferdetail/{searchdate}', 'logsController@transferdetail')->name('transferdetail');

	Route::get('transferpdf/{month}/{date}/{year}', 'logsController@transferpdf')->name('transferpdf');
	Route::get('transferlocation/{month}/{date}/{year}/{location}', 'logsController@transferlocation')->name('transferlocation');
	Route::get('transferlocationpdf/{date}/{location}', 'logsController@transferlocationpdf')->name('transferlocationpdf');


	/////////////////////////////////////////////////////////////////////////////

	/////////////////////////flight markup//////////////////////////////////////////

	Route::resource('flightmarkup', 'flightmarkupController');
	Route::resource('social_media', 'SocialMediaController');
	Route::resource('about_us', 'AboutUsController');
	Route::resource('contact_us', 'ContactUsController');
	Route::resource('term_and_condition', 'TermAndConditionController');
	Route::resource('privacy_and_policy', 'PrivacyAndPolicyController');

	Route::post('/contact_us_google_map','ContactUsController@contact_us_google_map')->name('contact_us_google_map');
	Route::post('/about_us_partners','AboutUsController@about_us_partners')->name('about_us_partners');
	Route::post('/about_us_partners_destory','AboutUsController@about_us_partners_destory')->name('about_us_partners_destory');

	/*=====================================
	=            Users' routes            =
	=====================================*/

	Route::get('/users_detail','UsersDetailController@index')->name('users_detail');
	Route::post('/users_detail_export','UsersDetailController@export')->name('users_detail_export');

	/*=====  End of Users' routes  ======*/
	
	/*=======================================================
	 *                  home gallery routes
	 * ======================================================*/
    Route::resource( 'gallery' , 'GalleryController' );
});


