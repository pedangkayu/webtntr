<?php

namespace App\Http\Controllers\Spa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\data_spa;
use App\Models\data_schedule;

use App\Jobs\Spa\Schedule\CreateScheduleJob;
use App\Jobs\Spa\Schedule\EditeScheduleJob;

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
      $spa = data_spa::find($id);
      if($spa == null)
        abort(404);

      $data['spa'] = $spa;

      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Spa',
              'link' => '/spa'
          ],
          [
              'name' => 'Detail',
              'link' => '/spa/' . $id
          ],
          [
              'name' => 'Schedule ' . $spa->spa,
              'link' => 'javascript:void(0);'
          ]
      ];
      return view('Spa.Schedule.Index', $data);
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
      $spa = data_spa::find($id);
      if($spa == null)
        abort(404);

      $data['spa'] = $spa;
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Spa',
              'link' => '/spa'
          ],
          [
              'name' => 'Detail',
              'link' => '/spa/' . $id
          ],
          [
              'name' => 'Schedule ',
              'link' => '/spa/schedule?referal=' . $req->referal . '&_k=' . csrf_token()
          ],
          [
              'name' => 'Create ' . $spa->spa,
              'link' => 'javascript:void(0);'
          ]
      ];

      return view('Spa.Schedule.Create', $data);

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
        return redirect('/spa/schedule/' . $id . '/edit');
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
              'name' => 'All Spa',
              'link' => '/spa'
          ],
          [
              'name' => 'Detail',
              'link' => '/spa/' . $id
          ],
          [
              'name' => 'Edit Schedule',
              'link' => '/spa/schedule?referal=' . $jadwal->id_spa . '&_k=' . csrf_token()
          ],
          [
              'name' => 'Create',
              'link' => 'javascript:void(0);'
          ]
      ];
      return view('Spa.Schedule.Edit', $data);
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
