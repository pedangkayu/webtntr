@extends('layouts.Frontend.content')

@section('title_page', 'SERVICE')

@section('content')
<!-- /.inner title Start ./-->
<div class="gap"></div>

<!-- /.Blog Start ./-->

<section class="products">
  <div class="container">
    <div class="row">
      <!-- /.Products Left Start ./-->
      <div class="col-lg-9 col-md-9">
        <div class="pro-title">
          <h2>Products</h2>
          <div class="addthis_inline_share_toolbox"></div>
        </div>
        <div class="gap-30"></div>
        <div class="gallery">
          <!-- /.Products row start ./-->
          <div class="row content-service">

            @foreach($items as $item)
            <!--Product -->
            <div class="col-lg-4 col-md-4 col-sm-4" style="margin-bottom:30px;">
              <ul class="pro-box">
                <li class="pro">
                  @if($item->discount > 0)
					<div class="discount" style="position:absolute;font-size:24pt;font-weight:bold;left:15px;top:10px;color:#FFF;text-shadow:0px 0px 9px #808283;">
					  {{ $item->discount }}%
					</div>

                  @endif
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
                @if($item->discount > 0)
                <li><strike class="text-danger">PRICE {{ number_format($item->price_publish,2,'.',',') }}  {{ $item->iso_code }}</strike></li>
                @else
                <br />
                @endif
                <li class="pro-footer">
                  <a href="{{ url($item->slug_spa . '/servicepack/' . $item->slug) }}" title="{{ $item->servicepack }}" class="btn btn-default">
                    DETAIL {{ number_format(($item->price_publish - (($item->price_publish * $item->discount) / 100)),2,'.',',') }} {{ $item->iso_code }}
                  </a>
                </li>
              </ul>
            </div>
            <!--Product End -->
            @endforeach
          </div>
          <!-- /.Products row end ./-->
        </div>

        <div class="gap-30"></div>
        <div class="paging">
          {!! $items->render() !!}
        </div>
      </div>
      <!-- /.products Left End ./-->

      <!-- /.sidebar Start ./-->
      <div class="col-lg-3 col-md-3 sidebar">
        <!-- /.Search ./-->
        <div class="search">
          <form>
            <input name="src" type="text" placeholder="Search for Service:" onkeyup="search(1)">
            <button type="button" onclick="search(1)"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <!-- /.Search End ./-->

        <div class="form-group">
          <label class="btn btn-primary btn-block">
            <input type="checkbox" onclick="search(1)" autocomplete="off" name="discount" class="pull-left"> <strong>Discount Only</strong>
          </label>
        </div>

        <!-- /.Categoris list start ./-->
        <div class="ser-cats"> <strong class="stitle">SPA Networks</strong>
          <select class="form-control" name="allspa[]" multiple style="height:400px;" onchange="search(1)">
            <option value="">Loading...</option>
          </select>
        </div>
        <!-- /.Categoris list End ./-->
        <div class="gap-30"></div>

        <!-- /.Categoris list start ./-->
        <div class="ser-cats"> <strong class="stitle">CURRENCIES</strong>
          <select class="form-control" name="currencies[]" multiple onchange="search(1)">
            <option value="">Loading...</option>
          </select>
        </div>
        <!-- /.Categoris list End ./-->

        <div class="gap-30"></div>

        <!-- /.Categoris list start ./-->
        <div class="ser-cats"> <strong class="stitle">SERVICE OR PACKAGE</strong>
          <select class="form-control" name="types[]" multiple onchange="search(1)">
            <option value="1" selected>Spa Service</option>
            <option value="2" selected>Spa Package</option>
          </select>
        </div>
        <!-- /.Categoris list End ./-->

      </div>
      <!-- /.sidebar End ./-->
    </div>
  </div>
</section>

<!-- /.Blog End ./-->

<div class="gap"></div>


@endsection

@section('js')
  <script type="text/javascript" src="{{ asset('/front/js/servicepack.js') }}"></script>
@endsection
