<?php

  namespace App\Classes\PayPal;

  use PayPal\Rest\ApiContext;
  use PayPal\Auth\OAuthTokenCredential;
  use PayPal\Api\Amount;
  use PayPal\Api\Details;
  use PayPal\Api\Item;
  use PayPal\Api\ItemList;
  use PayPal\Api\Payer;
  use PayPal\Api\Payment;
  use PayPal\Api\RedirectUrls;
  use PayPal\Api\ExecutePayment;
  use PayPal\Api\PaymentExecution;
  use PayPal\Api\Transaction;

  class PayPal {

    private $paypal;
    public function start(){
      $conf = config('paypal');

      if($conf['settings']['mode'] == 'sandbox'):
        $this->paypal = new ApiContext(
            new OAuthTokenCredential(
                $conf['sandbox']['client_id'],     // ClientID
                $conf['sandbox']['secret']      // ClientSecret
            )
        );
      else:
        $this->paypal = new ApiContext(
            new OAuthTokenCredential(
                $conf['live']['client_id'],     // ClientID
                $conf['live']['secret']      // ClientSecret
            )
        );
      endif;
      $this->paypal->setConfig($conf['settings']);

      return $this->paypal;
    }

    public function payer(){
      return new Payer();
    }

    public function item(){
      return new Item();
    }

    public function itemList(){
      return new ItemList();
    }

    public function details(){
      return new Details();
    }

    public function amount(){
      return new Amount();
    }

    public function transaction(){
      return new Transaction();
    }

    public function redirectUrls(){
      return new RedirectUrls();
    }

    public function payment(){
      return new Payment();
    }

    public function payment_get($paymentId, $paypal){
      return Payment::get($paymentId, $paypal);
    }

    public function paymentExecution(){
      return new PaymentExecution();
    }

  }
