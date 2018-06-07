<?php

namespace App\Events\Booking;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

use App\Models\data_booking;

class imageThumbSpaEvent {

    use InteractsWithSockets, SerializesModels;

    public function __construct($base_name, $id) {
      $dir = public_path('img/spa/');
      if(!empty($_FILES['img_thumbnail']['tmp_name'])):

        $protect = ['default.jpg'];
        $spa = data_spa::find($id);

        $fl_name    = $base_name;
        $file = file_get_contents($_FILES['img_thumbnail']['tmp_name']);
        \Image::make($file)->fit(300, 300)->save($dir . $fl_name);
        \Image::make($file)->fit(150, 150)->save($dir . 'thumb/' . $fl_name);

        if(file_exists($dir . $spa->img_thumbnail)){
          if(!in_array($spa->img_thumbnail, $protect))
            unlink($dir . $spa->img_thumbnail);
        }
        if(file_exists($dir . '/thumb/' . $spa->img_thumbnail)){
          if(!in_array($spa->img_thumbnail, $protect))
            unlink($dir . '/thumb/' . $spa->img_thumbnail);
        }

      endif;
    }

}
