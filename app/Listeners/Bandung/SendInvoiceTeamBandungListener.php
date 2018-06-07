<?php

namespace App\Listeners\Bandung;

use App\Events\Bandung\PayoutEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Models\ref_currencies;
use App\Models\data_invoice_bandung;
use App\Models\data_share_profit_bandung;
use App\Models\data_invoice_item_bandung;

use App\Mail\Bandung\SendInvoiceTeamMail;

class SendInvoiceTeamBandungListener {

    public $path;

    public function __construct() {
      $this->path = storage_path('/tmp/pdf/');
    }

    public function handle(PayoutEvent $event) {
      $files = [];
      foreach($event->data['items'] as $item){
        $file = $this->path . time() . uniqid() . '.pdf';
        $files[] = $file;
        $pdf['item'] = data_invoice_bandung::find($item['id']);
        $pdf['items'] = data_invoice_item_bandung::byid($item['id'])->get();
        $pdf['crc'] = ref_currencies::find($pdf['item']->currenci_id);
        $pdf['user'] = User::find($pdf['item']->user_id);
        $pdf['config'] = \Format::paladin();
        $pdf['status'] = [
          1 => public_path('/img/unpaid.jpg'),
          2 => public_path('/img/paid.jpg')
        ];
        \PDF::loadView('Pdf.Bandung.Invoice', $pdf)->save($file);
      }

      $data = $event->data;
      $data['files'] = $files;

      $to = 'dwipayana@gmail.com';
      //$to = 'hexters.social@gmail.com';
      \Mail::to($to)
        ->cc('hexters@gmail.com')
        ->send(new SendInvoiceTeamMail($data));

        foreach($files as $file){
          if(file_exists($file))
            @unlink($file);
        }

    }
}
