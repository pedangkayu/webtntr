<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;

use App\Events\Users\UploadAvatarEvent;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\level;

class UserController extends Controller {
	// GET
	public function index(){

		$data['users'] = User::items()->paginate(10);

		$data['breadcrumb'] = [
				[
						'name' => 'Home',
						'link' => '/home'
				],
				[
						'name' => 'All Users',
						'link' => 'javascript:void(0);'
				]
		];

		return view('Users.Index', $data);
	}

	public function show($id){

		$data['breadcrumb'] = [
				[
						'name' => 'Home',
						'link' => '/home'
				],
				[
						'name' => 'Update',
						'link' => 'javascript:void(0);'
				]
		];

		$user = User::find($id);

		if($user == null || $user->level_id == 1)
			abort(404);

		$data['user'] = $user;
		$data['levels'] = level::all();
		return view('Users.Show', $data);
	}

	public function update(Request $req, $id){

		$user = User::find($id);
		$data = $req->all();
		if(!empty($req->password))
			$data['password'] = bcrypt($req->password);
		else
			unset($data['password']);

		$user->update($data);
		return redirect()->back();
	}

	public function destroy($id) {
		$user = User::find($id);
		if($user != null)
			$user->delete();

		return response()->json([
			'result' => true,
			'err' => "User was deleted successfull"
		]);
	}

	public function anydata(Request $req){
		$items = User::items();
		return \Datatables::of($items)
		->editColumn('name', function ($item) {
				 return '<a href="' . url('/users/' . $item->id) . '">' . $item->name . '</a>';
		})
		->editColumn('avatar', function ($item) {
				 return '<img src="' . asset('/img/avatars/thumb/' . $item->avatar) . '" class="img-thumbnail" />';
		 })
		 ->editColumn('online', function ($item) {
 				 return strtotime($item->online) > time() ? '<i class="fa fa-circle text-success"></i>' : '<i class="fa fa-circle text-muted"></i>';
 		})
	 	->editColumn('id', function ($item) {
				return '<a href="javascript:void(0);" onclick="trash(\'' . $item->id . '\');" class="btn btn-block btn-xs btn-flat"><i class="fa fa-trash"></i></a>';
		})
		->make();
	}

  // GET
	public function profile(){


    	$data['breadcrumb'] = [
            [
                'name' => 'Home',
                'link' => '/home'
            ],
            [
                'name' => 'Profile',
                'link' => 'javascript:void(0);'
            ]
        ];

		$data['user'] = \Auth::user();
		return view('Users.Profile', $data);

	}

	public function updateprofile(Request $req){
			$fields = $req->all();
			unset($fields['_token']);
			$user = \Auth::user();
			$user->update($fields);
			return redirect()->back()->withNotif([
				'label' => 'success',
				'err' => 'Akun berhasil diperbaharui'
			]);
	}

	public function avatar(){
		$data['breadcrumb'] = [
            [
                'name' => 'Home',
                'link' => '/home'
            ],
            [
                'name' => 'Perbaharui Avatar',
                'link' => 'javascript:void(0);'
            ]
        ];


        // Default Avatars
        $data['avatars'] = [
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

        $data['user'] = \Auth::user();

		return view('Users.Avatar', $data);
	}

    // POST
    public function updateakunlogin(Request $req){
        $this->validate($req, [
            'password' => 'required|min:6|confirmed',
        ]);

        \Auth::user()->update([
            'password' => bcrypt($req->password)
        ]);

        return redirect()->back()->withNotif([
            'label' => 'success',
            'err' => 'Akses user berhasil diperbaharui'
        ]);
    }

    public function updateavatarfromlist(Request $req){
        if($req->ajax()){

            $dir = public_path('img/avatars/');

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
                if(file_exists($dir . 'thumb/' . $user->avatar))
                    unlink($dir . 'thumb/' . $user->avatar);
            }

            $user->update([
                'avatar' => $req->val
            ]);

            return response()->json([
                'err' => 'Avatar berhasil diperbaharui'
            ]);
        }
    }

    public function updateavatarfromfile(Request $req){
        event(new UploadAvatarEvent($req->all()));
				$err = $req->session()->get('err');

        return redirect()->back()->withNotif([
          'label' => $err['label'],
          'err' => $err['err']
        ]);
    }


}
