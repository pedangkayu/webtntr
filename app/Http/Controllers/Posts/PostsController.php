<?php

namespace App\Http\Controllers\Posts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\posts;
use App\Models\languages;
use App\Models\tags;
use Carbon\Carbon;
use App\Models\categories;
use App\Models\categori_posts;
use App\Models\post_tags;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
	 * tampilkan hanya 
     */
    public function index()
    {   
        $rows = posts::groupBy('code_posts')->orderBy('type', 'DESC')->orderBy('date_add', 'DESC')->where('type', '!=', 3)->get();
        return view('Posts.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = categories::where('lang_id', 2)->where('status', 1)->get();
        $tags = tags::pluck('name')->toArray();
        $languages = languages::where('status', '1')->orderBy('sort_number')->get();
        return view('Posts.create', compact('languages', 'tags', 'categories'));
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //return $request->all();
        $first	= 'image/';
        $png	= 'png';
        $jpeg	= 'jpeg';
        $jpg	= 'jpg';

        $typePost = $request->get('type');
        $title = $request->get('judul');
        $post = $request->get('post');
        $status = $request->get('status');
			if ($typePost != 0) {
				if ($request->get('newImage') != 'null') {
					$newImage = $request->get('newImage');
					$exp = explode(',', $newImage);
					$base64 = array_pop($exp);
					$image = base64_decode($base64);
					$file = 'image.png';
					file_put_contents($file, $image);
					$getImage = response()->file($file);
					$width = getimagesize($file)['0'];
					$height = getimagesize($file)['1'];
					$pos  = strpos($newImage, ';');
					$type = explode(':', substr($newImage, 0, $pos))[1];
					$getType = substr($type, 6);

						if ($getType == $png | $getType == $jpeg | $getType == $jpg) {
							$pathOriginal = public_path('img/posts/');
							$pathThumb = public_path('img/posts/thumb/');
							$exp = explode(',', $newImage);
							$base64 = array_pop($exp);
							$image = base64_decode($base64);
							$file = 'image.png';
							file_put_contents($file, $image);
							$getImage = response()->file($file);
							$width = getimagesize($file)['0'];
							$height = getimagesize($file)['1'];
							$imageName = Carbon::now('Asia/Jakarta')->format('YmdHis');
							$imageName = $imageName.'.'.$getType;
							\Image::make(public_path($file))->resize(820, 820)->encode('jpg')->save($pathOriginal.'/'.$imageName);
							\Image::make(public_path($file))->resize(300, 300)->encode('jpg')->save($pathThumb.'/'.$imageName);
							$newImage = $imageName;
								} else {
									return redirect('/posts')->withNotif([
										'label' => 'warning',
										'err' => 'Format gambar harus PNG atau JPG',
									]);
								}

									} else {
										$newImage = 'null';
									}

										$reqtags = $request->get('tag');
										$tags = explode(',', $reqtags);
										$kategori = $request->get('kategori');
										} else {
											$newImage = '';
										}
											if ($typePost == 2) {
												$latitude = $request->get('latitude');
												$longitude = $request->get('longitude');
												$date_schedule_start = date('Y-m-d', strtotime($request->get('jadwal_agenda_mulai')));
												$date_schedule_end = date('Y-m-d', strtotime($request->get('jadwal_agenda_selesai')));
													} else {
														$latitude = '';
														$longitude = '';
														$date_schedule_start = '';
														$date_schedule_end = '';
													}

												$languages = languages::where('status', '1')->orderBy('sort_number')->get();
												$sort = 0;
												$dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
												$code = substr(strtoupper(md5(uniqid(rand(), true))), 0, 10);


        /*
        //SAVE WITH CROPPING
        if ($request->file('file')) {
            $ext = $request->all()['file']->getClientOriginalExtension();
            $dir = public_path('img/headers/');

            $base_name  = rand(11111,99999) . time();
            $fl_name    = $base_name.'.'.$ext;
            $file = file_get_contents($_FILES['file']['tmp_name']);

            \Image::make($file)->crop($request->get('w'), $request->get('h'), $request->get('x'), $request->get('y'))->save($dir.$fl_name);
            \Image::make($file)->crop($request->get('w'), $request->get('h'), $request->get('x'), $request->get('y'))->fit(140, 140)->save($dir.'thumb/'.$fl_name);
        }
        */

				foreach ($languages as $key => $value) {
					$posts = posts::create([
							'lang_id'               => array_keys($title)[$sort++],
							'type'                  => $typePost,
							'title'                 => $title[$value->id],
							'slug'                  => preg_replace('/[^A-Za-z0-9-]+/', '-', $title[$value->id]),
							'post'                  => $post[$value->id],
							'status'                => $status,
							'latitude'              => $latitude,
							'longitude'             => $longitude,
							'date_schedule_start'   => $date_schedule_start,
							'date_schedule_end'     => $date_schedule_end,
							'created_by'            => \Auth::user()->id,
							'date_add'              => $dateNow,
							'code_posts'            => $code,
							'thumb'                 => $newImage,

							]);
				}

				//return $posts->code_posts;
				if ($typePost != 0 ) {
					if (count($tags)) {
						foreach ($tags as $key => $value) {
							$checktag = tags::where('name', $value)->first();
							if (!$checktag) {
								tags::create([ 'name' => $value ]);
							}
						}
						$getTag = tags::whereIn('name', $tags)->get();
						foreach ($getTag as $key => $value) {
							$post_tags = post_tags::create([
									'code_posts'   => $posts->code_posts,
									'tag_id'       => $value->id,
								]);
						}
					}

							if (count($kategori)) {
								foreach ($kategori as $key => $value) {
									$categori_post = categori_posts::create([
											'code_categories'   => $value,
											'code_posts'        => $posts->code_posts,
										]);
								}
							}
						}

							return redirect('/posts')->withNotif([
								'label' => 'success',
								'err' => 'Data Berhasil di simpan'
							]);

						}





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        return $code;
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $postFirst = posts::where('code_posts', $code)->first();
        $pluckTags = post_tags::where('code_posts', $code)->pluck('tag_id')->toArray();
        $toFormTags = tags::whereIn('id', $pluckTags)->pluck('name')->toArray();
        $formTags = implode(',', $toFormTags);
        $formCategories = categori_posts::where('code_posts', $code)->pluck('code_categories')->toArray();
        $categories = categories::where('lang_id', 2)->where('status', 1)->get();
        $tags = tags::pluck('name')->toArray();
        $languages = languages::where('status', '1')->orderBy('sort_number')->get();
        return view('Posts.edit', compact('categories', 'tags', 'languages', 'code', 'postFirst', 'formTags', 'formCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {   
        $first	= 'image/';
        $png	= 'png';
        $jpeg	= 'jpeg';
        $jpg	= 'jpg';

        $typePost = $request->get('type');
        $title = $request->get('judul');
        $post = $request->get('post');
        $status = $request->get('status');

        if ($typePost != 0) {
            if ($request->get('newImage') != 'null') {
                $newImage = $request->get('newImage');
                $exp = explode(',', $newImage);
                $base64 = array_pop($exp);
                $image = base64_decode($base64);
                $pos  = strpos($newImage, ';');
                $type = explode(':', substr($newImage, 0, $pos))[1];
                $getType = substr($type, 6);
                $file = 'image.'.$getType;
                file_put_contents($file, $image);
                //$getImage = response()->file($file);
                $width = getimagesize($file)['0'];
                $height = getimagesize($file)['1'];

                if ($getType == $png | $getType == $jpeg | $getType == $jpg) {
                    $pathOriginal = public_path('img/posts/');
                    $pathThumb = public_path('img/posts/thumb/');
                    $exp = explode(',', $newImage);
                    $base64 = array_pop($exp);
                    $image = base64_decode($base64);
                    $file = 'image.png';
                    file_put_contents($file, $image);
                    $width = getimagesize($file)['0'];
                    $height = getimagesize($file)['1'];
                    $imageName = Carbon::now('Asia/Jakarta')->format('YmdHis');
                    $imageName = $imageName.'.'.$getType;
                    \Image::make(public_path($file))->resize(820, 820)->encode('jpg')->save($pathOriginal.'/'.$imageName);
                    \Image::make(public_path($file))->resize(300, 300)->encode('jpg')->save($pathThumb.'/'.$imageName);
                    $newImage = $imageName;

                } else {
                    return redirect('/posts')->withNotif([
                        'label' => 'warning',
                        'err' => 'Format gambar harus PNG atau JPG',
                    ]);
                }

            } else {
                $lastData = posts::where('code_posts', $code)->first();
                $newImage = $lastData->thumb;
            }

            $reqtags = $request->get('tag');
            $tags = explode(',', $reqtags);
            $kategori = $request->get('kategori');
				} else {
					$newImage = '';
				}

				if ($typePost == 2) {
					$latitude = $request->get('latitude');
					$longitude = $request->get('longitude');
					$date_schedule_start = date('Y-m-d', strtotime($request->get('jadwal_agenda_mulai')));
					$date_schedule_end = date('Y-m-d', strtotime($request->get('jadwal_agenda_selesai')));
						} else {
							$latitude = '';
							$longitude = '';
							$date_schedule_start = '';
							$date_schedule_end = '';
						}
							
							$languages = languages::where('status', '1')->orderBy('sort_number')->get();
							$sort = 0;
							$dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
							
							foreach ($languages as $key => $value) {
								$posts = posts::where('lang_id', $value->id)->where('code_posts', $code)->update([
										'lang_id'               => array_keys($title)[$sort++],
										'type'                  => $typePost,
										'title'                 => $title[$value->id],
										'slug'                  => preg_replace('/[^A-Za-z0-9-]+/', '-', $title[$value->id]),
										'post'                  => $post[$value->id],
										'status'                => $status,
										'thumb'                 => $newImage,
										'latitude'              => $latitude,
										'longitude'             => $longitude,
										'date_schedule_start'   => $date_schedule_start,
										'date_schedule_end'     => $date_schedule_end,
										'last_update_by'        => \Auth::user()->id,


										]);
							}



				if ($typePost != 0) {
					if (count($tags)) {
						foreach ($tags as $key => $value) {
							$checktag = tags::where('name', $value)->first();
							if (!$checktag) {
								tags::create([ 'name' => $value ]);
							}
						}
						$getTag = tags::whereIn('name', $tags)->get();
						post_tags::where('code_posts', $code)->delete();
						foreach ($getTag as $key => $value) {
							$post_tags = post_tags::create([
								'code_posts'   => $code,
								'tag_id'       => $value->id,
							]);                    
						}
					}

					if (count($kategori)) {
						categori_posts::where('code_posts', $code)->delete();
						foreach ($kategori as $key => $value) {
							$categori_post = categori_posts::create([
									'code_categories'   => $value,
									'code_posts'        => $code,
								]);
						}
					}
				}

        return redirect('/posts')->withNotif([
            'label' => 'success',
            'err' => 'Data Berhasil di edit'
        ]);

    }

    /**
     * Remove the specified resource from storage.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ajaxLanguages()
    {
        $lang = languages::where('status', 1)->get();
        return response()->json($lang);
    }

}
