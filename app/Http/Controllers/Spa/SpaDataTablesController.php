<?php

namespace App\Http\Controllers\Spa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\data_spa;
use App\Models\data_booking;
use App\Models\data_schedule;
use App\Models\data_servicepack;

use App\Models\Views\view_currencies_used;

class SpaDataTablesController extends Controller {

    public function anydata(){
      $items = data_spa::listall();
      return \Datatables::of($items)
      ->editColumn('spa', function ($item) {
        $status = $item->status ? '<i class="fa fa-circle text-success pull-right" title="Online"></i>' : '<i class="fa pull-right fa-circle text-muted" title="Offline"></i>';
           return '
            <div><b>' . $item->spa . '</b> ' . $status . '</div>
            <small>[
                <a href="' . url($item->slug) . '" target="_blank" style="color:green;">Go Page</a> |
                <a style="color:green;" href="' . url('/spa/' . $item->id_spa . '') . '" title="Add service">Detail</a>
            ]</small>
           ';
       })
       ->editColumn('phone', function ($item) {
            return '<b>' . $item->phone . '</b>';
        })
      ->editColumn('nm_regional', function ($item) {
           return '<b>' . $item->nm_regional . '</b>';
       })
       ->editColumn('email', function ($item) {
            return '<b><a href="mailto:' . $item->email . '">' . $item->email . '</a></b>';
        })
        ->editColumn('premium', function ($item) {
            $checked = $item->premium ? 'checked' : '';
             return '<input type="checkbox" ' . $checked . ' name="premium" value="' . $item->id_spa . '">';
         })
       ->editColumn('img_thumbnail', function ($item) {
            return '<img width="60" class="img-thumbnail" src="' . asset('/img/spa/thumb/' . $item->img_thumbnail) . '">';
        })
        ->editColumn('id_spa', function ($item) {
             return '<b>' . $item->id_spa . '</b>';
         })
         ->editColumn('updated_at', function ($item) {
              return date('M d, Y', strtotime($item->updated_at));
          })
      ->make();
    }

    public function services($id){
      $items = data_servicepack::service($id);
      return \Datatables::of($items)
      ->editColumn('servicepack', function ($item) {
           return '
            <a href="' . url('/spa/servicepack/' . $item->id_servicepack . '/edit') . '">' . $item->servicepack . '</a>
           ';
       })
       ->editColumn('price_publish', function ($item) {
         $out = '<span style="float:right;">';
         $out .= $item->position == 'before' ? $item->symbol . ' ' : '';
         $out .=  number_format($item->price_publish);
         $out .= $item->position == 'after' ? ' ' . $item->symbol : '';
         $out . '</span>';
         return $out;
        })
       ->editColumn('iso_code', function ($item) {
            return '
             <div>' . $item->iso_code . ' ' . $item->symbol . '</div>
            ';
        })
       ->editColumn('img_thumbnail', function ($item) {
            return '<img width="60" class="img-thumbnail" src="' . asset('/img/servicepack/thumb/' . $item->img_thumbnail) . '">';
        })
        ->editColumn('id_servicepack', function ($item) {
             return '<a href="javascript:void(0);" onclick="trush(\'' . $item->id_servicepack . '\');" class="btn btn-block btn-flat"><i class="fa fa-trash"></i></a>';
         })
      ->make();
    }

    public function packages($id){
      $items = data_servicepack::package($id);
      return \Datatables::of($items)
      ->editColumn('servicepack', function ($item) {
           return '
            <a href="' . url('/spa/servicepack/' . $item->id_servicepack . '/edit') . '">' . $item->servicepack . '</a>
           ';
       })
       ->editColumn('price_publish', function ($item) {
          $out = '<span style="float:right;">';
          $out .= $item->position == 'before' ? $item->symbol . ' ' : '';
          $out .=  number_format($item->price_publish);
          $out .= $item->position == 'after' ? ' ' . $item->symbol : '';
          $out . '</span>';
          return $out;
        })
       ->editColumn('iso_code', function ($item) {
            return '
             <div>' . $item->iso_code . ' ' . $item->symbol . '</div>
            ';
        })
       ->editColumn('img_thumbnail', function ($item) {
            return '<img width="60" class="img-thumbnail" src="' . asset('/img/servicepack/thumb/' . $item->img_thumbnail) . '">';
        })
        ->editColumn('id_servicepack', function ($item) {
             return '<a href="javascript:void(0);" onclick="trush(\'' . $item->id_servicepack . '\');" class="btn btn-block btn-flat"><i class="fa fa-trash"></i></a>';
         })
      ->make();
    }

    public function premium(Request $req){

      $status = $req->state == "true" ? 1 : 0;
      data_spa::find($req->id)->update([
        'premium' => $status
      ]);

      return response()->json([
        'result' => true,
        'err' => 'Update was succesful'
      ]);

    }

    public function spastatisticbooking(Request $req){
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
            ->where('id_spa', $req->id)
            ->where('status', 3)
            ->count('id_booking');
        }

        // Total service
        for($i = 1; $i <= 12; $i++){
          $res['service']['total'][] = data_booking::where(\DB::raw('YEAR(created_at)'), $req->tahun)
            ->where('type', 1)
            ->where('status', 3)
            ->where('id_spa', $req->id)
            ->where(\DB::raw('MONTH(created_at)'), $i)
            ->count('id_booking');
        }

        // Total Package
        for($i = 1; $i <= 12; $i++){
          $res['package']['total'][] = data_booking::where(\DB::raw('YEAR(created_at)'), $req->tahun)
            ->where('type', 2)
            ->where('status', 3)
            ->where('id_spa', $req->id)
            ->where(\DB::raw('MONTH(created_at)'), $i)
            ->count('id_booking');
        }

        return response()->json($res);

      }
    }


    public function spastatisticincome(Request $req){
      if($req->ajax()){
        $res['result'] = true;
        $out = [];

        // Daftar Semua Bulan
        for($i = 1; $i <= 12; $i++){
          $res['bulan'][] = date('M', strtotime($req->tahun . '-' . $i));
        }

        foreach(view_currencies_used::all() as $crc){
          $data = [];
          $total = [];
          for($i = 1; $i <= 12; $i++){
            $gt = data_booking::where(\DB::raw('YEAR(created_at)'), $req->tahun)
              ->where('status', 3)
              ->where('currenci_id', $crc->id)
              ->where('id_spa', $req->id)
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

    public function anyschedule(Request $req, $id){
      $items = data_schedule::where('id_spa', $id)->select([
        'nm_schedule',
        'time_start',
        'status',
        'id'
        ])->get();
      return \Datatables::of($items)
      ->editColumn('nm_schedule', function ($item) {
           return '<a href="' . url('/spa/schedule/' . $item->id . '/edit') . '">' . $item->nm_schedule . '</a>';
       })
       ->editColumn('status', function ($item) {
            return $item->status ? 'YES' : 'NO';
        })
      ->editColumn('time_start', function ($item) {
           return date('d M Y \a\t\: H:i A', strtotime($item->time_start));
       })
       ->editColumn('id', function ($item) {
            return '<a href="javascript:void(0);" onclick="deleteschedule(\'' . $item->id . '\');" class="btn btn-block btn-flat"><i class="fa fa-trash"></i></a>';
        })
      ->make();
    }

}
