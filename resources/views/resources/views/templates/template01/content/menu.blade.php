
@extends('templates.template01.layout')

@section('phone', $spa->premium ? $spa->phone : $bali->mobile)
@section('logo', '<img src="' . asset('/img/logo/' . $spa->logo) . '" alt="' . $spa->spa . '"/>')

@section('meta')
  <link rel="stylesheet" href="{{ asset('/vendor/fancyBox/source/jquery.fancybox.css') }}">
  <script type="text/javascript" src="{{ asset('/vendor/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/vendor/fancyBox/source/jquery.fancybox.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/vendor/fancyBox/source/jquery.fancybox.pack.js') }}"></script>
  <script type="text/javascript">
    $(function(){
      $(".fancybox").fancybox({
        prevEffect		: 'none',
      	nextEffect		: 'none',
      	closeBtn		: false,
      	helpers		: {
      		title	: { type : 'inside' },
      		buttons	: {}
      	}
      });
    });
  </script>

  <style media="screen">
    ul.list-servicepack {
      list-style-type: square;
      margin-left: 40px;
    }
    ul.list-servicepack li a{
      line-height: 22pt;
      color: #333;
    }
    ul.list-servicepack li a:hover{
      text-decoration: underline;
    }
  </style>
@endsection

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
  <h2>{{ $spa->spa }} Available Menu</h2>
  <div class="addthis_inline_share_toolbox"></div>

  <h3>Spa Packages</h3>
  <ul class="list-servicepack">
    @foreach($packages as $item)
      <li>
        <a href="{{ url($spa->slug . '/servicepack/' . $item->slug) }}">
          {{ $item->servicepack }}, ({{ $item->duration }}) <text style="color:red;">{{ number_format($item->price_publish) }} {{ $item->iso_code }}/person {{ $item->discount > 0 ? ' - Disc. ' . $item->discount . '%' : '' }}</text>
        </a>
      </li>
    @endforeach
  </ul>

  <h3>Spa Services</h3>
  <ul class="list-servicepack">
    @foreach($services as $item)
      <li>
        <a href="{{ url($spa->slug . '/servicepack/' . $item->slug) }}">
          {{ $item->servicepack }}, ({{ $item->duration }}) <text style="color:red;">{{ number_format($item->price_publish) }} {{ $item->iso_code }}/person {{ $item->discount > 0 ? ' - Disc. ' . $item->discount . '%' : '' }}</text>
        </a>
      </li>
    @endforeach
  </ul>


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
