<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\ref_currencies;
use App\Models\data_servicepack;
use App\Models\data_merchant;

use App\Jobs\Merchant\createServicepactJob;
use App\Jobs\Merchant\EditServicePackJob;

use App\Events\Merchant\UploadImageThumbEvent;

class ServicepackController extends Controller
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
              'link' => url('/merchant')
          ],
          [
              'name' => 'Detail',
			  'link' => '/merchant/' . $id
          ],
          [
              'name' => 'Servicepack ' . $merchant->merchant,
              'link' => 'javascript:void(0);'
          ]
      ];
      return view('Merchant.Servicepack.Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req) {
      if(empty($req->get('reference')))
        return redirect('/merchant');

      $id = base64_decode($req->get('reference'));
      $data['merchant'] = data_merchant::find($id);

      $data['id'] = $id;
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Merchant',
              'link' => 'javascript:void(0);'
          ],
          [
              'name' => 'Servicepack',
              'link' => url('/merchant/servicepack?referal=' . $req->get('reference') . '&_k=' . csrf_token())
          ],
          [
              'name' => 'Create Servicepack',
              'link' => 'javascript:void(0);'
          ]
      ];

      $data['currencies'] = ref_currencies::active()->get();
      return view('Merchant.Servicepack.Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) {

      $filename = date('d_m_Y_') . sha1(md5(time())) . sha1(md5(strtotime('+10 hour'))) . '.jpg';
      $params = $req->all();
      // $images = $req->file('images');
      $params['img_thumbnail'] = empty($_FILES['img_thumb']['tmp_name']) ? 'default.png' : $filename;
      unset($params['img_thumb']);
      unset($params['images']);
      $this->dispatch(new createServicepactJob($params));
      $err = $req->session()->get('notif');
      if($err['id'] > 0){
        event(new UploadImageThumbEvent($params, 0));
        return redirect()->back();
      }else{
        return redirect()->back()->withInput();
      }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect('/merchant/servicepack/' . $id . '/edit');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      $service = data_servicepack::find($id);
      $data['data'] = $service;
      $data['id'] = $id;
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Merchant',
              'link' => 'javascript:void(0);'
          ],
          [
              'name' => 'Servicepack',
              'link' => url('/merchant/servicepack?referal=' . base64_encode($service->id_merchant) . '&_k=' . csrf_token())
          ],
          [
              'name' => 'Update Servicepack',
              'link' => 'javascript:void(0);'
          ]
      ];
      $data['currencies'] = ref_currencies::active()->get();
      return view('Merchant.Servicepack.Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id) {

      $filename = date('d_m_Y_') . sha1(md5(time())) . sha1(md5(strtotime('+10 hour'))) . '.jpg';
      $params = $req->all();
      $params['img_thumbnail'] = empty($_FILES['img_thumb']['tmp_name']) ? $req->img_thumbnail_old : $filename;
      event(new UploadImageThumbEvent($params, $id));
      unset($params['img_thumb']);
      unset($params['img_thumbnail_old']);
      $this->dispatch(new EditServicePackJob($params));
      $err = $req->session()->get('notif');
      return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $del = data_servicepack::find($id);
        if($del == null)
          return response()->json([
            'result' => true,
            'err' => 'Servicepack was deleted'
          ]);

        $del->delete();
        return response()->json([
          'result' => true,
          'err' => 'Servicepack was deleted'
        ]);
    }
}
