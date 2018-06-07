<?php

	// METHOD GET
	Route::get('/', 'WelcomeController@index');
	Route::get('/page/aboutus', 'PageController@aboutus');
	Route::get('/page/terms-condition', 'PageController@terms_condition');
	Route::get('/page/contactus', 'PageController@contactus');
	Route::get('/page/spa', 'PageController@spa');
	Route::get('/page/servicepack', 'PageController@servicepack');
	Route::get('/sitemap', 'SitemapController@sitemap');

    // ---- 
	Route::get('/page/merchant', 'PageController@merchant');
	Route::get('/page/product', 'PageController@product');


	// MEMBER
	Route::get('/{any}', 'Publics\DetailSpaController@index');
	Route::get('/{any}/services', 'Publics\DetailSpaController@services');
	Route::get('/{any}/contact', 'Publics\DetailSpaController@contact');
	Route::get('/{domain}/servicepack/{slug}', 'Publics\DetailSpaController@servicepack');
	Route::get('/{domain}/book/{slug}', 'Publics\DetailSpaController@book');
	Route::get('/{domain}/gallerys', 'Publics\DetailSpaController@gallerys');
	Route::get('/{domain}/menu', 'Publics\DetailSpaController@menu');
	Route::get('/{any}/packages', 'Publics\DetailSpaController@packages');
	Route::get('/{any}/booking-success', 'Publics\DetailSpaController@booksuccess');
	Route::get('/{any}/payment/{code}/{token}', 'Publics\DetailSpaController@payment');

	Route::get('/payment/checkout', 'Payment\PaypalController@checkout');
	Route::get('/payment/confirm', 'Payment\PaypalController@confirm');
	Route::get('/ajax/allspa', 'AjaxController@allspa');
	Route::get('/ajax/badges', 'AjaxController@budgeNotify');
	Route::get('/ajax/optionearchservice', 'AjaxController@optionearchservice');
	Route::get('/ajax/searchservices', 'AjaxController@searchservices');

    // ADD MERCHANT
	Route::get('/ajax/allmerchant', 'AjaxController@allmerchant');


	// METHOD POST
	Route::post('/{any}/booking', 'Publics\DetailSpaController@booking');
	Route::post('/{any}/sendcontact', 'Publics\DetailSpaController@sendcontact');
	Route::post('/page/contactus', 'PageController@sendcontactus');
