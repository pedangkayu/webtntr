<?php

use Illuminate\Support\Facades\Mail;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//cleared
Route::get('/clear-cache', function() {
	$exitCode = Artisan::call('cache:clear');
	return '<h1>Cache facade value cleared</h1>';
});
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});


Route::get('/en', 'PageController@home');
Route::get('/id', 'PageController@home');

Route::get('/test', function(){
	//
	// return abort(404);

	$client = new \GuzzleHttp\Client();
  $res = $client->request('GET', 'http://openexchangerates.org/api/latest.json?app_id=3cb09ed9b063447da37d26f786a18863');
  return json_decode($res->getBody());

});

Route::post('/page/form/contactus', 'Pages\PagesController@storeContactus');
Route::post('/page/form/orderproduk', 'Pages\PagesController@orderProduk');
Route::get('/sendmail', function(){

	$name = 'tinatarweb';
    $email = 'jawadwipa@gmail.com';
    $website = 'pumasa.id';
    $subject = 'send email';
    $deskripsi = 'checking';

    $data = array(
        'name' => $name,
        'email' => $email,
        'website' => $website,
        'subject' => $subject,
        'deskripsi' => $deskripsi,
    );

    Mail::send('Frontend.Pages.sendmail', $data, function ($message) use ($data)
    {
        $message->from('info@pumasa.com', 'Info tinatar');
        $message->to('jawadwipa@gmail.com')->subject('Layanan Informasi tinatar');
    });

    return 'sukses';
});

// AUTH
Route::group(['middleware' => 'auth'], function () {

	Route::get('/home', 'HomeController@index');
	Route::get('/app/configuration', 'HomeController@configuration');
	Route::get('/share/detail', 'HomeController@sharedetail');
	Route::get('/share/payout', 'HomeController@payout');
	Route::post('/share/payout', 'HomeController@storepayout');
	Route::post('/app/configuration', 'HomeController@storeconfiguration');

	Route::post('/menu-position', 'Menus\MenuController@reposition');
	Route::get('/akses-page', 'Menus\MenuController@akses_menu');
	Route::post('/ajax/loadtreepage/menus', 'Menus\MenuController@listpages');
	Route::post('/akses-page', 'Menus\MenuController@savelistpages');


	// User Configuration
	Route::get('/users', 'Users\UserController@index');
	Route::get('/users/profile', 'Users\UserController@profile');
	Route::get('/users/avatar', 'Users\UserController@avatar');
	Route::post('/users/anydata', 'Users\UserController@anydata');
	Route::get('/users/{id}', 'Users\UserController@show');
	Route::put('/users/{id}', 'Users\UserController@update');
	Route::delete('/users/{id}', 'Users\UserController@destroy');


	Route::post('/users/profile', 'Users\UserController@updateprofile');
	Route::post('/users/updateuseraccess', 'Users\UserController@updateakunlogin');
	Route::post('/users/updatefromlist', 'Users\UserController@updateavatarfromlist');
	Route::post('/users/avatar', 'Users\UserController@updateavatarfromfile');


	// Resources Controller
	Route::get('/spa/template/{id}', 'Spa\SpaController@tempates');
	Route::resources([
		'/menu' 			=> 'Menus\MenuController',
		'/spa/servicepack' 	=> 'Spa\ServicepackController',
		'/spa/schedule' 	=> 'Spa\ScheduleController',
		'/spa/gallery' 		=> 'Spa\Gallery\GalleryController',
		'/spa'				=> 'Spa\SpaController',
		'/booking' 			=> 'Booking\BookingController',
		'/message' 			=> 'Message\MessageController',
		'/header' 			=> 'Setting\Header\HeaderImageController',
		'/pages'			=> 'Pages\PagesController',
		'/list-produk'		=> 'Product\ProductController',
		'/order'				=> 'Order\OrderController',
	]);

	//produk
	Route::post('/list-produk/create', 'Product\ProductController@store');
	Route::get('/list-produk/edit/{id}', 'Product\ProductController@edit');
	Route::post('/list-produk/edit/{id}', 'Product\ProductController@update');
	Route::get('/get-data', 'Product\ProductController@getData');

	//order
	Route::post('/order/create', 'Order\OrderController@store');
	Route::get('/get-data', 'Order\OrderController@getData');
	Route::get('/product-detail/{code}', 'Order\OrderController@detail');
	Route::get('/product-delete/{code}', 'Order\OrderController@delete');
	Route::post('/product/post/manual', 'Order\OrderController@storeManual');
	
	//pages
	Route::post('/pages/create', 'Pages\PagesController@store');
	Route::get('/pages/edit/{code}', 'Pages\PagesController@edit');
	Route::post('/pages/edit/{code}', 'Pages\PagesController@update');
	Route::get('/pages/{slug}/description', 'Pages\PagesController@indexDescription');
	Route::post('/pages/{slug}/description', 'Pages\PagesController@storeDescription');

	//posts
	Route::get('/posts', 'Posts\PostsController@index');
	Route::get('/posts/create', 'Posts\PostsController@create');
	Route::post('/posts/create', 'Posts\PostsController@store');
	Route::get('/posts/edit/{code}', 'Posts\PostsController@edit');
	Route::post('/posts/edit/{code}', 'Posts\PostsController@update');
	Route::get('/posts/show/{code}', 'Posts\PostsController@show');
	Route::get('/ajax-languages', 'Posts\PostsController@ajaxLanguages');

	// Dashboard
	Route::post('/dashboard/statisticbooking', 'AjaxController@statisticbooking');
	Route::post('/dashboard/statisticincome', 'AjaxController@statisticincome');
	Route::post('/dashboard/anydata', 'AjaxController@anydata');
	Route::post('/ajax/usetempate', 'AjaxController@usetempate');

	// List table
	Route::post('/spastatisticbooking', 'Spa\SpaDataTablesController@spastatisticbooking');
	Route::post('/spastatisticincome', 'Spa\SpaDataTablesController@spastatisticincome');
	Route::post('/listspa/anydata', 'Spa\SpaDataTablesController@anydata');
	Route::post('/listspa/services/{id}', 'Spa\SpaDataTablesController@services');
	Route::post('/listspa/packages/{id}', 'Spa\SpaDataTablesController@packages');
	Route::post('/listbooking/anydata', 'Booking\BookingDataTablesController@anydata');
	Route::post('/spaservice/premium', 'Spa\SpaDataTablesController@premium');
	Route::post('/anyschedule/{any}', 'Spa\SpaDataTablesController@anyschedule');
	Route::post('/anygallerys/{any}', 'Spa\Gallery\GalleryAnyDataController@anydata');
	Route::post('/headers', 'Spa\Gallery\GalleryAnyDataController@headers');
	Route::post('/ajax/message/anymessages', 'Message\MessageDataController@anydata');


	// List table merchant
	Route::post('/merchantstatisticbooking', 'Merchant\MerchantDataTablesController@merchantstatisticbooking');
	Route::post('/merchantstatisticincome', 'Merchant\MerchantDataTablesController@merchantstatisticincome');
	Route::post('/listmerchant/anydata', 'Merchant\MerchantDataTablesController@anydata');
	Route::post('/listmerchant/services/{id}', 'Merchant\MerchantDataTablesController@services');
	Route::post('/listmerchant/packages/{id}', 'Merchant\MerchantDataTablesController@packages');
	Route::post('/merchantservice/premium', 'Merchant\MerchantDataTablesController@premium');
	Route::post('/anyschedule/{any}', 'Merchant\MerchantDataTablesController@anyschedule');
	Route::post('/anygallerys/{any}', 'Merchant\Gallery\GalleryAnyDataController@anydata');
	Route::post('/headers', 'Merchant\Gallery\GalleryAnyDataController@headers');
	Route::post('/listbooking/anydata', 'Booking\BookingDataTablesController@anydata');



	// Setting
	Route::post('/headeranydata', 'Setting\Header\HeaderImageDataController@anydata'); // Header any data
	Route::post('/headerstatus', 'Setting\Header\HeaderImageDataController@headerstatus'); // Header any data

	Route::get('/getservicepack/{id}', 'Booking\BookingDataTablesController@getservicepack');
	Route::get('/getdetailservicepack/{id}', 'Booking\BookingDataTablesController@getdetailservicepack');

	// Mail
	Route::post('/mail/sendinvoicemail', 'Booking\BookingDataTablesController@sendinvoicemail');
	Route::post('/mail/sendvoucheremail', 'Booking\BookingDataTablesController@sendvoucheremail');

	// Print
	Route::get('/print/invoice/{id}', 'Prints\PrintController@invoice');
	Route::get('/print/voucher/{id}', 'Prints\PrintController@voucher');
	Route::get('/print/bandung/invoice/{id}', 'Prints\PrintController@bandung_invoice');

	// Bandung
	Route::get('/bandung/dashboard', 'Bandung\BandungController@dashboard');
	Route::get('/bandung/invoice', 'Bandung\BandungController@invoice');
	Route::get('/bandung/invoice/{id}', 'Bandung\BandungController@invoicedetail');

	Route::post('/bandung/statisticincome', 'Bandung\BandungController@statisticincome');
	Route::post('/bandung/invoiceanydata', 'Bandung\BandungController@invoiceanydata');
	Route::post('/bandung/invoice/verification', 'Bandung\BandungController@invoice_verif');

});

Auth::routes();

//frontend
Route::group(['prefix' => LaravelLocalization::setLocale()], function () {

	Route::get('/{code}', 'Pages\PagesController@allpage');
	Route::get('/{pages}/{slug}', 'Pages\PagesController@allnewsdetail');
});

Route::get('/transalate-pages-id/{page}/{childPage}', function($page, $childPage){
	$outLang = 'id';
	$outPage = '';
	$outChildPage ='';
    $outLang = App\Models\languages::where('code', $outLang)->first();
    ;

	if ($page != 'undefined') {
        $outPage = App\Models\pages::where('slug', $page)->first();
        $outPage = App\Models\pages::where('code', $outPage->code)->where('lang_id', $outLang->id)->first();
	}

	if ($childPage != 'undefined') {
		if ($outPage->code == 33333) {
			$outChildPage = App\Models\data_product::where('slug', $childPage)->first();
		} else {
	        $outChildPage = App\Models\posts::where('slug', $childPage)->first();
	        $outChildPage = App\Models\posts::where('lang_id', $outLang->id)->where('code_posts', $outChildPage->code_posts)->first();
		}
	}

	return response()->json(['page' => $outPage, 'childPage' => $outChildPage]);
});

Route::get('/transalate-pages-eng/{page}/{childPage}', function($page, $childPage){
	$outLang = 'en';
	$outPage = '';
	$outChildPage ='';
    $outLang = App\Models\languages::where('code', $outLang)->first();

    if ($page != 'undefined') {
        $outPage = App\Models\pages::where('slug', $page)->first();
        $outPage = App\Models\pages::where('code', $outPage->code)->where('lang_id', $outLang->id)->first();
	}

	if ($childPage != 'undefined') {
		if ($outPage->code == 33333) {
			$outChildPage = App\Models\data_product::where('slug', $childPage)->first();
		} else {
	        $outChildPage = App\Models\posts::where('slug', $childPage)->first();
	        $outChildPage = App\Models\posts::where('lang_id', $outLang->id)->where('code_posts', $outChildPage->code_posts)->first();
		}
	}

	return response()->json(['page' => $outPage, 'childPage' => $outChildPage]);
});

