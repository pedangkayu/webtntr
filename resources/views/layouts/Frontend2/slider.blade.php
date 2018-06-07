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
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <!-- ol class="carousel-indicators">
    @foreach($headers as $i => $head)
      <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" {!! $loop->first ? 'class="active"' : '' !!}></li>
    @endforeach
  </ol -->

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    @foreach($headers as $head)
        <div class="item {{ $loop->first ? 'active' : '' }}">
          <a href="{{ empty($head->link) ? 'javascript:void(0);' : $head->link }}" target="{{ $head->target }}">
          <img src="{{ asset('/img/headers/' . $head->file_name) }}"  title="{{ $head->title }}" alt="{{ $head->title }}">
          <div class="carousel-caption">
            <!-- h4>{{ $head->title }}</h4 -->
            <h2 class="slidertext">{{ $head->description }}</h2>
          </div>
        </a>
        </div>
    @endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <!-- <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> -->
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <!-- <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> -->
    <span class="sr-only">Next</span>
  </a>
  </div>
@endif