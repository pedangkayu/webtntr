<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\data_merchant;
use App\Models\data_schedule;

use App\Jobs\Merchant\Schedule\CreateScheduleJob;
use App\Jobs\Merchant\Schedule\EditeScheduleJob;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req) {
      if(empty($req->referal))
        abort(404);

      $id = base64_decode($req->referal);
      $merchant = data_merchant::find($id);
      if($merchant == null)
        abort(404);

      $data['merchant'] = $merchant;

      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Merchant',
              'link' => '/merchant'
          ],
          [
              'name' => 'Detail',
              'link' => '/merchant/' . $id
          ],
          [
              'name' => 'Schedule ' . $merchant->merchant,
              'link' => 'javascript:void(0);'
          ]
      ];
      return view('Merchant.Schedule.Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req){

      if(empty($req->referal))
        abort(404);

      $id = base64_decode($req->referal);
      $merchant = data_merchant::find($id);
      if($merchant == null)
        abort(404);

      $data['merchant'] = $merchant;
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Merchant',
              'link' => '/merchant'
          ],
          [
              'name' => 'Detail',
              'link' => '/merchant/' . $id
          ],
          [
              'name' => 'Schedule ',
              'link' => '/merchant/schedule?referal=' . $req->referal . '&_k=' . csrf_token()
          ],
          [
              'name' => 'Create ' . $merchant->merchant,
              'link' => 'javascript:void(0);'
          ]
      ];

      return view('Merchant.Schedule.Create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) {
        $this->dispatch(new CreateScheduleJob($req->all()));
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect('/merchant/schedule/' . $id . '/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

      $jadwal = data_schedule::find($id);
      $data['jadwal'] = $jadwal;
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Merchant',
              'link' => '/merchant'
          ],
          [
              'name' => 'Detail',
              'link' => '/merchant/' . $id
          ],
          [
              'name' => 'Edit Schedule',
              'link' => '/merchant/schedule?referal=' . $jadwal->id_merchant . '&_k=' . csrf_token()
          ],
          [
              'name' => 'Create',
              'link' => 'javascript:void(0);'
          ]
      ];
      return view('Merchant.Schedule.Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id) {
        $this->dispatch(new EditeScheduleJob($req->all()));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $del = data_schedule::find($id);
        if($del == null)
          return response()->json([
            'result' => true,
            'err' => 'Schedule was deleted'
          ]);

        $del->delete();
        return response()->json([
          'result' => true,
          'err' => 'Schedule was deleted'
        ]);
    }
}
