<?php

namespace App\Http\Controllers\Prints;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\User;
use App\Models\ref_currencies;
use App\Models\data_invoice_bandung;
use App\Models\data_share_profit_bandung;
use App\Models\data_invoice_item_bandung;

use App\Models\Views\view_booking_detail;

class PrintController extends Controller {

  public function invoice($id = 0){
    if(empty($id))
      abort(404);

    $book = view_booking_detail::find($id);
    $data = $book;
  	$data['config'] = \Format::paladin();

    $subtotal = $book->subtotal;
    $person =  $subtotal * $book->qty_person;
    $aftdisc = ($person * $book->discount) / 100;
    $total = $person - $aftdisc;
    $other = $book->total_other;
    $totalWother = $total + $other;
    $tax = ($totalWother * $book->tax) / 100;
    $grandtotal = $totalWother + $tax;

    $data['total_qty_person'] = $person;
    $data['total_total'] = $total;
    $data['total_discount'] = $aftdisc;
    $data['total_total_other'] = $other;
    $data['total_tax'] = $tax;
    $data['grandtotal'] = $grandtotal;

  	return \PDF::loadView('Pdf.Booking.Invoice', $data)->stream();
  }

  public function voucher($id = 0){
    if(empty($id))
      abort(404);

    $data = view_booking_detail::find($id);
  	$data['config'] = \Format::paladin();
  	return \PDF::loadView('Pdf.Booking.Voucher', $data)->stream();
  }


  public function bandung_invoice($id = 0){
    if(empty($id))
      abort(404);

    $data['item'] = data_invoice_bandung::find($id);
    $data['items'] = data_invoice_item_bandung::byid($id)->get();
    $data['crc'] = ref_currencies::find($data['item']->currenci_id);
    $data['user'] = User::find($data['item']->user_id);
    $data['config'] = \Format::paladin();
    $data['status'] = [
      1 => public_path('/img/unpaid.jpg'),
      2 => public_path('/img/paid.jpg')
    ];

  	return \PDF::loadView('Pdf.Bandung.Invoice', $data)->stream();
  }

}
