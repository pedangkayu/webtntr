@extends('layouts.Frontend.home')
@section('content')

@if(count($headers) > 0)
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			  <!-- Indicators -->
			  <ol class="carousel-indicators">
				@foreach($headers as $i => $head)
				  <li data-target="#carousel-example-generic" data-slide-to="{{ $i }}" {!! $loop->first ? 'class="active"' : '' !!}></li>
				@endforeach
			  </ol>

			  <!-- Wrapper for slides -->
			  <div class="carousel-inner" role="listbox">
				@foreach($headers as $head)
					<div class="item {{ $loop->first ? 'active' : '' }}">
					  <a href="{{ empty($head->link) ? 'javascript:void(0);' : $head->link }}" target="{{ $head->target }}">
					  <img src="{{ asset('/img/headers/' . $head->file_name) }}" title="{{ $head->title }}" alt="{{ $head->title }}">
					  <div class="carousel-caption">
						<h4>{{ $head->title }}</h4>
						<p>{{ $head->description }}</p>
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

    <div class="mtop1"></div>
    <!-- /. Services Start ./-->
    <section id="hservices">
      <div class="container">
        <div class="mtop1"></div>
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <h2 class="main-title">Top Spa in Bali on {{ date('F Y') }}</h2>
            <br />
          </div>
        </div>

        <div class="row gallery">
          @foreach($tops as $top)
          <div class="col-lg-3 col-md-3 col-sm-6" style="min-height:520px;">
            <div class="hservice">
              <ul>
                <li>
                  <div class="block-image"> <img class="img-responsive" src="{{ asset('/img/spa/' . $top->img_thumbnail) }}" alt="{{ $top->spa }}">
                    <div class="img-overlay-3-up pat-override"></div>
                    <div class="img-overlay-3-down pat-override"></div>
                  </div>
                </li>
                <li>
                  <h4 title="{{ $top->spa }}" style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 100%;display: inline-block;">
                    {!! $top->status ? '<i class="fa fa-circle text-success pull-right"></i>' : '<i class="fa pull-right fa-circle text-muted"></i>' !!}
                    <a href="{{ url($top->slug) }}">{{ $top->spa }}</a>
                  </h4>
                  <p>{{ Format::substr(strip_tags($top->description), 200) }}</p>
                </li>
                <li>
                  <a class="btn btn-success btn-block" href="{{ url($top->slug) }}"><i class="fa fa-globe"></i> Go Page</a>
                </li>
              </ul>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section>
    <!-- /. Services End ./-->

      <div class="mtop1"></div>

      <!-- /. More Services start ./-->
      <section id="paralax">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="block-image background-scale"> <img class="img-responsive" src="{{ asset('/front/images/more-service.jpg') }}" alt=""> </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 ">
              <h2>More Services Available here</h2>
              <ul>
					<li>Health & Wellness </li>
					<li>Traditional & Natural Spa</li>
					<li>Body Treatments</li>
					<li>Massage & Salon</li>
					<li>Honeymoon Treatments</li>
					<li>Couples Treatments & Shared Services</li>
					<li>Balinese Coustume & Spa Package</li>
					<li>Spa Group</li>
 
              </ul>
              <button onClick="window.location.href='{{ url('/page/servicepack') }}'">Checkout More</button>
            </div>
          </div>
          <!-- /.row -->

        </div>
        <!-- /.container -->

      </section>
      <!-- /. More Services End ./-->

    <div class="mtop1"></div>

    @if(count($specialoffers) > 0)
    <!-- /. Services Start ./-->
    <section id="hservices">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <h2 class="main-title">Bali Spa Special Discount Offer</h2>
            <br />
          </div>
        </div>

        <div class="gallery">
          <!-- /.Products row start ./-->
          <div class="row">

            @foreach($specialoffers as $item)
            <!--Product -->
            <div class="col-lg-3 col-md-3 col-sm-6" style="margin-bottom:30px;">
              <ul class="pro-box">
                <li class="pro">
                  <!-- span class="discount">{{ $item->discount }}%</span -->
        					<div class="discount" style="position:absolute;font-size:24pt;font-weight:bold;left:15px;top:10px;color:#FFF;text-shadow:0px 0px 9px #808283;">
        					  {{ $item->discount }}%
        					</div>

                  <div class="block-image"> <img class="img-responsive" src="{{ asset('/img/servicepack/' . $item->img_thumbnail) }}" alt="{{ $item->servicepack }}">
                    <div class="img-overlay-3-up pat-override"></div>
                    <div class="img-overlay-3-down pat-override"></div>
                  </div>
                  <span class="addtocart"><a href="{{ url($item->slug_spa . '/book/' . $item->slug) }}">Book Now</a></span>
                </li>
                <li>
	                <h4 style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 100%;display: inline-block;margin-bottom:0;"><a href="{{ url($item->slug_spa . '/servicepack/' . $item->slug) }}" title="{{ $item->servicepack }}">{{ $item->servicepack }}</a></h4>
                  <strong><a href="{{ url($item->slug_spa) }}">{{ $item->spa }}</a></strong>
                </li>
                <li><strike class="text-danger">PRICE {{ number_format($item->price_publish,2,'.',',') }}  {{ $item->iso_code }}</strike></li>
                <li style="padding:10px;">{{ Format::substr(strip_tags($item->description), 100) }}</li>
                <li class="pro-footer">
                  <a href="{{ url($item->slug_spa . '/book/' . $item->slug) }}" title="{{ $item->servicepack }}" class="btn btn-default">
                    BOOK {{ number_format(($item->price_publish - (($item->price_publish * $item->discount) / 100)),2,'.',',') }} {{ $item->iso_code }}
                  </a>
                </li>
              </ul>
            </div>
            <!--Product End -->
            @endforeach
          </div>
          <!-- /.Products row end ./-->
        </div>


      </div>
    </section>
    <!-- /. Services End ./-->
    @endif

    <div class="gap"></div>
    <!-- /. Blog Start ./-->

@endsection
