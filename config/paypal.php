<?php
return [

  'sandbox' => [
    'client_id' => env('PAYPAL_SANDBOX_CLIENTID'),
    'secret' => env('PAYPAL_SANDBOX_SECRET'),
  ],
  'live' => [
    'client_id' => env('PAYPAL_LIVE_CLIENTID'),
    'secret' => env('PAYPAL_LIVE_SECRET'),
  ],
  'settings' => [
    'mode' => env('PAYPAL_LIVE') ? 'live' : 'sandbox',
    'http.ConnectionTimeOut' => 30,
    'log.LogEnabled' => true,
    'log.FileName' => storage_path('logs/paypal.log'),
    'log.LogLevel' => 'FINE'
  ]
];
