<?php

namespace App\Http\Controllers\Menus;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Jobs\Menus\RepositionMenuJob;
use App\Jobs\Menus\CreateMenuJob;
use App\Jobs\Menus\editMenuJob;

use App\Models\level;
use App\Models\navigasi;
use App\Models\akses_navigasi;

class MenuController extends Controller {


    public function index() {

    	$data['breadcrumb'] = [
            [
                'name' => 'Home',
                'link' => '/home'
            ],
            [
                'name' => 'Daftar Menu',
                'link' => 'javascript:void(0);'
            ]
        ];

        return view('Menus.Index', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $data['levels'] = level::all();

        $data['breadcrumb'] = [
            [
                'name' => 'Home',
                'link' => '/home'
            ],
            [
                'name' => 'Tambah Menu',
                'link' => 'javascript:void(0);'
            ]
        ];

        return view('Menus.Create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req){

        dispatch(new CreateMenuJob($req->all()));
        return redirect('/menu');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

        $data['levels'] = level::all();

        $data['breadcrumb'] = [
            [
                'name' => 'Home',
                'link' => '/home'
            ],
            [
                'name' => 'Edit Menu',
                'link' => 'javascript:void(0);'
            ]
        ];

        $akses = [];
        foreach(akses_navigasi::where('navigasi_id', $id)->select('level_id')->get() as $ak){
            $akses[] = $ak->level_id;
        }

        $data['nav'] = navigasi::find($id);
        $data['akses'] = $akses;

        return view('Menus.Edit', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $data['levels'] = level::all();

        $data['breadcrumb'] = [
            [
                'name' => 'Home',
                'link' => '/home'
            ],
            [
                'name' => 'Edit Menu',
                'link' => 'javascript:void(0);'
            ]
        ];

        $akses = [];
        foreach(akses_navigasi::where('navigasi_id', $id)->select('level_id')->get() as $ak){
            $akses[] = $ak->level_id;
        }

        $data['nav'] = navigasi::find($id);
        $data['akses'] = $akses;

        return view('Menus.Edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id){

        dispatch(new editMenuJob($req->all()));
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){

        navigasi::find($id)->delete();
        akses_navigasi::where('navigasi_id', $id)->delete();
        return response()->json([
            'err' => 'Menu berhasil dihapus',
            'id' => $id
        ]);

    }

    // Other Request
    public function reposition(Request $req){
        dispatch(new RepositionMenuJob($req->all()));
        return response()->json([
            'err' => '<i class="md md-check"></i> Posisi menu berhasil disimpan'
        ]);
    }

    // Akses Menu User
    public function akses_menu(){
        $data['levels'] = level::all();

        $data['breadcrumb'] = [
            [
                'name' => 'Home',
                'link' => '/home'
            ],
            [
                'name' => 'Akses Halaman',
                'link' => 'javascript:void(0);'
            ]
        ];

        return view('Menus.AksesMenu', $data);
    }

    public function listpages(Request $req){
        if($req->ajax()){
            $res = [];
            $out = '';

            $akses = [];
            $db_akses = akses_navigasi::where('level_id', $req->id)->get();
            foreach($db_akses as $ses){
                $akses[] = $ses->navigasi_id;
            }

            $level = level::find($req->id);

            $out .= '<ul id="tree">';
            foreach(navigasi::whereParent_id(0)->orderby('seri', 'asc')->get() as $nav):
                $checked = in_array($nav->id, $akses) ? 'checked' : '';
                $out .= '<li>';
                $out .= '<div class="checkbox checkbox-styled tile-text" style="margin:0;">
                        <label>
                            <input type="checkbox" value="' . $nav->id . '" name="id[]" ' . $checked . ' />
                            <span style="padding-left:50px;">
                                ' . $nav->title . '
                            </span>
                        </label>
                    </div>
                    ';

                    // Anak
                    $anaks = navigasi::whereParent_id($nav->id)->orderby('seri', 'asc')->get();
                    if(count($anaks) > 0): // count 1
                        $out .= '<ul>';
                        foreach($anaks as $anak):
                            $checked = in_array($anak->id, $akses) ? 'checked' : '';
                            $out .= '<li>';
                            $out .= '
                                <div class="checkbox checkbox-styled tile-text" style="margin:0;">
                                    <label>
                                        <input type="checkbox" value="' . $anak->id . '" name="id[]" ' . $checked . ' />
                                        <span style="padding-left:50px;">
                                            ' . $anak->title . '
                                        </span>
                                    </label>
                                </div>
                            ';

                            // Cucu
                            $cucus = navigasi::whereParent_id($anak->id)->orderby('seri', 'asc')->get();
                            if(count($cucus) > 0): // count 2
                                $out .= '<ul>';
                                foreach($cucus as $cucu):
                                $checked = in_array($cucu->id, $akses) ? 'checked' : '';
                                $out .= '<li>';
                                $out .= '<div class="checkbox checkbox-styled tile-text" style="margin:0;">
                                            <label>
                                                <input type="checkbox" value="' . $cucu->id . '" name="id[]" ' . $checked . ' />
                                                <span style="padding-left:50px;">
                                                    ' . $cucu->title . '
                                                </span>
                                            </label>
                                        </div>

                                    </li>';
                                endforeach;
                                $out .= '</ul>';
                            endif; // end count 2

                        $out .= '</li>';
                    endforeach;
                    $out .= '</ul>';
                endif; // end count 1

                $out .= '</li>';
            endforeach;

            $out .= '</ul>';

            $res['header'] = '<i class="fa fa-unlock-alt"></i> Akses Halaman ' . $level->nm_level;
            $res['content'] = $out;
            $res['level_id'] = $req->id;

            return response()->json($res);

        }
    }

    public function savelistpages(Request $req){
        akses_navigasi::where('level_id', $req->level_id)->delete();
        foreach($req->id as $id){
            akses_navigasi::create([
                'level_id' => $req->level_id,
                'navigasi_id' => $id
            ]);
        }

        return redirect()->back()->withNotif([
            'label' => 'success',
            'err' => 'Akses halaman berhasil tersimpan'
        ]);

    }

}
