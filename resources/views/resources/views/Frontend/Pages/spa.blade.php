@extends('layouts.Frontend.content')

@section('title_page', 'All Spa')

@section('content')

<!-- /.inner title Start ./-->
<div class="gap"></div>
<!-- /.Blog Start ./-->

<section class="products">
  <div class="container">
    <!-- /.Search ./-->
    <div class="top-search">
      <div class="search pull-right">
          <input name="" type="text" placeholder="Search spa:">
      </div>
      <div class="addthis_inline_share_toolbox"></div>
    </div>
    <!-- /.Search End ./-->
    <div class="gap-30"></div>

    <div class="row">
      <!-- /.Products Left Start ./-->
      <div class="col-lg-12 col-md-12">
        <div class="gallery">
          <!-- /.Products row start ./-->
          <div class="row">

            @foreach($items as $top)
            <div class="col-lg-3 col-md-3 col-sm-6" style="min-height:500px;">
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
                    <p>{{ Format::substr(strip_tags($top->description), 100) }}</p>
                  </li>
                  <li>
                    <a class="btn btn-success btn-block" href="{{ url($top->slug) }}"><i class="fa fa-globe"></i> Go Page</a>
                  </li>
                </ul>
              </div>
            </div>
            @endforeach

          </div>
          <!-- /.Products row end ./-->

          <div class="gap-30"></div>

        </div>
        <div class="paging">
          {!! $items->render() !!}
        </div>
      </div>
      <!-- /.products Left End ./-->
    </div>
  </div>
</section>

<!-- /.Blog End ./-->

<div class="gap"></div>

@endsection
