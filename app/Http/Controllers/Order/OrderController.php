<?php

namespace App\Http\Controllers\Order;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\data_pesanan;
use App\Models\ref_country;
use App\Models\data_product;
use Datatables;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
    	return view('Order.index');
    }

    public function getData()
    {
    	$orders = data_pesanan::orderBy('id_pesanan', 'DESC')->get();
    	$no = 1;
    	foreach ($orders as $key => $value) {
    		$country = ref_country::where('id_country', $value->country_id)->first();
    		$product = data_product::where('id_product', $value->id_product)->first();
    		if ($value->status == 1) {
    			$code = "<b>".$value->code."</b>";
    		} else {
    			$code = $value->code;
    		}
    		if ($value->status == 1) {
    			$ket = '<span style="color: red;">new</span>';
    		} elseif($value->status == 2) {
    			$ket = 'read';
    		}
    		if ($value->category_order == 1) {
    			$categori = 'Customer';
    		} elseif($value->category_order == 2) {
    			$categori = 'Manual';
    		}
    		$datas[] = array('no' => $no++,'code' => '<a class="btn btn-primary btn-sm detail" href="javascript:void(0)"><u>'.$code.'</u></a>', 'title' => $value->title, 'name' => $value->name_customer, 'contact' => $value->email.'<br>'.$value->phone, 'qty' => $value->qty_pesanan, 'address' => $value->address, 'country' => $country->nm_country, 'city', $value->city, 'product' => $product->product, 'keterangan' => $ket." | <a href='javascript:void(0)' class='delete'><span class='fa fa-trash'></span></a>", 'categori' => $categori);
    	}
    	return Datatables::of(collect($datas))->make(true);
    }

    public function detail($code)
    {
    	data_pesanan::where('code', $code)->update(['status' => 2]);
    	$data = data_pesanan::where('code', $code)->first();
    	$country = ref_country::where('id_country', $data->country_id)->first();
    	$product = data_product::where('id_product', $data->id_product)->first();
    	if ($data->category_order == 1) {
    		$categori = 'Customer';
    	} elseif ($data->category_order == 2){
    		$categori = 'Manual';
    	}
    	return response()->json(['categori' => $categori, 'order' => $data, 'country' => $country, 'product' => $product]);
    }

    public function delete($code)
    {
    	data_pesanan::where('code', $code)->delete();
    	return response()->json(['status' => 'sukses']);
    }

    public function storeManual(Request $request)
    {	
    	$code = substr(strtoupper(md5(uniqid(rand(), true))), 0, 5);
        $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
    	$pesanan = data_pesanan::create([

            'code'          => $code,
            'qty_pesanan'   => $request->get('qty'),
            'time_request'  => $dateNow,
            'title'         => $request->get('title'),
            'name_customer' => $request->get('name'),
            'email'         => $request->get('email'),
            'phone'         => $request->get('phone'),
            'address'       => $request->get('address'),
            'city'          => $request->get('city'),
            'country_id'    => $request->get('country'),
            'status'        => 1,
            'id_product'    => $request->get('product'),
            'type'          => 1,
            'category_order'=> 2,	

        ]);

        return redirect()->back()->withNotif([
                'label' => 'success',
                'err' => 'Data berhasil disimpan',
            ]);

    }
}
