<?php

namespace App\Events\Merchant;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\data_merchant;

class imageThumbMerchantEvent {

    use InteractsWithSockets, SerializesModels;

    public function __construct($base_name, $id) {
      if(!empty($_FILES['img_thumbnail']['tmp_name'])):
        $dir = public_path('img/merchant/');
        $fl_name    = $base_name;
        $file = file_get_contents($_FILES['img_thumbnail']['tmp_name']);
        \Image::make($file)->fit(300, 300)->save($dir . $fl_name);
        \Image::make($file)->fit(150, 150)->save($dir . 'thumb/' . $fl_name);

        // Edit
        if($id > 0):
          $protect = ['default.jpg'];
          $merchant = data_merchant::find($id);
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


      // Upload Logo
      if(!empty($_FILES['logo_img']['tmp_name'])):
        $dir = public_path('img/logo/');
        $fl_name    = $base_name;
        $file = file_get_contents($_FILES['logo_img']['tmp_name']);
        \Image::make($file)->save($dir . $fl_name);
        // Edit
        if($id > 0):
          $protect = ['default.png'];
          $merchant = data_merchant::find($id);
          if(file_exists($dir . $merchant->img_thumbnail)){
            if(!in_array($merchant->img_thumbnail, $protect))
              unlink($dir . $merchant->img_thumbnail);
          }
        endif;
      endif;

    }

}
