
@extends('templates.template01.layout')

@section('phone', $spa->premium ? $spa->phone : $bali->mobile)
@section('logo', '<img src="' . asset('/img/logo/' . $spa->logo) . '" alt="' . $spa->spa . '"/>')

@section('social')
<ul>
  <li><a href="{{ $spa->facebook }}" target="_blank"><img src="{{ asset('tems/template01/images/facebook.png') }}" alt="" /></a></li>
  <li><a href="https://twitter.com/{{ $spa->twitter }}" target="_blank"><img src="{{ asset('tems/template01/images/twitter.png') }}" alt="" /></a></li>
  <li><a href="https://instagram.com/{{ str_replace('@', '', $spa->twitter) }}" target="_blank"><img src="{{ asset('tems/template01/images/instagram.png') }}" alt="" /></a></li>
</ul>
@endsection

@section('menu')
  <ul>
    @foreach($menus as $menu)
      <li class="{{ $menu['active'] }}"><a href="{{ url($menu['url']) }}">{{ $menu['title'] }}</a></li>
    @endforeach
    <div class="clear"></div>
  </ul>
@endsection

@section('content')

<div class="spa_products" style="margin:0;padding:0;">
  <h2>{{ $title }}</h2>
  <div class="section group">
    @forelse($services as $service)
    <div class="products_1_of_3" style="min-height:550px; max-width:300px;">
        <div style="text-align:center;">
          <img width="250" height="250" src="{{ asset('/img/servicepack/thumb/' . $service->img_thumbnail) }}" alt="{{ $service->servicepack }}" title="{{ $service->servicepack }}" />
        </div>
        <h3 style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 100%;display: inline-block; color:#6EA522;font-weight:bold;"><a style="color:#6EA522;font-weight:bold;" href="{{ url($spa->slug . '/servicepack/' . $service->slug) }}">{{ $service->servicepack }}</a></h3>

        <div class="price-service">
          <small>
            PRICE {{ number_format(($service->price_publish - ( ($service->price_publish * $service->discount) / 100 )),2,'.',',') }} {{ $service->iso_code }}
            @if($service->discount > 0)
              | <strike style="color:#ff0000;">{{ number_format($service->price_publish,2,'.',',') }} {{ $service->iso_code }}</strike>
            @endif
          </small>
        </div>
        <p>{{ Format::substr(strip_tags($service->description), 200) }}</p>
        <div style="text-align:right;margin-top:20px;">
          <div class="btnbuy"><a href="{{ url($spa->slug . '/book/' . $service->slug) }}">BOOK NOW</a></div>
        </div>
    </div>
    @empty
      <p>Service does not have</p>
    @endforelse
   </div>
</div>

<div class="paginate">
  {!! $services->render() !!}
</div>

@endsection



@section('footer')
<div>
      <div class="wrap">
        <div class="footer_grides">
          <div class="footer_grid1">
            <h3>{{ $spa->spa }}</h3>
            <div class="address">
            <ul>
                <li>{{ $spa->address }}</li>
                @if($spa->premium)
                  <li>
                    <address>
                      <p>Phone: {{ $spa->phone }}</p>
                      <p>Mobile: {{ $spa->mobile }}</p>
                      <p>Fax: {{ $spa->fax }}</p>
                    </address>
                  </li>
                @else
                  <li>
                    <address>
                      <p>Phone: {{ $bali->phone }}</p>
                      <p>Mobile: {{ $bali->mobile }}</p>
                      <p>Fax: {{ $bali->fax }}</p>
                    </address>
                  </li>
                @endif
            </ul>
         </div>
            </div>
      <div class="footer_grid2">&nbsp;</div>
      <div class="footer_grid3">&nbsp;</div>
    <div class="footer_grid4">
    <h3>Follow US</h3>
      <div class="social-footer">
          <ul>
            <li><a href="{{ $spa->facebook }}" target="_blank"><img src="{{ asset('tems/template01/images/facebook.png') }}" alt="" /></a></li>
            <li><a href="https://twitter.com/{{ $spa->twitter }}" target="_blank"><img src="{{ asset('tems/template01/images/twitter.png') }}" alt="" /></a></li>
            <li><a href="https://instagram.com/{{ str_replace('@', '', $spa->twitter) }}" target="_blank"><img src="{{ asset('tems/template01/images/instagram.png') }}" alt="" /></a></li>
          </ul>
      </div>
   </div>
   <div class="clear"></div>
    </div>
   </div>
 </div>
@endsection
