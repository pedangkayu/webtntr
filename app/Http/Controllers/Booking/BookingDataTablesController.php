<?php

namespace App\Http\Controllers\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\data_booking;
use App\Models\Views\view_booking_detail;
use App\Models\data_servicepack;

use App\Events\Booking\SendInvoiceBookingEvent;
use App\Events\Booking\SendVoucherBookingEvent;

class BookingDataTablesController extends Controller {

    public function anydata(Request $req){
      $status = !empty($req->status) ? $req->status : '';
      $items = data_booking::listall($status);
      return \Datatables::of($items)
      ->editColumn('code', function ($item) {
           return '<a class="btn btn-block btn-success btn-sm" href="' . url('/booking/' . $item->id_booking) . '"><strong><i class="fa fa-search"></i> #' . $item->code . '</strong></a>';
       })
       ->editColumn('day_request', function ($item) {
            return '<div>' . date('d/m/Y', strtotime($item->day_request)) . '</div>' .
                    '<small>AT <i class="fa fa-clock-o"></i> ' . date('h:i A', strtotime($item->time_request)) . '</small>';
        })
        ->editColumn('checkin_hotel', function ($item) {
             return !empty($item->checkin_hotel) ? '<div>' . date('d/m/Y', strtotime($item->checkin_hotel)) . '</div>' : '<center>-</center>';
         })
       ->editColumn('grandtotal', function ($item) {
            return '<div class="text-right">' . number_format($item->grandtotal,2,'.',',') . ' ' . $item->iso_code . '</div>';
        })
       ->editColumn('email', function ($item) {
            return '<div><a href="mailto:' . $item->email . '">' . $item->email . '</a></div>' .
                    '<small><i class="fa fa-phone"></i> ' . $item->phone . '</small>';
        })
        ->editColumn('id_booking', function ($item) {
             return '<button type="button" class="btn btn-sm btn-block btn-flat" onclick="hapus(\'' . $item->id_booking . '\', \'' . $item->code . '\');"><i class="fa fa-trash"></i></button>';
         })
        ->editColumn('status', function ($item) {
             $status = [
               1 => 'New',
               2 => 'Unpaid',
               3 => 'Paid',
               4 => 'Cacel'
             ];

             $style = [
               1 => 'background:green;color:#fff;padding:10px;width:100%;',
               2 => 'background:red;color:#fff;padding:10px;width:100%;',
               3 => 'background:yellow;padding:10px;width:100%;',
               4 => 'background:black;padding:10px;width:100%;'
             ];
             $out = '<div class="text-center" style="' . $style[$item->status] . '">';
             $out .= (strtotime($item->day_request . ' ' . $item->time_request) < time()) && ($item->status == 3) ? 'Finish' : $status[$item->status];
             $out .= '</div>';

             return $out;
         })
      ->make();
    }

    public function sendinvoicemail(Request $req){
      $data = view_booking_detail::find($req->id);
      event(new SendInvoiceBookingEvent($data));
      $err = $req->session()->get('err');
      return response()->json($err);
    }

    public function sendvoucheremail(Request $req){
      data_booking::find($req->id)->update(['note_voucher' => $req->note]);
      $data = view_booking_detail::find($req->id);
      $data['config'] = \Format::paladin();
      event(new SendVoucherBookingEvent($data->toArray()));
      $err = $req->session()->get('err');
      return response()->json($err);
    }

    public function getservicepack($id){
      $res = [];
      $out = '<option value="">Please Select</option>';
      $items = data_servicepack::where('id_spa', $id)->select([
          'id_servicepack',
          'servicepack',
          'type'
      ])->get();
      foreach ($items as $item) {
        $type = $item->type ? 'Service' : 'Package';
        $out .= '<option value="' . $item->id_servicepack . '">' . $type . ' ' . $item->servicepack . '</option>';
      }
      $res['result'] = true;
      $res['option'] = $out;

      return response()->json($res);

    }

    public function getdetailservicepack($id){
        $res = [];
        $item = data_servicepack::find($id);
        $out = '
          <input type="hidden" name="type" value="' . $item->type . '">
          <input type="hidden" name="currenci_id" value="' . $item->currenci_id . '">
        ';
        $res['result'] = true;
        $res['item'] = $out;
        return response()->json($res);
    }

}
