<?php

namespace App\Events\Merchant;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\data_servicepack;

class UploadImageThumbEvent {
    use InteractsWithSockets, SerializesModels;

    public function __construct($params, $id) {
      $dir = public_path('img/servicepack/');
      if(!empty($_FILES['img_thumb']['tmp_name'])):
        $fl_name    = $params['img_thumbnail'];
        $file = file_get_contents($_FILES['img_thumb']['tmp_name']);
        \Image::make($file)->fit(500, 500)->save($dir . $fl_name);
        \Image::make($file)->fit(150, 150)->save($dir . 'thumb/' . $fl_name);

        // Edit
        if($id > 0):
          $protect = ['default.png'];
          $merchant = data_servicepack::find($id);
          if(file_exists($dir . $merchant->img_thumbnail)){
            if(!in_array($merchant->img_thumbnail, $protect))
              unlink($dir . $merchant->img_thumbnail);
          }
          if(file_exists($dir . '/thumb/' . $merchant->img_thumbnail)){
            if(!in_array($merchant->img_thumbnail, $protect))
              unlink($dir . '/thumb/' . $merchant->img_thumbnail);
          }
        endif;

      endif;
    }

}
