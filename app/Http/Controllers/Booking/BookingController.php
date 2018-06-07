<?php

namespace App\Http\Controllers\Booking;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ref_tax;
use App\Models\data_spa;
use App\Models\ref_country;
use App\Models\data_booking;
use App\Models\data_servicepack;

use App\Jobs\Booking\CreateBookingJob;
use App\Jobs\Booking\EditBookingJobs;
use App\Jobs\Front\BookingJob;
use App\Events\Spa\imageThumbBookingEvent;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req) {

      $data['breadcrumb'] = [
  				[
  						'name' => 'Home',
  						'link' => '/home'
  				],
  				[
  						'name' => 'All Booking',
  						'link' => 'javascript:void(0);'
  				]
  		];
      $data['status'] = !empty($req->status) ? $req->status : '';
      return view('Booking.Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
      $data['breadcrumb'] = [
  				[
  						'name' => 'Home',
  						'link' => '/home'
  				],
  				[
  						'name' => 'All Booking',
  						'link' => url('/booking')
  				],
          [
  						'name' => 'Booking',
  						'link' => 'javascript:void(0);'
  				]
  		];
      $data['negara'] = ref_country::active()->get();
      $data['items'] = data_spa::listall()->get();
      return view('Booking.Create', $data);
    }

    public function store(Request $req){
      $this->dispatch(new BookingJob($req->all()));
      $err = $req->session()->get('notif');
      return redirect('/booking/' . $err['data']->id_booking);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
      $data['breadcrumb'] = [
  				[
  						'name' => 'Home',
  						'link' => '/home'
  				],
  				[
  						'name' => 'All Booking',
  						'link' => url('/booking')
  				],
          [
  						'name' => 'Detail',
  						'link' => 'javascript:void(0);'
  				]
  		];
      $book = data_booking::join('ref_country', 'ref_country.id_country', 'data_booking.country_id')
      ->join('ref_currencies', 'ref_currencies.id', '=', 'data_booking.currenci_id')
      ->select(['data_booking.*', 'ref_country.nm_country', 'ref_currencies.iso_code'])
      ->where('id_booking', $id)->first();
      $data['book'] = $book;
      $data['spa'] = data_spa::find($book->id_spa);
      $data['service'] = data_servicepack::find($book->id_servicepack);
      $data['taxs'] = ref_tax::all();
      $data['status'] = [
        1 => 'New',
        2 => 'Unpaid',
        3 => 'Paid',
        4 => 'Cacel'
      ];

      // Matematika
      $subtotal = $book->subtotal;
      $person =  $subtotal * $book->qty_person;
      $aftdisc = ($person * $book->discount) / 100;
      $total = $person - $aftdisc;
      $other = $book->total_other;
      $totalWother = $total + $other;
      $tax = ($totalWother * $book->tax) / 100;
      $grandtotal = $totalWother + $tax;

      $data['subtotal'] = $subtotal;
      $data['person'] = $person;
      $data['discount'] = $aftdisc;
      $data['pajax'] = $tax;
      $data['grandtotal'] = $grandtotal;
      // End Matematika


      return view('Booking.Show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
      return redirect('/booking/' . $id);
    }

    public function update(Request $req, $id){
      $book = data_booking::find($id);

      $subtotal = $book->subtotal;
      $person =  $subtotal * $req->qty_person;
      $aftdisc = ($person * $req->discount) / 100;
      $total = $person - $aftdisc;
      $other = $req->total_other;
      $totalWother = $total + $other;
      $tax = ($totalWother * $req->tax) / 100;
      $grandtotal = $totalWother + $tax;

      $data['tax'] = $req->tax;
      $data['discount'] = $req->discount;
      $data['qty_person'] = $req->qty_person;
      $data['total_other'] = $req->total_other;
      $data['invoice_note'] = $req->invoice_note;
      $data['grandtotal'] = $grandtotal;
      $book->update($data);

      return redirect()->back()->withNotif([
        'label' => 'success',
        'err' => 'Success, Biling was updated'
      ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $del = data_booking::find($id);
      if($del == null)
        return response()->json([
          'result' => true,
          'err' => 'Booking was deleted'
        ]);

      $del->delete();
      return response()->json([
        'result' => true,
        'err' => 'Booking was deleted'
      ]);
    }

}
