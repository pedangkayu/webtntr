<?php

	namespace App\Classes\PayPal;
	use Illuminate\Support\Facades\Facade;

	class PayPalFacade extends Facade {

	    protected static function getFacadeAccessor() { return 'PayPal'; }

	}
