
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
<div style="color:#888;line-height:20pt;">
  <h3>Success</h3>
  <p>
    Thank you very much for your interest of using our service Our staff will reply your reservation as soon as possible, usualy within 24 hours We have received the following informations.
  </p>
  <p>Please check your email for detail</p>
  <div class="read_more" style="text-align:left;"><a style="text-align:center;" href="{{ url($spa->slug) }}">BACK TO HOME</a></div>
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
