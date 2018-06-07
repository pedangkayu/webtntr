<?php

namespace App\Events\Users;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UploadAvatarEvent
{
    use InteractsWithSockets, SerializesModels;

    public function __construct($req) {

      try {

        if(empty($_FILES['avatar']['tmp_name']))
          throw new \Exception("Image not found", 1);


        $dir = public_path('img/avatars/');

        $base_name  = rand(11111,99999) . time();
        $fl_name    = $base_name . '.png';
        $file = file_get_contents($_FILES['avatar']['tmp_name']);

        \Image::make($file)->crop($req['w'], $req['h'], $req['x'], $req['y'])->fit(550, 550)->save($dir . $fl_name);
        \Image::make($file)->crop($req['w'], $req['h'], $req['x'], $req['y'])->fit(140, 140)->save($dir . 'thumb/' . $fl_name);

        $avatars = [
            'avatar.png',
            'avatar1.png',
            'avatar2.png',
            'avatar3.png',
            'avatar4.png',
            'avatar5.png',
            'avatar6.png',
            'avatar7.png',
            'avatar8.png',
        ];

        $user = \Auth::user();

        if(!in_array($user->avatar, $avatars)){
            if(file_exists($dir . $user->avatar))
                unlink($dir . $user->avatar);
            if(file_exists($dir . '/thumb/' . $user->avatar))
                unlink($dir . '/thumb/' . $user->avatar);
        }


        $user->update([
            'avatar' => $fl_name
        ]);

        session()->flash('err', [
            'result' => true,
            'label' => 'success',
            'err' => 'Avatar was uploaded'
        ]);

      } catch (\Exception $e) {
        session()->flash('err', [
            'result' => false,
            'label' => 'danger',
            'err' => $e->getMessage()
        ]);
      }




    }


}
