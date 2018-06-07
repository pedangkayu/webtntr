<?php

namespace App\Jobs\Bandung;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\data_invoice_bandung;
use App\Models\data_invoice_item_bandung;
use App\Models\data_share_profit_bandung;

use App\Events\Bandung\PayoutEvent;

class PayoutJob implements ShouldQueue {

    use InteractsWithQueue, Queueable, SerializesModels;

    public $req;

    public function __construct($req) {
        $this->req = $req;
    }

    public function handle() {

      $me = \Auth::user();
      $send = [];
      try {

        if(empty($this->req['grandtotal']))
          throw new \Exception("Grandtotal undefined", 1);

        if(empty($this->req['ids']))
          throw new \Exception("Items undefined", 1);

        \DB::begintransaction();

          foreach($this->req['currenci_id'] as $i => $id_c){

            if(!empty($this->req['ids'][$id_c])):
              $data['note'] = $this->req['note'];
              $data['user_id'] = $me->id;
              $data['status'] = 1;
              $data['grandtotal'] = $this->req['grandtotal'][$i];
              $data['currenci_id'] = $id_c;
              $data['code'] = 'INV/' . date('dmy/') . time() . rand(0,10);
              $invoice = data_invoice_bandung::create($data);
              // Item invoice
              foreach($this->req['ids'][$id_c] as $id){
                $share = data_share_profit_bandung::find($id);
                $dta = $share->toArray();
                unset($dta['id']);
                unset($dta['created_at']);
                unset($dta['updated_at']);
                unset($dta['deleted_at']);
                $dta['invoice_id'] = $invoice->id;
                $dta['old_id'] = $id;
                data_invoice_item_bandung::create($dta);
                $share->update([
                  'status' => 2
                ]);
              }

              $send[] = [
                'id' => $invoice->id,
                'code' => $invoice->code
              ];

            endif;

          }

        \DB::commit();

        $sends['by'] = $me->name;
        $sends['user_id'] = $me->id;
        $sends['note'] = $this->req['note'];
        $sends['items'] = $send;
        event(new PayoutEvent($sends));

        session()->flash('err', [
          'result' => true,
          'label' => 'success',
          'err' => 'Invoice was created'
        ]);

      } catch (\Exception $e) {
        \DB::rollback();
        session()->flash('err', [
          'result' => false,
          'label' => 'danger',
          'err' => $e->getMessage()
        ]);

      }


    }
}
