<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\data_spa;
use App\Models\ref_regional;
use App\Models\data_message;
use App\Models\data_booking;
use App\Models\data_servicepack;
use App\Models\data_share_profit_bandung;
use App\Models\Views\view_currencies_used;
use App\Models\Views\view_top_spa_on_month;
use App\Models\Views\view_currencies_used_share_profit;

class AjaxController extends Controller {

  public function allspa(Request $req){
    if($req->ajax()):
      $out = [];
      $items = data_spa::search($req->input('query'))->get();
      foreach($items as $item){
        $out[] = [
          'id' => url($item->slug),
          'name' => $item->spa,
          'url' => url($item->slug)
        ];
      }
      return response()->json($out);
    endif;
  }


  public function budgeNotify(){
    $res = [];
    $out = [];
    $msgs = data_message::baru()->get();
    foreach($msgs as $item){
      $out[] = [
        'title' => 'New Message',
        'desc' => $item->subject,
        'date' => date('M d, Y', strtotime($item->created_at)),
        'time' => date('h:i A', strtotime($item->created_at)),
        'url' => url('/message/' . $item->id),
        'img' => ''
      ];
    }


    $msgs = data_booking::baru()->get();
    foreach($msgs as $item){
      $out[] = [
        'title' => 'New Booking',
        'desc' => $item->servicepack,
        'date' => date('M d, Y', strtotime($item->created_at)),
        'time' => date('h:i A', strtotime($item->created_at)),
        'url' => url('/booking/' . $item->id_booking),
        'img' => asset('/img/servicepack/thumb/' . $item->img_thumbnail)
      ];
    }



    $res['count'] = count($out);
    $res['items'] = $out;
    $res['share_badge'] = data_share_profit_bandung::where('status', 1)->count('id');
    return response()->json($res);
  }

  public function statisticbooking(Request $req){
    if($req->ajax()){
      $res['result'] = true;

      // Daftar Semua Bulan
      for($i = 1; $i <= 12; $i++){
        $res['bulan'][] = date('M', strtotime($req->tahun . '-' . $i));
      }

      // Total Semua servicepack
      for($i = 1; $i <= 12; $i++){
        $res['all']['total'][] = data_booking::where(\DB::raw('YEAR(created_at)'), $req->tahun)
          ->where(\DB::raw('MONTH(created_at)'), $i)
          ->where('status', 3)
          ->count('id_booking');
      }

      // Total service
      for($i = 1; $i <= 12; $i++){
        $res['service']['total'][] = data_booking::where(\DB::raw('YEAR(created_at)'), $req->tahun)
          ->where('type', 1)
          ->where('status', 3)
          ->where(\DB::raw('MONTH(created_at)'), $i)
          ->count('id_booking');
      }

      // Total Package
      for($i = 1; $i <= 12; $i++){
        $res['package']['total'][] = data_booking::where(\DB::raw('YEAR(created_at)'), $req->tahun)
          ->where('type', 2)
          ->where('status', 3)
          ->where(\DB::raw('MONTH(created_at)'), $i)
          ->count('id_booking');
      }

      return response()->json($res);

    }
  }

  public function anydata(Request $req){
    if($req->ajax()){
      $res = [];
      $out = [];

      // TOP SPA
      $tops = view_top_spa_on_month::all();
      $out['tops'] = [];
      foreach($tops as $top){
        $out['tops'][] = [
          'total' => $top->total_booking,
          'url' => url($top->slug),
          'url_view' => url('/spa/' . $top->id_spa),
          'spa' => $top->spa,
          'id_spa' => $top->id_spa,
          'img' => asset('/img/spa/thumb/' . $top->img_thumbnail),
        ];
      }
      $res['share_profit'] = $this->shareprofit();
      $res['result'] = true;
      $res['data'] = $out;
      return response()->json($res);
    }
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
      foreach(view_currencies_used::all() as $crc){
        $data = [];
        $total = [];
        for($i = 1; $i <= 12; $i++){
          $gt = data_booking::where(\DB::raw('YEAR(created_at)'), $req->tahun)
            ->where('status', 3)
            ->where('currenci_id', $crc->id)
            ->where(\DB::raw('MONTH(created_at)'), $i)
            ->sum('grandtotal');
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


  private function shareprofit(){
    $res = [];
    foreach(view_currencies_used_share_profit::all() as $crc){
      $total = data_share_profit_bandung::whereIn('status', [1,2])->where('currenci_id', $crc->id)->sum('subtotal');
      $res[] = [
        'iso' => $crc->iso,
        'total' => number_format($total,2,'.',',')
      ];
    }
    return $res;
  }

  public function usetempate(Request $req){
    if($req->ajax()){
      $spa = data_spa::find($req->id_spa);
      if($spa != null)
        $spa->update([
          'template_id' => $req->template_id
        ]);

      return response()->json([
        'result' => true,
        'err' => 'Template used'
      ]);

    }
  }

  // SERVICE PACK
  public function optionearchservice(Request $req){
    if($req->ajax()){
      $res = [];

      // All SPa By Region
      $option = '<option value="" selected>Select All</option>';
      foreach (ref_regional::all() as $val) {

        $spas = data_spa::leftJoin('data_servicepack', 'data_servicepack.id_spa', '=', 'data_spa.id_spa')
          ->where('data_spa.id_regional', $val->id_regional)
          ->orderby('data_spa.premium', 'DESC')
          ->orderby('jumlah', 'DESC')
          ->orderby('data_spa.spa', 'ASC')
          ->groupby('data_spa.id_spa')
          ->select([
            'data_spa.id_spa',
            'data_spa.spa',
            \DB::raw('COUNT(data_servicepack.id_spa) AS jumlah')
            ])->get();

        if(count($spas) > 0):
          $option .= '<optgroup label="' . $val->nm_regional . '">';
          foreach($spas as $spa){
              $option .= '<option value="' . $spa->id_spa . '">' . $spa->spa . ' (' . $spa->jumlah . ')</option>';
          }
          $option .= '</optgroup>';
        endif;
      }

      // Currencies
      $currencies = '<option value="" selected>Select All</option>';
      foreach(view_currencies_used::all() as $crc){
        $currencies .= '<option value="' . $crc->id . '">' . $crc->iso . '</option>';
      }

      $res['allspa'] = $option;
      $res['currencies'] = $currencies;
      return response()->json($res);
    }

  }

  public function searchservices(Request $req){
      if($req->ajax()){
        $res = [];
        $out = '';
        // dd($req->all());
        $items = data_servicepack::allservicepack($req->all())->paginate(12);
        if(count($items) > 0):
          foreach($items as $item){
            $discount = $item->discount > 0 ? '<span class="discount">' . $item->discount . '%</span>' : '';
            $coret = $item->discount > 0 ? '<li><strike class="text-danger">PRICE ' . number_format($item->price_publish,2,'.',',') . '  ' . $item->iso_code . '</strike></li>' : '<br />';
            $out .= '
            <div class="col-lg-4 col-md-4 col-sm-4" style="margin-bottom:30px;">
              <ul class="pro-box">
                <li class="pro">
                  ' . $discount . '
                  <div class="block-image"> <img class="img-responsive" src="' . asset('/img/servicepack/' . $item->img_thumbnail) . '" alt="' . $item->servicepack  . '">
                    <div class="img-overlay-3-up pat-override"></div>
                    <div class="img-overlay-3-down pat-override"></div>
                  </div>
                  <span class="addtocart"><a href="' . url($item->slug_spa . '/book/' . $item->slug) . '">Book Now</a></span>
                </li>
                <li>
                  <h4 style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 100%;display: inline-block;margin-bottom:0;"><a href="' . url($item->slug_spa . '/servicepack/' . $item->slug) . '" title="' . $item->servicepack . '">' . $item->servicepack . '</a></h4>
                  <strong><a href="' . url($item->slug_spa) . '">' . $item->spa . '</a></strong>
                </li>
                ' . $coret . '
                <li class="pro-footer">
                  <a href="' . url($item->slug_spa . '/servicepack/' . $item->slug) . '" title="' . $item->servicepack . '" class="btn btn-default">
                    DETAIL ' . number_format(($item->price_publish - (($item->price_publish * $item->discount) / 100)),2,'.',',') . ' ' . $item->iso_code . '
                  </a>
                </li>
              </ul>
            </div>
            ';
          }
        else:
          $out .= '<br /><h3>Service or Package not found</h3>';
        endif;

        $res['content'] = $out;
        $res['pagination'] = (STRING) $items->links('vendor.pagination.default');
        return response()->json($res);
      }
  }

}
