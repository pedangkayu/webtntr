<?php

namespace App\Http\Controllers\Bandung;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\ref_currencies;
use App\Models\data_invoice_bandung;
use App\Models\data_share_profit_bandung;
use App\Models\data_invoice_item_bandung;

use App\Models\Views\view_count_share_profit_bandung AS count_profit;
use App\Models\Views\view_currencies_used_share_profit;

use App\Events\Bandung\VerificationEvent;

class BandungController extends Controller {

  public function dashboard(){

    $data['breadcrumb'] = [
        [
            'name' => 'Dashboard Bandung',
            'link' => 'javascript:void(0);'
        ]
    ];

    $data['count'] = count_profit::first();

    return view('Bandung.Dashboard', $data);
  }

  public function statisticincome(Request $req){
    if($req->ajax()){
      $res['result'] = true;
      $out = [];
      // Daftar Semua Bulan
      for($i = 1; $i <= 12; $i++){
        $res['bulan'][] = date('M', strtotime($req->tahun . '-' . $i));
      }

      $res['td'] = [];
      foreach(view_currencies_used_share_profit::all() as $crc){
        $data = [];
        $total = [];
        for($i = 1; $i <= 12; $i++){
          $gt = data_share_profit_bandung::where(\DB::raw('YEAR(created_at)'), $req->tahun)
            ->where('status', 3)
            ->where('currenci_id', $crc->id)
            ->where(\DB::raw('MONTH(created_at)'), $i)
            ->sum('subtotal');
          $data[] = $gt;
          $total[$i] = $gt > 0 ? number_format($gt,2,'.',',') : '-';
        }

        $res['td'][] = [
          'currencies' => $crc->iso,
          'totals' => $total
        ];

        $color = rand(0,255) . ', ' . rand(0,255) . ', ' . rand(0,255);
        $out[] = [
          'label' => $crc->iso,
          'data' => $data,
          'fill' => false,
          'backgroundColor' => 'rgba(' . $color . ', 0.5)',
          'borderColor' => 'rgba(' . $color . ', 1)',
          'borderWidth' => 1
        ];

      }

      $res['data'] = $out;

      return response()->json($res);

    }
  }

  public function invoice(Request $req){
    $data['breadcrumb'] = [
        [
            'name' => 'Dashboard Bandung',
            'link' => url('/bandung/dashboard')
        ],
        [
            'name' => 'Invoices',
            'link' => 'javascript:void(0);'
        ]
    ];

    $data['status'] = !empty($req->status) ? $req->status : '';
    $data['items'] = data_invoice_bandung::where('status', 1)->get();
    return view('Bandung.Invoice', $data);

  }

  public function invoicedetail($id){

    $data['breadcrumb'] = [
        [
            'name' => 'Dashboard Bandung',
            'link' => url('/bandung/dashboard')
        ],
        [
            'name' => 'Invoices Detail',
            'link' => 'javascript:void(0);'
        ]
    ];

    $data['item'] = data_invoice_bandung::find($id);
    $data['items'] = data_invoice_item_bandung::byid($id)->get();
    $data['crc'] = ref_currencies::find($data['item']->currenci_id);
    $data['user'] = User::find($data['item']->user_id);
    $data['status'] = [
      1 => 'ON Moderator',
      2 => 'Paid'
    ];
    return view('Bandung.InvoiceDetail', $data);
  }

  public function invoiceanydata(Request $req){

    $status = !empty($req->status) ? $req->status : '';
    $items = data_invoice_bandung::listall($status);
    return \Datatables::of($items)
    ->editColumn('code', function ($item) {
         return '<a href="' . url('/bandung/invoice/' . $item->id) . '">#' . $item->code . '</strong></a>';
    })
    ->editColumn('created_at', function ($item) {
          return date('M d, Y', strtotime($item->created_at));
    })
    ->editColumn('grandtotal', function ($item) {
          return number_format($item->grandtotal,2,'.',',');
    })
    ->make();

  }

  public function invoice_verif(Request $req){
    if($req->ajax()){
      $res = [];
      data_invoice_bandung::find($req->id)->update([
        'status' => 2
      ]);
      foreach(data_invoice_item_bandung::byid($req->id)->get() as $item){
        data_share_profit_bandung::find($item->old_id)->update([
          'status' => 3
        ]);
      }

      $send['id'] = $req->id;

      event(new VerificationEvent($send));

      $res['result'] = true;
      $res['err'] = 'Verified';
      return response()->json($res);

    }
  }

}
