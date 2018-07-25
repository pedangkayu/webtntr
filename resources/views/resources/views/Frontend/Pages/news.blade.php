@extends('layouts.Frontend.content')
@section('title_page', $page->name)
@section('content')

 	<!-- Hero -->
        <section id="hero" class="hero-fullwidth parallax" data-overlay-dark="8">
            <div class="background-image">
                <img src="img/backgrounds/bg-5.jpg" alt="#">
            </div>
            
            <div class="container">
                <div class="row">
                        
                    <div class="col-md-12 text-center">
                        <h1>Our <strong>Recent</strong> Works</h1>
                        <p class="lead">We are a digital studio offering a variety of solutions in visual design.</p>
                    </div>
                    
                </div>
            </div>
        </section>
    <!-- End Hero -->


<!-- Portfolio -->
        <section id="works-page" class="pb100">
            <div class="container">
                <div class="row text-center">    
                    <div class="portfolio" data-gap="20"><!-- Values: 10, 15, 20, 25, 30 and 35 -->
                        <!-- Portfolio Category Filters -->
                        <ul class="vossen-portfolio-filters" data-initial-filter="*">
                            <li data-filter="*">Show All</li>
                            <li data-filter="Branding">Branding</li>
                            <li data-filter="Digital">Digital</li>
                            <li data-filter="Print">Print</li>
                        </ul>
                        
                        <!-- Portfolio Items Container-->
                        <div class="vossen-portfolio">
                            <!-- Portfolio Item -->
                            @foreach($news as $key => $value)
                            <div class="col-md-4 col-sm-6" data-filter="Branding Digital">
                                <a href="project-slides.html">
                                    <div class="portfolio-item">
                                        <div class="item-caption">
                                            <h4>{!! $value->title !!}</h4>
                                            <p><a href="{{ url(App::getLocale().'/'.$page->slug.'/'.$value->slug) }}" !!}> <i class="ion-android-checkmark-circle"></i> View more</a></p>
                                        </div>

                                        <div class="item-image">
											@if($value->thumb != 'null')
												<img class="img-responsive" src="/img/posts/thumb/{!! $value->thumb !!}">
											@else
												<img class="img-responsive" src="/img/posts/thumb/default.png">
											@endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div><!-- END VOSSEN PORTOFOLIO -->
                        
                    </div>
                     {!! $news->render() !!}
                </div>
            </div>
        </section>            
        <!-- End Portfolio -->      
        
@endsection


@section('js')
@endsection