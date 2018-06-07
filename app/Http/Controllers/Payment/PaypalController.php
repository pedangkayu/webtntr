<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Events\PayPal\PayPalNotificationSuccessPaymantEvent as EmailNotif;
use App\Models\Views\view_booking_detail;
use App\Models\data_booking;

class PaypalController extends Controller {

  private $paypal;

  public function __construct(){
    $this->paypal = \PayPal::start();
  }

  public function confirm(Request $req){

    if (isset($req->success) && $req->success == 'true') {

      $paymentId = $req->paymentId;
      $payment = \PayPal::payment_get($paymentId, $this->paypal);

      $execution = \PayPal::paymentExecution();
      $execution->setPayerId($req->PayerID);

      try {
        $result = $payment->execute($execution, $this->paypal);

        $update = data_booking::find($req->referal)->update([
          'paypal_payment_id' => $req->paymentId,
          'paypal_payer_id' => $req->PayerID,
          'paypal_status' => 1,
          'status' => 3,
          'paypal_date' => date('Y-m-d H:i:s')
        ]);

        $book = view_booking_detail::find($req->referal);
        $data = $book;
        $data['config'] = \Format::paladin();
        // Email Notifikasi
        event(new EmailNotif($book));
        return redirect($req->domain . '?payment=success');
      } catch (\Exception $e) {
        $err['message'] = !empty($e->getData()) ? ($e->getData()) : $e->getMessage();
        $req->session()->flash('err', $err);
        return view('errors.paypal');
      }

    }

  }

}
