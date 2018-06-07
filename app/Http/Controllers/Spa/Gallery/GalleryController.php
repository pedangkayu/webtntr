<?php

namespace App\Http\Controllers\Spa\Gallery;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\data_spa;
use App\Models\data_gallerys;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req) {

      if(empty($req->referal))
        abort(404);

      $id = base64_decode($req->referal);
      $spa = data_spa::find($id);
      if($spa == null)
        abort(404);

      $data['spa'] = $spa;

      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Spa',
              'link' => '/spa'
          ],
          [
              'name' => 'Detail',
              'link' => '/spa/' . $id
          ],
          [
              'name' => 'Gallery ' . $spa->spa,
              'link' => 'javascript:void(0);'
          ]
      ];
      return view('Spa.Gallery.Index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req) {

      if(empty($req->referal))
        abort(404);

      $id = base64_decode($req->referal);
      $spa = data_spa::find($id);
      if($spa == null)
        abort(404);

      $data['spa'] = $spa;
      $data['breadcrumb'] = [
          [
              'name' => 'Home',
              'link' => '/home'
          ],
          [
              'name' => 'All Spa',
              'link' => '/spa'
          ],
          [
              'name' => 'Detail',
              'link' => '/spa/' . $id
          ],
          [
              'name' => 'Schedule',
              'link' => '/spa/schedule?referal=' . $req->referal . '&_k=' . csrf_token()
          ],
          [
              'name' => 'Create',
              'link' => 'javascript:void(0);'
          ]
      ];

      return view('Spa.Gallery.Create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req) {

      $watermark = public_path('img/watermark.png');
      $watermark_sm = public_path('img/watermark_sm.png');

      $id = $req->id_spa;
      $base = $req->file->path();
      $path = public_path('img/gallery/');
      $ext = '.' . $req->file->extension();
      $filename = date('d_m_y_h_i_s') . sha1(microtime()) . uniqid() . $ext;
      $title = str_replace('.' . pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION), '', basename($_FILES['file']['name']));
      try {
        \Image::make(file_get_contents($base))
          ->insert($watermark, 'bottom-right', 40, 30)
          ->save($path . $filename);
        \Image::make(file_get_contents($base))->resize(null, 250, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->insert($watermark_sm, 'bottom-right', 20, 15)
            ->save($path . '/thumb/' . $filename);

        data_gallerys::create([
          'file' => $filename,
          'title' => $title,
          'id_spa' => $req->id_spa
        ]);

      } catch (\Exception $e) {
        if(file_exists($path . $filename)){
          @unlink($path . $filename);
        }
        if(file_exists($path . '/thumb/' . $filename)){
          @unlink($path . '/thumb/' . $filename);
        }
      }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect('/spa/gallery?referal=' . base64_encode($id) . '&_k=' . csrf_token());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
      return redirect('/spa/gallery?referal=' . base64_encode($id) . '&_k=' . csrf_token());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id) {
        $file = data_gallerys::find($id)->update([
          'title' => trim($req->title)
        ]);
        return response()->json([
          'result' => true,
          'err' => 'Image was updated successfull'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
      $file = data_gallerys::find($id);
      if($file !== null):
        $filename = $file->file;
        $path = public_path('img/gallery/');
        if(file_exists($path . $filename)){
          @unlink($path . $filename);
        }
        if(file_exists($path . '/thumb/' . $filename)){
          @unlink($path . '/thumb/' . $filename);
        }
        $file->delete();
      endif;
      return response()->json([
        'result' => true,
        'err' => 'File was deleted successfull'
      ]);
    }
}
