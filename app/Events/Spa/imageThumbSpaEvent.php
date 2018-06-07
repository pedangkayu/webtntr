<?php

namespace App\Events\Spa;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\data_spa;

class imageThumbSpaEvent {

    use InteractsWithSockets, SerializesModels;

    public function __construct($base_name, $id) {
      if(!empty($_FILES['img_thumbnail']['tmp_name'])):
        $dir = public_path('img/spa/');
        $fl_name    = $base_name;
        $file = file_get_contents($_FILES['img_thumbnail']['tmp_name']);
        \Image::make($file)->fit(300, 300)->save($dir . $fl_name);
        \Image::make($file)->fit(150, 150)->save($dir . 'thumb/' . $fl_name);

        // Edit
        if($id > 0):
          $protect = ['default.jpg'];
          $spa = data_spa::find($id);
          if(file_exists($dir . $spa->img_thumbnail)){
            if(!in_array($spa->img_thumbnail, $protect))
              unlink($dir . $spa->img_thumbnail);
          }
          if(file_exists($dir . '/thumb/' . $spa->img_thumbnail)){
            if(!in_array($spa->img_thumbnail, $protect))
              unlink($dir . '/thumb/' . $spa->img_thumbnail);
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
          $spa = data_spa::find($id);
          if(file_exists($dir . $spa->img_thumbnail)){
            if(!in_array($spa->img_thumbnail, $protect))
              unlink($dir . $spa->img_thumbnail);
          }
        endif;
      endif;

    }

}
