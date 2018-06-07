<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\data_product;
use App\Models\languages;
use App\Models\data_merchant;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {
    	$rows = data_product::groupBy('code')->get();
    	return view('Product.index', compact('rows'));
    }

    public function create()
    {	
    	$merchants = data_merchant::where('status', 1)->get();
    	$languages = languages::where('status', '1')->orderBy('sort_number')->get();
    	return view('Product.create', compact('languages', 'merchants'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'lang.*' => 'required',
            'nama.*' => 'required',
            'slug.*' => 'required',
            'post.*' => 'required',
            'status' => 'required',
            'harga' => 'required',
            'file' => 'required|mimes:jpeg,jpg,png,PNG',

        ]);

    	$languages = languages::where('status', '1')->get();
    	$pathOriginal = public_path('img/produk/');
        $pathThumb = public_path('img/produk/thumb/');
    	$imageName = Carbon::now('Asia/Jakarta')->format('YmdHis');
    	$getType = $request->file('file')->getClientOriginalExtension();

        if ($getType == 'png' | $getType == 'PNG' | $getType == 'jpg' | $getType == 'jpeg') {
	        $imageName = $imageName.'.'.$getType;
	    	\Image::make($request->file('file'))->resize(640, 320)->encode('jpg')->save($pathOriginal.'/'.$imageName);
	        \Image::make($request->file('file'))->resize(300, 150)->encode('jpg')->save($pathThumb.'/'.$imageName);
	    	
        	$code = substr(strtoupper(md5(uniqid(rand(), true))), 0, 5);

	    	foreach ($languages as $key => $value) {

	    		data_product::create([

	    			'lang_id'			=> $request->get('lang')[$value->id],
	    			'id_merchant'		=> $request->get('merchant'),
	    			'product'			=> $request->get('nama')[$value->id],
	    			'slug'				=> $request->get('slug')[$value->id],
	    			'type'				=> 1,
	    			'price_publish'		=> preg_replace('/[^0-9]/', '', $request->get('harga')),
	    			'description'		=> $request->get('post')[$value->id],
	    			'img_thumbnail'		=> $imageName,
	    			'status'			=> $request->get('status'),
	    			'code'				=> $code

	    			]);
	    	
	    	}

	    	return redirect('/list-produk')->withNotif([
                        'label' => 'success',
                        'err' => 'Data berhasil disimpan',
                    ]);

	    } else {
	    	return redirect()->back()->withNotif([
                        'label' => 'warning',
                        'err' => 'Format gambar harus png, jpeg atau jpg',
                    ]);
	    }
    }

    public function edit($code)
    {
        $languages = languages::where('status', '1')->get();
        $product = data_product::where('code', $code)->get();
        $productMerchant = data_product::where('code', $code)->first();
        $merchantSelected = data_merchant::where('status', 1)->where('id_merchant', $productMerchant->id_merchant)->first();
        $price = 'Rp. '.number_format($productMerchant->price_publish);
        $merchants = data_merchant::where('status', 1)->get();
        return view('Product.edit', compact('price', 'productMerchant', 'product', 'merchantSelected', 'merchants', 'languages', 'code'));
    }

    public function update(Request $request, $code)
    {
        $first  = 'image/';
        $png    = 'png';
        $jpeg   = 'jpeg';
        $jpg    = 'jpg';
        $png1    = 'PNG';

        $lang = $request->get('lang');
        $produk = $request->get('nama');
        $slug = $request->get('slug');
        $post = $request->get('post');
        $status = $request->get('status');
        $merchant = $request->get('merchant');
        $harga = $request->get('harga');

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

            if ($getType == $png | $getType == $jpeg | $getType == $jpg | $getType == $png1) {
                $pathOriginal = public_path('img/produk/');
                $pathThumb = public_path('img/produk/thumb/');
                $exp = explode(',', $newImage);
                $base64 = array_pop($exp);
                $image = base64_decode($base64);
                $file = 'image.png';
                file_put_contents($file, $image);
                $width = getimagesize($file)['0'];
                $height = getimagesize($file)['1'];
                $imageName = Carbon::now('Asia/Jakarta')->format('YmdHis');
                $imageName = $imageName.'.'.$getType;
                \Image::make(public_path($file))->resize(640, 320)->encode('jpg')->save($pathOriginal.'/'.$imageName);
                \Image::make(public_path($file))->resize(300, 150)->encode('jpg')->save($pathThumb.'/'.$imageName);
                $newImage = $imageName;
            } else {
                return redirect()->back()->withNotif([
                    'label' => 'warning',
                    'err' => 'Format gambar harus png,jpeg atau jpg',
                ]);
            }

        } else {
            $lastData = data_product::where('code', $code)->first();
            $newImage = $lastData->img_thumbnail;
        }

        $languages = languages::where('status', '1')->get();
        $sort = 0;
        $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        foreach ($languages as $key => $value) {
           
            data_product::where('lang_id', $value->id)->where('code', $code)->update([

                    'id_merchant'       => $merchant,
                    'product'           => $produk[$value->id],
                    'slug'              => $slug[$value->id],
                    'price_publish'     => preg_replace('/[^0-9]/', '', $harga),
                    'description'       => $post[$value->id],
                    'img_thumbnail'     => $newImage,
                    'status'            => $status,

                ]);

        }

        return redirect('/list-produk')->withNotif([

            'label' => 'success',
            'err' => 'Data berhasil di ubah',


            ]);
    }

}
