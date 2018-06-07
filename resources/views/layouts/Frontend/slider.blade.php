<?php 
use App\Models\data_spa;
use App\Models\data_servicepack;
use App\Models\data_image_header;
use Carbon\Carbon;

$seo = '';
$this->seo = \Format::paladin();
$tops = data_spa::topfrontend()->limit(12)->get();
$specialoffers = data_servicepack::specialoffer()->limit(8)->get();
$headers = data_image_header::active()->get();
$images = [];
foreach($headers as $img){
  $images[] = asset('/img/headers/' . $img->file_name);
}

// SEO Meta
\SEOMeta::setTitle($this->seo->seo_title)
        ->setDescription($this->seo->seo_description)
        ->setKeywords($this->seo->seo_keywords);

// Graph
\OpenGraph::setTitle($this->seo->seo_title)
    ->setDescription($this->seo->seo_description)
    ->addImages($images)
    ->setUrl(url('/'))
    ->setSiteName($this->seo->company);

// Twitter
\Twitter::setTitle($this->seo->seo_title)
        ->setDescription($this->seo->seo_description)
        ->addImage($images)
        ->setUrl(url('/'));
?>

@if(count($headers) > 0)


        <!-- Hero -->
        <section id="hero" class="hero-fullscreen parallax" data-overlay-dark="7">
          @foreach($headers as $head)
               <div class="background-image">
                <!-- div class="item {{ $loop->first ? 'active' : '' }}">
                    <a href="{{ empty($head->link) ? 'javascript:void(0);' : $head->link }}" target="{{ $head->target }}">
                    <img src="{{ asset('/img/headers/' . $head->file_name) }}"  title="{{ $head->title }}" alt="{{ $head->title }}">
                    {{ $head->description }}
                    </a>
                </div -->
                    <img src="{{ asset('/img/headers/' . $head->file_name) }}"  title="{{ $head->title }}" alt="{{ $head->title }}">
              </div>
          @endforeach
            
            <div class="container">
                <div class="row">
                    <div class="hero-content-slider mt20" data-autoplay="true" data-speed="4000">
                        <div>
                            <h1>We Are Tinatar Innovation<br><strong>Something You Love</strong></h1>
                            <p class="lead">We are digital agency that loves crafting beautiful websites with great functionality.</p>
                            <a href="#about" class="btn btn-lg btn-primary btn-scroll">We're Creative</a>  
                        </div>
                        
                        <div>
                            <h1>We Are Tinatar Innovation<br><strong>We Make Brands Shine</strong></h1>
                            <p class="lead">We do innovation, creativity, effectiveness and all that with love.</p>
                            <a href="#about" class="btn btn-lg btn-primary btn-scroll">What we do</a>  
                        </div>
                        
                        <div>
                            <h1>We Are Tinatar Innovation<br><strong>Good Digital Agency</strong></h1>
                            <p class="lead">Tinatar Innovation was honored as best agency in Bandung.</p>
                            <a href="#about" class="btn btn-lg btn-primary btn-scroll">Made with <i class="ion-heart"></i></a>  
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- End Hero -->
 
@endif