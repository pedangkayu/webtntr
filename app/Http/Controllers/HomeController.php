<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Views\view_dashboard_count_booking AS total_book;

use App\Models\data_paladin;
use App\Models\data_share_profit_bandung;
use App\Models\Views\view_currencies_used_share_profit;

use App\Jobs\Bandung\PayoutJob;

class HomeController extends Controller {

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        //dd(\Menu::get('main'));

        $data['breadcrumb'] = [
            [
                'name' => 'Dashboard',
                'link' => 'javascript:void(0);'
            ]
        ];

        $data['book'] = total_book::first();

        return view('home', $data);
    }

    public function sharedetail(){

      $data['breadcrumb'] = [
          [
              'name' => 'Dashboard',
              'link' => url('/home')
          ],
          [
              'name' => 'Sahre Profit',
              'link' => 'javascript:void(0);'
          ],
      ];
      $data['status'] = [
        1 => 'Unpaid',
        2 => 'Moderator',
        3 => 'Paid'
      ];
      $data['items'] = [];
      foreach(view_currencies_used_share_profit::all() as $iso){
        $data['items'][$iso->iso] = data_share_profit_bandung::listtagihan($iso->id)->get();
      }

      return view('Bandung.Detail', $data);

    }


    public function payout(){

      $data['breadcrumb'] = [
          [
              'name' => 'Dashboard',
              'link' => url('/home')
          ],
          [
              'name' => 'Profit Payout',
              'link' => 'javascript:void(0);'
          ],
      ];
      $data['items'] = [];
      $data['ids'] = [];
      foreach(view_currencies_used_share_profit::all() as $iso){
        $data['ids'][$iso->iso] = $iso->id;
        $data['items'][$iso->iso] = data_share_profit_bandung::listtagihanpayout($iso->id)->get();
      }
      //  dd($data);
      return view('Bandung.Payout', $data);

    }

    public function storepayout(Request $req){
      $this->dispatch(new PayoutJob($req->all()));
      $err = $req->session()->get('err');

      if($err['result'])
        return redirect('/share/detail')
                  ->withNotif([
                    'label' => $err['label'],
                    'err' => $err['err']
                  ]);
      else
        return redirect()
                  ->back()
                  ->withInput()
                  ->withNotif([
                    'label' => $err['label'],
                    'err' => $err['err']
                  ]);

    }

    public function configuration(){
      $data['breadcrumb'] = [
          [
              'name' => 'Dashboard',
              'link' => url('/home')
          ],
          [
              'name' => 'App Configuration',
              'link' => 'javascript:void(0);'
          ],
      ];
      $item = \Format::paladin()->toArray();
      unset($item['id']);
      unset($item['created_at']);
      unset($item['updated_at']);
      unset($item['active']);
      $data['items'] = $item;
      return view('Settings.Configuration.Index', $data);
    }

    public function storeconfiguration(Request $req){

      data_paladin::find(1)->update($req->all());
      return redirect()->back()->withNotif([
        'label' => 'success',
        'err' => 'Update was succesfully'
      ]);

    }

}
