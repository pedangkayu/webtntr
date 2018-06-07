<?php

namespace App\Listeners\Bandung;

use App\Events\Bandung\VerificationEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;
use App\Models\ref_currencies;
use App\Models\data_invoice_bandung;
use App\Models\data_share_profit_bandung;
use App\Models\data_invoice_item_bandung;

use App\Mail\Bandung\SendInvoicePaidMail;

class SendInvoicePaidAdminListener {

    public $path;
    public $config;
    public function __construct() {
      $this->path = storage_path('/tmp/pdf/');
      $this->config = \Format::paladin();
    }

    public function handle(VerificationEvent $event) {
      
      $file = $this->path . time() . uniqid() . '.pdf';
      $pdf['item'] = data_invoice_bandung::find($event->data['id']);
      $pdf['items'] = data_invoice_item_bandung::byid($event->data['id'])->get();
      $pdf['crc'] = ref_currencies::find($pdf['item']->currenci_id);
      $pdf['user'] = User::find($pdf['item']->user_id);
      $pdf['config'] = \Format::paladin();
      $pdf['status'] = [
        1 => public_path('/img/unpaid.jpg'),
        2 => public_path('/img/paid.jpg')
      ];
      \PDF::loadView('Pdf.Bandung.Invoice', $pdf)->save($file);


      $data = $event->data;
      $data['file'] = $file;
      \Mail::to($this->config->email)
        ->send(new SendInvoicePaidMail($data));

        if(file_exists($file))
          @unlink($file);

    }
}
