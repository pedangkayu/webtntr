
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
<div class="section group">
<div class="cont about_desc">
      <h2>{{ $service->servicepack }}</h2>
      <div style="margin-bottom:10px;color:#6EA522;font-weight:bold;">
        PRICE {{ number_format(($service->price_publish - ( ($service->price_publish * $service->discount) / 100 )),2,'.',',') }} {{ $service->iso_code }}
        @if($service->discount > 0)
          &middot; Disc {{ $service->discount }} % &middot; <strike style="color:#ff0000;">{{ number_format($service->price_publish,2,'.',',') }} {{ $service->iso_code }}</strike>
        @endif
      </div>

      <div class="addthis_inline_share_toolbox"></div>
      <br />
      <div style="line-height:20pt;color:#888;">
        {!! $service->description !!}
      </div>
      <br /><br /><br />
      <div class="btnbuy" style="text-align:center;"><a style="text-align:center;" href="{{ url($spa->slug . '/book/' . $service->slug) }}">BOOK NOW</a></div>
</div>
<div class="rsidebar span_1_of_3">
  <img src="{{ asset('/img/servicepack/' . $service->img_thumbnail) }}" alt="{{ $service->servicepack }}">
  <div class="latest_comments">
      <div class="comments" style="color:#6EA522;">
	      <p><b>{{ $service->type == 1 ? 'SERVICE' : 'PACKAGE' }} </b> <br />
          Duration : {{ $service->duration }} &middot;  Minimal Pax : {{ $service->minimal_pax }}</p>

          @if($service->free_pickup > 0)
			           <div class="btnbuy"><a href="{{ url($spa->slug . '/book/' . $service->slug . '?free=' . $service->free_pickup) }}">FREE PICK UP MINIMAL {{ $service->free_pickup }} PERSON</a></div>
          @endif
      </div>
  </div>

</div>

<div class="clear"></div>
  <div class="spa_products" style="padding:0;">
    <h2>Related Services</h2>
    <div class="section group">
      @foreach($relasi as $item)
        <div class="products_1_of_3" style="position:relative;">
            @if($item->discount > 0)
              <div class="discount" style="position:absolute;font-size:24pt;font-weight:bold;right:30px;top:40px;color:#fff;text-shadow:0px 0px 9px #333;">
                {{ $item->discount }}%
              </div>
            @endif
            <img src="{{ asset('/img/servicepack/' . $item->img_thumbnail) }}" alt="{{ $item->servicepack }}" />
            <a href="{{ url($spa->slug . '/servicepack/' . $item->slug) }}"><h3 style="overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 100%;display: inline-block;" title="{{ $item->servicepack }}">{{ $item->servicepack }}</h3></a>
            <div style="margin-bottom:10px;color:#888;font-weight:bold;font-size:9pt;text-align:center;">
              PRICE {{ number_format(($item->price_publish - ( ($item->price_publish * $item->discount) / 100 )),2,'.',',') }} {{ $item->iso_code }}
              @if($item->discount > 0)
                | <strike style="color:#ff0000;">{{ number_format($item->price_publish,2,'.',',') }} {{ $item->iso_code }}</strike>
              @endif
            </div>
            <p><small>{!! Format::substr(strip_tags($item->description), 100) !!}</small></p>
             <div class="read_more"><a href="{{ url($spa->slug . '/servicepack/' . $item->slug) }}">PREVIEW</a></div>
        </div>
      @endforeach
     </div>
  </div>


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
