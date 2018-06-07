<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\pages;
use App\Models\languages;
use App\Models\posts;
use Carbon\Carbon;
use App\Models\data_servicepack;
use App\Models\data_spa;
use App\Models\data_image_header;
use App\Models\data_message;
use App\Models\data_product;
use App\Models\data_pesanan;

class PagesController extends Controller
{
    public $seo;
  
    function __construct(){
        $this->seo = \Format::paladin();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rows = pages::groupBy('code')->orderBy('page_categori', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('Pages.index', compact('rows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $languages = languages::where('status', '1')->orderBy('sort_number')->get();
        return view('Pages.create', compact('languages'));
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
        $this->validate($request, [
            'nama.*' => 'required',
            'status' => 'required',
            'cathead' => 'required',
            'stsdms' => 'required',
        ]);

        $nama = $request->get('nama');
        $status = $request->get('status');
        $cathead = $request->get('cathead');
        $function = $request->get('function');
        $stsdms = $request->get('stsdms');
        $seo_title = $request->get('seo_title');
        $seo_keywords = $request->get('seo_keywords');
        $seo_descriptions = $request->get('seo_descriptions');
        $languages = languages::where('status', '1')->get();
        $code = substr(strtoupper(md5(uniqid(rand(), true))), 0, 10);
        $sort = 0;

        $checkPages = pages::whereIn('name', array_values($nama))->get();
        
        if (!count($checkPages)) {

            $checkFunc = pages::where('function', $function)->get(); 

            if (!count($checkFunc)) {
                foreach ($languages as $key => $value) {
                    pages::create([
    					'lang_id'               => array_keys($nama)[$sort++],
    					'name'                  => $nama[$value->id],
    					'seo_title'             => $seo_title[$value->id],
    					'seo_keywords'          => $seo_keywords[$value->id],
    					'seo_descriptions'      => $seo_descriptions[$value->id],
    					'slug'                  => setUrlSlug(strtolower($nama[$value->id])),
    					'status'                => $status,
    					'code'                  => $code,
    					'page_categori'         => $cathead,
    					'stsdms'                => $stsdms,
    					'function'              => $stsdms == 1 ? $function : '',
                    ]);
                }
                
                return redirect('/pages')->withNotif([
                    'label' => 'success',
                    'err' => 'Data Berhasil di simpan'
                ]);

            } else {
                return redirect()->back()->withNotif([
                    'label' => 'warning',
                    'err' => 'Function pages sudah ada'
                ]);
            }

        } else {
            return redirect()->back()->withNotif([
                'label' => 'warning',
                'err' => 'Nama pages sudah ada'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($code)
    {
        $pagesPluck = pages::where('code', $code)->pluck('lang_id')->toArray();
        $languages = languages::where('status', '1')->whereIn('id', $pagesPluck)->get();
        return view('Pages.edit', compact('languages', 'code'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'status' => 'required',
            'cathead' => 'required',
        ]);
        
        $nama = $request->get('nama');
        $status = $request->get('status');
        $stsdms = $request->get('stsdms');
        $cathead = $request->get('cathead');
        $function = $request->get('function');
        $seo_title = $request->get('seo_title');
        $seo_keywords = $request->get('seo_keywords');
        $seo_descriptions = $request->get('seo_descriptions');
        //return array_keys($nama);
        $checkPages = pages::where('code', '!=', $id)->whereIn('name', array_values($nama))->get();
        $languages = languages::where('status', '1')->get();

        if (!count($checkPages)) {
        
            foreach ($languages as $key => $value) {
                $page = pages::where('code', $id)->where('lang_id', $value->id)->first();
                pages::where('id', $page->id)->update([
    					'name'                  => $nama[$value->id],
    					'slug'                  => preg_replace('/[^A-Za-z0-9-]+/', '-', $nama[$value->id]),
    					'status'                => $status,
    					'page_categori'         => $cathead,
    					'seo_title'             => $seo_title[$value->id],
    					'seo_keywords'          => $seo_keywords[$value->id],
    					'seo_descriptions'      => $seo_descriptions[$value->id],
    					'function'              => $stsdms == 1 ? $function : '',
    					'stsdms'                => $stsdms,
                    ]);
            }

            return redirect('/pages')->withNotif([
                'label' => 'success',
                'err' => 'Data Berhasil di ubah'
            ]);

        } else {
            return redirect()->back()->withNotif([
                'label' => 'warning',
                'err' => 'Nama pages sudah ada'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function indexDescription($slug)
    {   
        $languages = languages::where('status', '1')->get();
        $page = pages::where('slug', $slug)->first();
        if ($page) {
            $post = posts::where('code_pages', $page->code)->first();
            if ($post) {
                return view('Pages.descriptions.edit', compact('languages', 'post', 'page'));
            } else {
                return view('Pages.descriptions.index', compact('languages'));
            }
        
        } else {
            return redirect('/pages')->withNotif([
                'label' => 'warning',
                'err' => 'Silahkan pilih data terlebih dahulu'
            ]);
        }
        
    }

    public function storeDescription(Request $request, $slug)
    {
        $page = Pages::where('slug', $slug)->first();
        $posts = posts::where('code_pages', $page->code)->get();
        $post = $request->all()['deskripsi'];
        $languages = languages::where('status', '1')->orderBy('sort_number')->get();
        $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        foreach ($languages as $key => $value) {

            if (count($posts) == 2) {
                posts::where('code_pages', $page->code)->where('lang_id', $value->id)->update([
                        'post'          => $post[$value->id],
                        'last_update_by'=> \Auth::user()->id,
                    ]);
            } else {
                $posts = posts::create([
					'lang_id'       => $value->id,
					'type'          => 3,
					'post'          => $post[$value->id],
					'created_by'    => \Auth::user()->id,
					'date_add'      => $dateNow,
					'code_pages'    => $page->code,
                ]);
            }
        }

        return redirect('/pages')->withNotif([
            'label' => 'success',
            'err'   => 'Deskripsi berhasil disimpan',
        ]);
        
    }

    public function allpage($code)
    {
        $page = pages::where('slug', $code)->first();
        if ($page) {
            
            if ($page->stsdms == 1) {
                $checkData = pages::where('slug', $code)->where('stsdms', 1)->first();
                $spage = $checkData->function;
                return $this->$spage($page);
            } else {
                $languages = languages::where('status', '1')->get();
                $language = languages::where('status', '1')->where('code', \App::getLocale())->first();
                $posts = posts::where('lang_id', $language->id)->where('code_pages', $page->code)->first();
                return view('Frontend.Pages.pagedinamis', compact('languages', 'posts', 'page'));
            }
        } else {
            return '404 Not Found';
        }
    }

    public function allnewsdetail($pages, $slug)
    {   
        $languages = languages::where('status', '1')->get();
        $language = languages::where('status', '1')->where('code', \App::getLocale())->first();
        $post = posts::where('lang_id', $language->id)->where('slug', $slug)->first();
        $page = pages::where('slug', $pages)->where('lang_id', $language->id)->first();
        if ($page->code == 33333) {
            $product = data_product::where('slug', $slug)->first();
            return view('Frontend.Pages.orderProduct', compact('product'));
        } else {
            if ($page && $post) {
                return view('Frontend.Pages.newsdetail', compact('post', 'page'));
            } else {
                return '404 Not Found';
            }
        }
    }

    // ALL SCHEDULE
    public function schedule($page) {

        $languages = languages::where('status', '1')->get();
        $language = languages::where('status', '1')->where('code', \App::getLocale())->first();
        $schedule = posts::where('lang_id', $language->id)->where('type', 2)->orderBy('status', 'DESC')->orderBy('date_schedule_start', 'DESC')->paginate(5);

        $data['bcrumbs'] = [
          [
            'title' => 'Home',
            'url' => url('/en')
          ],
          [
            'title' => 'all News',
            'url' => 'javascript:void(0);'
          ]
        ];

        // SEO Meta
        \SEOMeta::setTitle('All News | ' . $this->seo->company)
                ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
                ->setKeywords($this->seo->seo_keywords);
        // Graph
        \OpenGraph::setTitle('All News | ' . $this->seo->company)
            ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
            ->setUrl(url('/page/schedule'))
            ->setSiteName($this->seo->company);
        // Twitter
        \Twitter::setTitle('All News | ' . $this->seo->company)
                ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
                ->setUrl(url('/page/schedule'));

        return view('Frontend.Pages.schedule', compact('page', 'schedule'), $data);
    }

    public function product($page) {

        $data['bcrumbs'] = [
          [
            'title' => 'Home',
            'url' => url('/en')
          ],
          [
            'title' => 'product',
            'url' => 'javascript:void(0);'
          ]
        ];

        // SEO Meta
        \SEOMeta::setTitle(' product | ' . $this->seo->company)
                ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
                ->setKeywords($this->seo->seo_keywords);
        // Graph
        \OpenGraph::setTitle(' product | ' . $this->seo->company)
            ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
            ->setUrl(url('/page/schedule'))
            ->setSiteName($this->seo->company);
        // Twitter
        \Twitter::setTitle(' product | ' . $this->seo->company)
                ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
                ->setUrl(url('/page/schedule'));

        return view('Frontend.Pages.product', compact('page'), $data);
    }

    public function contactus($page) {
        $data['bcrumbs'] = [
          [
            'title' => 'Home',
            'url' => url('/en')
          ],
          [
            'title' => 'Contact Us',
            'url' => 'javascript:void(0);'
          ]
        ];

        // SEO Meta
        \SEOMeta::setTitle('Contact US | ' . $this->seo->company)
                ->setDescription('We have received your message and would like to thank you for writing to us.')
                ->setKeywords($this->seo->seo_keywords);
        // Graph
        \OpenGraph::setTitle('Contact US | ' . $this->seo->company)
            ->setDescription('We have received your message and would like to thank you for writing to us.')
            ->setUrl(url('/page/contactus'))
            ->setSiteName($this->seo->company);

        // Twitter
        \Twitter::setTitle('Contact US | ' . $this->seo->company)
                ->setDescription('We have received your message and would like to thank you for writing to us.')
                ->setUrl(url('/page/contactus'));
                
        return view('Frontend.Pages.contactus', compact('page'), $data);
    }

    public function news($page) {
        $language = languages::where('status', '1')->where('code', \App::getLocale())->first();
        // MERUBAH JUMLAH ITEM YANG DI TAMPILKAN DI HALAMAN PAGES DINAMIS
        $news = posts::where('lang_id', $language->id)->where('type', 1)->paginate(9);

        $data['bcrumbs'] = [
          [
            'title' => 'Home',
            'url' => url('/en')
          ],
          [
            'title' => 'all News',
            'url' => 'javascript:void(0);'
          ]
        ];

        // SEO Meta
        \SEOMeta::setTitle('All News | ' . $this->seo->company)
                ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
                ->setKeywords($this->seo->seo_keywords);
        // Graph
        \OpenGraph::setTitle('All News | ' . $this->seo->company)
            ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
            ->setUrl(url('/page/news'))
            ->setSiteName($this->seo->company);
        // Twitter
        \Twitter::setTitle('All News | ' . $this->seo->company)
                ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
                ->setUrl(url('/page/news'));

        return view('Frontend.Pages.news', compact('news', 'page'), $data);
    }

    public function storeContactus(Request $request){

        $captcha = $request->get('g-recaptcha-response');
        $api_url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LevDUkUAAAAADGqWEvONQ1V2C4rznPO0iv6as8d&response='.$captcha;
        $response = @file_get_contents($api_url);
        $data = json_decode($response, true);

        if ($data['success'] == true) {
            
            $name = $request->get('from_name');
            $email = $request->get('from_email');
            $website = $request->get('from_website');
            $subject = $request->get('subject');
            $deskripsi = $request->get('from_message');

            $data = array(
                'name' => $name,
                'email' => $email,
                'website' => $website,
                'subject' => $subject,
                'deskripsi' => $deskripsi,
            );
            

			// KONFIGURASI EMAIL CONTACT US
            \Mail::send('Frontend.Pages.sendmail', $data, function ($message) use ($data)
            {
                $message->from('info@tinatar.com', 'Message from website');
				$message->to('marketing@tinatar.com')->subject('Message from website');
				$message->to('danangjeffry@gmail.com')->subject('Message from website');
				$message->bcc('dwipayana@gmail.com')->subject('Message from website');
				$message->bcc('dev.paladin@gmail.com')->subject('Message from website');
            }); 

            $saveMessage = data_message::create([ 

                'name'      => $name, 
                'email'     => $email,
                'website'   => $website,
                'subject'   => $subject,
                'message'   => $deskripsi,
                'merchant_id'    => 0,
                'status'    => 1,

                ]);

            return redirect()->back()->with('status', 'Pesan berhasil dikirim');
        }
        if ($data['success'] == false) {
            return 'gagal';
            return redirect()->back()->with('status', 'Gagal verifikasi captcha');
        }

    } 

    public function orderProduk(Request $request)
    {   
        $captcha = $request->get('g-recaptcha-response');
        $api_url = 'https://www.google.com/recaptcha/api/siteverify?secret=6LevDUkUAAAAADGqWEvONQ1V2C4rznPO0iv6as8d&response='.$captcha;
        $response = @file_get_contents($api_url);
        $data = json_decode($response, true);

        if ($data['success'] == true) {

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
					'customer_note' => $request->get('customer_note'),
                    'status'        => 1,
                    'id_product'    => $request->get('product'),
                    'type'          => 1,

                ]);

            $data = array(
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
				'customer_note' => $request->get('customer_note'),
                'status'        => 1,
                'id_product'    => $request->get('product'),
                'type'          => 1,
            );


            \Mail::send('Frontend.Pages.sendmailOrderProduct', $data, function ($message) use ($data)
            {
                $message->from('info@tinatar.com', 'Order from Website');
				$message->to('marketing@tinatar.com')->subject('Order From Website');
                $message->cc('danangjeffry@gmail.com')->subject('Order From Website');
				$message->bcc('dwipayana@gmail.com')->subject('Order From Website');
				$message->bcc('dev.paladin@gmail.com')->subject('Order From Website');
            });

            return redirect()->back()->with('status', 'Pesan berhasil dikirim');
        }

        if ($data['success'] == false) {
            return redirect()->back()->with('status', 'Gagal verifikasi captcha');
        }
    }

    public function gallery($page)
    {
        $data['bcrumbs'] = [
          [
            'title' => 'Home',
            'url' => url('/en')
          ],
          [
            'title' => 'Contact Us',
            'url' => 'javascript:void(0);'
          ]
        ];

        // SEO Meta
        \SEOMeta::setTitle('Contact US | ' . $this->seo->company)
                ->setDescription('We have received your message and would like to thank you for writing to us.')
                ->setKeywords($this->seo->seo_keywords);
        // Graph
        \OpenGraph::setTitle('Contact US | ' . $this->seo->company)
            ->setDescription('We have received your message and would like to thank you for writing to us.')
            ->setUrl(url('/page/contactus'))
            ->setSiteName($this->seo->company);

        // Twitter
        \Twitter::setTitle('Contact US | ' . $this->seo->company)
                ->setDescription('We have received your message and would like to thank you for writing to us.')
                ->setUrl(url('/page/contactus'));
                
        return view('Frontend.Pages.gallery', compact('page'), $data);
    }

}

