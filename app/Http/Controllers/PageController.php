<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_spa;
use App\Models\data_message;
use App\Models\data_servicepack;
use App\Models\data_image_header;
use App\Jobs\Front\MessageJob;
use App\Events\Contact\SendContactEvent;
use Carbon\Carbon;

class PageController extends Controller {

  public $seo;
  
  function __construct(){
    $this->seo = \Format::paladin();
  }

  public function home()
  {
    return view('Frontend.Pages.sub_home');
  }

	


   /////////////////////////////////////////////////////////
   //			ARCHIVES NEWS & SCHEDULE
   ////////////////////////////////////////////////////////


	// ALL NEWS
		public function news() {
         //
	  }


	// ALL SCHEDULE
	public function schedule() {
      //
	  }





	// ALL SCHEDULE
	public function product() {

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

    return view('Frontend.Pages.product', $data);
  }

  // CONTACT US
  public function contactus() {
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

    return view('Frontend.Pages.contactus', $data);
  }

  // PUMASA  DIBUTUHKAN
  // STATIS ABOUT US
  public function aboutus() {
    $data['bcrumbs'] = [
      [
        'title' => 'Home',
        'url' => url('/en')
      ],
      [
        'title' => 'About Us',
        'url' => 'javascript:void(0);'
      ]
    ];

    // SEO Meta
    \SEOMeta::setTitle('About Us | ' . $this->seo->company)
            ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
            ->setKeywords($this->seo->seo_keywords);

    // Graph
    \OpenGraph::setTitle('About Us | ' . $this->seo->company)
        ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
        ->setUrl(url('/page/aboutus'))
        ->setSiteName($this->seo->company);

    // Twitter
    \Twitter::setTitle('About Us | ' . $this->seo->company)
            ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
            ->setUrl(url('/page/aboutus'));

    return view('Frontend.Pages.aboutus', $data);
  }


 // STATIS TERMS CONDITION
  public function terms_condition() {

    $data['bcrumbs'] = [
      [
        'title' => 'Home',
        'url' => url('/en')
      ],
      [
        'title' => 'Terms & Condition',
        'url' => 'javascript:void(0);'
      ]
    ];

    // SEO Meta
    \SEOMeta::setTitle('Terms & Condition | ' . $this->seo->company)
            ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
            ->setKeywords($this->seo->seo_keywords);
    // Graph
    \OpenGraph::setTitle('Terms & Condition | ' . $this->seo->company)
        ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
        ->setUrl(url('/page/terms-condition'))
        ->setSiteName($this->seo->company);
    // Twitter
    \Twitter::setTitle('Terms & Condition | ' . $this->seo->company)
            ->setDescription('company web is the information center which always eager to serve easy way to all customers of our website.')
            ->setUrl(url('/page/terms-condition'));

    return view('Frontend.Pages.terms_condition', $data);
  }


  // SPA
  public function spa() {
    $data['bcrumbs'] = [
      [
        'title' => 'Home',
        'url' => url('/en')
      ],
      [
        'title' => 'Spa',
        'url' => 'javascript:void(0);'
      ]
    ];

    // SEO Meta
    \SEOMeta::setTitle('company profile | ' . $this->seo->company)
            ->setDescription('')
            ->setKeywords($this->seo->seo_keywords);
    // Graph
    \OpenGraph::setTitle('company profile | ' . $this->seo->company)
        ->setDescription('')
        ->setUrl(url('/page/spa'))
        ->setSiteName($this->seo->company);
    // Twitter
    \Twitter::setTitle('company profile | ' . $this->seo->company)
            ->setDescription('')
            ->setUrl(url('/en/spa'));
    $data['items'] = data_spa::allspa()->paginate(12);
    return view('Frontend.Pages.spa', $data);
  }

  public function sendcontactus(Request $req){
    $rules = [
        'g-recaptcha-response' => 'required|recaptcha',
    ];
    $this->validate($req, $rules);
    $config = \Format::paladin()->toArray();
    $data = $req->all();
    $data['config'] = $config;
    $this->dispatch(new MessageJob($data));
    event(new SendContactEvent($data));
    return redirect()->back()->withErrors([
      'Thank you message was successfully sent'
    ]);
  }

  // SERVICE PACK
  public function servicepack(){

    $data['bcrumbs'] = [
      [
        'title' => 'Home',
        'url' => url('/en')
      ],
      [
        'title' => 'Service',
        'url' => 'javascript:void(0);'
      ]
    ];

    // SEO Meta
    \SEOMeta::setTitle('Service & Package | ' . $this->seo->company)
            ->setDescription('You get more service and package')
            ->setKeywords($this->seo->seo_keywords);
    // Graph
    \OpenGraph::setTitle('Service & Package | ' . $this->seo->company)
        ->setDescription('You get more service and package')
        ->setUrl(url('/page/servicepack'))
        ->addImage(asset('/front/images/more-service.jpg'))
        ->setSiteName($this->seo->company);
    // Twitter
    \Twitter::setTitle('Service & Package | ' . $this->seo->company)
            ->setDescription('You get more service and package')
            ->addImage(asset('/front/images/more-service.jpg'))
            ->setUrl(url('/page/servicepack'));

    $data['items'] = data_servicepack::allservicepack()->paginate(12);
    return view('Frontend.Pages.AllServicepack', $data);
  }

}
