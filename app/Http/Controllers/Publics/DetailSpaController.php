<?php

namespace App\Http\Controllers\Publics;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\data_spa;
use App\Models\data_servicepack;
use App\Models\ref_templates;
use App\Models\data_schedule;
use App\Models\ref_country;
use App\Models\data_booking;
use App\Models\data_gallerys;
use App\Models\Views\view_booking_detail;

use PayPal;

use App\Jobs\Front\BookingJob;
use App\Jobs\Front\MessageJob;
use App\Events\Contact\SendContactEvent;

class DetailSpaController extends Controller {

  private $paladin;
  private $paypal;

  public function __construct(){
    $this->paladin = \Format::paladin();
    $this->paypal = PayPal::start();
  }

  public function index(Request $req, $slug){

    $spa = data_spa::slug($slug)->first();
    if($spa == NULL)
      abort(404);

    // SEO Meta
    \SEOMeta::setTitle($spa->seo_title)
            ->setDescription($spa->seo_description)
            ->setKeywords($spa->seo_keywords)
            ->addMeta('author', $spa->spa);
    // Graph
    \OpenGraph::setTitle($spa->seo_title)
        ->setDescription($spa->seo_description)
        ->setUrl(url($spa->slug))
        ->setSiteName($spa->spa);

    if(!empty($spa->header1) || !empty($spa->header1)){
      if(!empty($spa->header1))
        \OpenGraph::addImage(url('/img/spa/headers/' . $spa->header1));
      if(!empty($spa->header2))
        \OpenGraph::addImage(url('/img/spa/headers/' . $spa->header2));
    }else{
      \OpenGraph::addImage(url('/img/spa/' . $spa->img_thumbnail));
    }

    // Twitter
    \Twitter::setTitle($spa->seo_title)
            ->setDescription($spa->seo_description)
            ->setUrl(url($spa->slug))
            ->setSite($spa->twitter);

    if(!empty($spa->header1) || !empty($spa->header1)){
      if(!empty($spa->header1))
        \Twitter::addImage(url('/img/spa/headers/' . $spa->header1));
      if(!empty($spa->header2))
        \Twitter::addImage(url('/img/spa/headers/' . $spa->header2));
    }else{
      \Twitter::addImage(url('/img/spa/' . $spa->img_thumbnail));
    }

    $data['menus'] = $this->menus($req->path(), $slug);
    $template = ref_templates::find($spa->template_id);

    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;
    $data['schedules'] = data_schedule::where('id_spa', $spa->id_spa)
      ->where('status', 1)
      ->where('time_end', '>', date('Y-m-d H:i:s'))
      ->limit(5)
      ->orderby('time_start', 'asc')
      ->get();
    $data['services'] = data_servicepack::serviceall($spa->id_spa)->limit(3)->get();
    $data['packages'] = data_servicepack::packageall($spa->id_spa)->limit(3)->get();
    return view('templates.' . $template->template_path . '.content.index', $data);

  }

  public function services(Request $req, $slug){
    $spa = data_spa::slug($slug)->first();
    if($spa == NULL)
      abort(404);

    // SEO Meta
    \SEOMeta::setTitle('Services | ' . $spa->spa)
            ->setDescription($spa->seo_description)
            ->addKeyword($spa->seo_keywords);
    // Graph
    \OpenGraph::addImage(url('/img/spa/' . $spa->img_thumbnail))
        ->setTitle('Services | ' . $spa->spa)
        ->setDescription($spa->seo_description)
        ->setUrl(url($spa->slug . '/services'))
        ->setSiteName($spa->spa);
    // Twitter
    \Twitter::addImage(url('/img/spa/' . $spa->img_thumbnail))
            ->setTitle('Services | ' . $spa->spa)
            ->setDescription($spa->seo_description)
            ->setUrl(url($spa->slug . '/services'))
            ->setSite($spa->twitter);

    $data['menus'] = $this->menus($req->path(), $slug);
    $template = ref_templates::find($spa->template_id);
    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;
    $data['services'] = data_servicepack::serviceall($spa->id_spa)->paginate(9);
    $data['title'] = 'Services';
    return view('templates.' . $template->template_path . '.content.servicespack', $data);
  }

  public function packages(Request $req, $slug){
    $spa = data_spa::slug($slug)->first();
    if($spa == NULL)
      abort(404);

    // SEO Meta
    \SEOMeta::setTitle('Packages | ' . $spa->spa)
            ->setDescription($spa->seo_description)
            ->addKeyword($spa->seo_keywords);
    // Graph
    \OpenGraph::addImage(url('/img/spa/' . $spa->img_thumbnail))
        ->setTitle('Packages | ' . $spa->spa)
        ->setDescription($spa->seo_description)
        ->setUrl(url($spa->slug . '/packages'))
        ->setSiteName($spa->spa);
    // Twitter
    \Twitter::addImage(url('/img/spa/' . $spa->img_thumbnail))
            ->setTitle('Packages | ' . $spa->spa)
            ->setDescription($spa->seo_description)
            ->setUrl(url($spa->slug . '/packages'))
            ->setSite($spa->twitter);

    $data['menus'] = $this->menus($req->path(), $slug);
    $template = ref_templates::find($spa->template_id);
    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;
    $data['services'] = data_servicepack::packageall($spa->id_spa)->paginate(9);
    $data['title'] = 'Packages';
    return view('templates.' . $template->template_path . '.content.servicespack', $data);
  }

  // Detail service pack
  public function servicepack(Request $req, $domain, $slug){
    $spa = data_spa::slug($domain)->first();
    if($spa == NULL)
      abort(404);

    $service = data_servicepack::slug($slug)->where('id_spa', $spa->id_spa)->first();
    if($service == NULL)
      abort(404);

    $description = $service->servicepack;
    $description .= '. Normal Price ' . number_format(($service->price_publish),2,'.',',') . ' ' . $service->iso_code;
    if($service->discount > 0)
      $description .= ', Discount ' . $service->discount . '%. You Save ' . number_format(( ($service->price_publish * $service->discount) / 100),2,'.',',') . ' ' . $service->iso_code;

    $description .= ' ' . \Format::substr(strip_tags($service->description), 60);


    // SEO Meta
    \SEOMeta::setTitle($service->servicepack . ' | ' . $spa->spa)
            ->setDescription($description)
            ->setKeywords($spa->seo_keywords);
    // Graph
    \OpenGraph::addImage(url('/img/servicepack/' . $service->img_thumbnail))
        ->setTitle($service->servicepack . ' | ' . $spa->spa)
        ->setDescription($description)
        ->setUrl(url($spa->slug . '/servicepack/' . $service->slug))
        ->setSiteName($spa->spa);
    // Twitter
    \Twitter::addImage(url('/img/servicepack/' . $service->img_thumbnail))
            ->setTitle($service->servicepack . ' | ' . $spa->spa)
            ->setDescription($description)
            ->setUrl(url($spa->slug . '/servicepack/' . $service->slug))
            ->setSite($service->twitter);

    $data['menus'] = $this->menus($req->path(), $domain);
    $template = ref_templates::find($spa->template_id);
    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;
    $data['service'] = $service;
    $data['title'] = 'Services';

    // Related
    $data['relasi'] = data_servicepack::join('ref_currencies', 'ref_currencies.id', '=', 'data_servicepack.currenci_id')
      ->where('data_servicepack.id_spa', $spa->id_spa)
      ->where('data_servicepack.type', $service->type)
      ->select(['data_servicepack.*', 'ref_currencies.iso_code'])
      ->orderby(\DB::raw('RAND()'))->limit(3)->get();

    return view('templates.' . $template->template_path . '.content.detailservicespack', $data);
  }

  public function book(Request $req, $domain, $slug){
    $spa = data_spa::slug($domain)->first();
    if($spa == NULL)
      abort(404);

    $service = data_servicepack::slug($slug)->where('id_spa', $spa->id_spa)->first();
    if($service == NULL)
      abort(404);

    $minimal_pax = !empty($req->free) ? $req->free : $service->minimal_pax;

    // SEO Meta
    \SEOMeta::setTitle('Booking | ' . $spa->spa . ' | ' . $service->servicepack)
            ->setDescription($spa->seo_description)
            ->addKeyword($spa->seo_keywords);
    // Graph
    \OpenGraph::addImage(url('/img/spa/' . $spa->img_thumbnail))
        ->setTitle('Booking | ' . $spa->spa . ' | ' . $service->servicepack)
        ->setDescription($spa->seo_description)
        ->setUrl(url($spa->slug . '/book/' . $slug))
        ->setSiteName($spa->spa);
    // Twitter
    \Twitter::addImage(url('/img/spa/' . $spa->img_thumbnail))
            ->setTitle('Booking | ' . $spa->spa . ' | ' . $service->servicepack)
            ->setDescription($spa->seo_description)
            ->setUrl(url($spa->slug . '/book/' . $slug))
            ->setSite($spa->twitter);

    $data['menus'] = $this->menus($req->path(), $domain);
    $template = ref_templates::find($spa->template_id);
    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;
    $data['service'] = $service;
    $data['negara'] = ref_country::active()->get();
    $data['title'] = 'Services';
    $data['minimal_pax'] = $minimal_pax;
    return view('templates.' . $template->template_path . '.content.booking', $data);
  }

  public function booking(Request $req, $slug){

    $rules = [
        'g-recaptcha-response' => 'required|recaptcha',
    ];
    $this->validate($req, $rules);

    $this->dispatch(new BookingJob($req->all()));
    $res = $req->session()->get('notif');
    if($res['result']){
      $next = $slug . '/booking-success';
      // Email notifikasi here ...
      return redirect($next);
    }else{
      return redirect()->back()->withInput();
    }
  }

  public function booksuccess(Request $req, $slug){

    $spa = data_spa::slug($slug)->first();
    if($spa == NULL)
      abort(404);

    \SEOMeta::setTitle('Success | ' . $spa->spa);

    $data['menus'] = $this->menus($req->path(), $slug);
    $template = ref_templates::find($spa->template_id);

    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;
    return view('templates.' . $template->template_path . '.content.success', $data);
  }

  public function payment(Request $req, $slug, $code, $token = 0){

    $spa = data_spa::slug($slug)->first();
    if($spa == NULL)
      abort(404);

    $book = view_booking_detail::where('code', $code)->where('id_spa', $spa->id_spa)->first();
    if($book == NULL)
      abort(404);

	//$kurs = json_decode(file_get_contents('http://openexchangerates.org/api/latest.json?app_id=3cb09ed9b063447da37d26f786a18863'));
  $client = new \GuzzleHttp\Client();
  $res = $client->request('GET', 'http://openexchangerates.org/api/latest.json?app_id=3cb09ed9b063447da37d26f786a18863');
  $kurs = json_decode($res->getBody());

    $iso = $book->iso_code;
    $total_kurs = $kurs->rates->$iso;
    $grandtotal = $book->grandtotal / $total_kurs;
    \SEOMeta::setTitle('Payment Terms | ' . $spa->spa);
    // Paypal Section
        $payer = PayPal::payer();
        $payer->setPaymentMethod("paypal");

        $item[0] = PayPal::item();
        $item[0]->setName('Pay out Invoice #' . $book->code . ' ' . $book->servicepack)
                ->setDescription('Booking SPA from ' . $spa->spa . ', Service name ' . $book->servicepack . ', Invoice #' . $book->code)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setTax(0)
                ->setPrice($grandtotal);
        // // Discount
        // if($book->discount > 0):
        //   $discount = ($book->subtotal * $book->discount) / 100;
        //
        //   $item[1] = PayPal::item();
        //   $item[1]->setName('Discount ' . $book->discount . '% off')
        //           ->setDescription('Discount ' . $book->discount . '% off')
        //           ->setCurrency('USD')
        //           ->setQuantity($book->qty_person)
        //           ->setTax(0)
        //           ->setPrice(-$discount);
        // endif;
        // // Total Other
        // if($book->total_other > 0):
        //
        //   $item[2] = PayPal::item();
        //   $item[2]->setName('Other')
        //           ->setDescription('Other')
        //           ->setCurrency('USD')
        //           ->setQuantity(1)
        //           ->setTax(0)
        //           ->setPrice($book->total_other);
        // endif;

        $itemList = PayPal::itemList();
        $itemList->setItems($item);
        // Matematika
        // $subtotal = $book->subtotal * $book->qty_person;
        // $aftdisc = ($subtotal * $book->discount) / 100;
        // $beforetax = $subtotal - $aftdisc;
        // $other = $book->total_other;
        // $totalWother = $beforetax + $other;
        // $afttax = ($totalWother * $book->tax) / 100;
        // $grandtotal = $totalWother + $afttax;

        $details = PayPal::details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($grandtotal);

        $amount = PayPal::amount();
        $amount->setCurrency('USD')
            ->setTotal($grandtotal)
            ->setDetails($details);

        $transaction = PayPal::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($book->invoice_note)
            ->setInvoiceNumber('#' . $book->code);

        $redirectUrls = PayPal::redirectUrls();
        $redirectUrls->setReturnUrl(url('/payment/confirm?referal=' . $book->id_booking . '&domain=' . $spa->slug . '&success=true'))
            ->setCancelUrl(url($slug . '/payment/' . $code . '/' . $token . '?payment=cancel'));

        $payment = PayPal::payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions([$transaction]);
        try {
            $payment->create($this->paypal);
        } catch (\Exception $ex) {
            \Log::error($ex);
        }
        $approvalUrl = $payment->getApprovalLink();
    // End Section

    $data['menus'] = $this->menus($req->path(), $slug);
    $template = ref_templates::find($spa->template_id);
    $data['book'] = $book;
    $data['book']['link_paypal'] = $approvalUrl;
    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;

    return view('templates.' . $template->template_path . '.content.paymentterms', $data);
  }

  public function gallerys(Request $req, $slug){

    $spa = data_spa::slug($slug)->first();
    if($spa == NULL)
      abort(404);

    // SEO Meta
    \SEOMeta::setTitle('Gallerys | ' . $spa->seo_title)
            ->addMeta('author', $spa->spa);

    $data['menus'] = $this->menus($req->path(), $slug);
    $template = ref_templates::find($spa->template_id);
    $data['gallerys'] = data_gallerys::where('id_spa', $spa->id_spa)->orderby(\DB::raw('RAND()'))->get();
    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;
    $data['services'] = data_servicepack::serviceall($spa->id_spa)->limit(3)->get();
    $data['packages'] = data_servicepack::packageall($spa->id_spa)->limit(3)->get();
    return view('templates.' . $template->template_path . '.content.gallerys', $data);

  }

  public function contact(Request $req, $slug){

    $spa = data_spa::slug($slug)->first();
    if($spa == NULL)
      abort(404);

    // SEO Meta
    \SEOMeta::setTitle('Contact | ' . $spa->seo_title)
            ->addMeta('author', $spa->spa);

    $data['menus'] = $this->menus($req->path(), $slug);
    $template = ref_templates::find($spa->template_id);
    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;
    $data['services'] = data_servicepack::serviceall($spa->id_spa)->limit(3)->get();
    $data['packages'] = data_servicepack::packageall($spa->id_spa)->limit(3)->get();
    return view('templates.' . $template->template_path . '.content.contact', $data);

  }

  public function sendcontact(Request $req){
    $rules = [
        'g-recaptcha-response' => 'required|recaptcha',
    ];
    $this->validate($req, $rules);
    $spa = data_spa::find($req->id_spa);
    $config = \Format::paladin()->toArray();
    $data = array_merge($req->all(), $spa->toArray());
    $data['config'] = $config;
    $this->dispatch(new MessageJob($data));
    event(new SendContactEvent($data));
    return redirect()->back()->withErrors([
      'Thank you message was successfully sent'
    ]);

  }

  public function menu(Request $req, $slug){

    $spa = data_spa::slug($slug)->first();
    if($spa == NULL)
      abort(404);

    $data['menus'] = $this->menus($req->path(), $slug);
    $template = ref_templates::find($spa->template_id);
    $data['spa'] = $spa;
    $data['bali'] = $this->paladin;
    $data['services'] = data_servicepack::serviceall($spa->id_spa)->get();
    $data['packages'] = data_servicepack::packageall($spa->id_spa)->get();

    // SEO Meta
    \SEOMeta::setTitle('Menu | ' . $spa->spa)
            ->setDescription($spa->spa . ' available menu on company web');
    // Graph
    \OpenGraph::addImage(asset('/front/images/more-service.jpg'))
        ->setTitle('Menus | ' . $spa->spa)
        ->setDescription($spa->spa . ' available menu on company web')
        ->setUrl(url($spa->slug . '/menu'))
        ->setSiteName($spa->spa);


    return view('templates.' . $template->template_path . '.content.menu', $data);

  }

  // Menus
  private function menus($path, $slug){
    return [
      [
        'active' => ($path == $slug) ? 'active' : '',
        'title' => 'Home',
        'url' => url($slug)
      ],
      [
        'active' => ($path == $slug . '/services') ? 'active' : '',
        'title' => 'Service',
        'url' => url($slug . '/services')
      ],
      [
        'active' => ($path == $slug . '/packages') ? 'active' : '',
        'title' => 'Package',
        'url' => url($slug . '/packages')
      ],
      [
        'active' => ($path == $slug . '/menu') ? 'active' : '',
        'title' => 'Menu',
        'url' => url($slug . '/menu')
      ],
      [
        'active' => ($path == $slug . '/gallerys') ? 'active' : '',
        'title' => 'Gallery',
        'url' => url($slug . '/gallerys')
      ],
      // [
      //   'active' => ($path == $slug) ? 'active' : '',
      //   'title' => 'Other',
      //   'url' => url($slug)
      // ],
      [
        'active' => ($path == $slug . '/contact') ? 'active' : '',
        'title' => 'Contact',
        'url' => url($slug . '/contact')
      ],
      [
        'active' => '',
        'title' => 'Back To company web',
        'url' => url('/')
      ]
    ];
  }
}
