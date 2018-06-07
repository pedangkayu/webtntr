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

@section('header')
  @if(!empty($spa->header1) || !empty($spa->header2))
    <div class="slider">
      <div class="wrap">
        <div class="slider_top">
          <div class="slider_left">
              <div class="wmuSlider example2">
                <div class="wmuSliderWrapper">
                  @if(!empty($spa->header1))
                  <article> <img src="{{ asset('/img/spa/headers/' . $spa->header1) }}"/> </article>
                  @endif
                  @if(!empty($spa->header2))
                  <article> <img src="{{ asset('/img/spa/headers/' . $spa->header2) }}"/> </article>
                  @endif
                </div>
                <script src="{{ asset('tems/template01/js/jquery.wmuSlider.js') }}"></script>
                <script type="text/javascript" src="{{ asset('tems/template01/js/modernizr.custom.min.js') }}"></script>
                <script>
                      $('.example2').wmuSlider({
                          touch: true,
                          animation: 'slide'
                      });
                </script>
             </div>
          </div>
          <div class="clear"></div>
       </div>
    </div>
   </div>
   @endif

@endsection

@section('content')
<div class="section group">
<div class="cont about_desc">
      <h2>{{ $spa->spa }}</h2>
      <div style="line-height:20pt;color:#888;">
        {!! $spa->description !!}
      </div>

      @if(!empty($spa->benefit))
        <br /><br />
        <h2>Benefit</h2>
        <div style="line-height:20pt;color:#888;">
          {!! $spa->benefit !!}
        </div>
      @endif

      @if(!empty($spa->facilities))
        <br /><br />
        <h2>Facilities</h2>
        <div style="line-height:20pt;color:#888;">
          {!! $spa->facilities !!}
        </div>
      @endif

      @if(!empty($spa->features))
        <br /><br />
        <h2>Features</h2>
        <div style="line-height:20pt;color:#888;">
          {!! $spa->features !!}
        </div>
      @endif

      @if(!empty($spa->policy))
        <br /><br />
        <h2>Policy</h2>
        <div style="line-height:20pt;color:#888;">
          {!! $spa->policy !!}
        </div>
      @endif

</div>
<div class="rsidebar span_1_of_3">
  <div class="addthis_inline_share_toolbox"></div>
  <div class="latest_comments">
    <h2>INFORMATION</h2>
      <div class="comments">
          <h4 style="margin:0;"><a>Work Day</a></h4>
          <p style="margin:0;">{{ $spa->work_day }}</p>
          <h4 style="margin:0;"><a>Work Hour</a></h4>
          <p style="margin:0;">{{ $spa->work_hour }}</p>
          <h4 style="margin:0;"><a>Off Day</a></h4>
          <p style="margin:0;">{{ $spa->day_off }}</p>

      </div>
  </div>

  @if(count($schedules) > 0)
  <div class="latest_comments">
    <h2>SCHEDULE</h2>
    @foreach($schedules as $item)
    <div class="comments" style="margin:0;padding:5px;">
      <h4 style="margin:0;"><a href="{{ url($spa->slug . '/schedule/' . $item->slug) }}">{{ $item->nm_schedule }}</a></h4>
      <p style="margin:0;">{{ Format::substr(strip_tags($item->description), 80) }}</p>
      <p style="margin:0;font-size:9pt;color:#628c06;">
        {{ date('M d, Y \a\t h:i A', strtotime($item->time_start)) }}
        @if($item->time_end > $item->time_start)
         - {{ date('M d, Y \a\t h:i A', strtotime($item->time_end)) }}
        @endif
      </p>
    </div>
    @endforeach
  </div>
  @endif

</div>

</div>


  @if(count($services) > 2)
    <div class="spa_products" style="padding:0;">
      <h2>Latest Services</h2>
      <div class="section group">
        @foreach($services as $item)
          <div class="products_1_of_3" style="position:relative;">
              @if($item->discount > 0)
                <div class="discount" style="position:absolute;font-size:24pt;font-weight:bold;right:30px;top:40px;color:#fff;text-shadow:0px 0px 9px #333;">
                  {{ $item->discount }}%
                </div>
              @endif
              <img src="{{ asset('/img/servicepack/' . $item->img_thumbnail) }}" alt="{{ $item->servicepack }}" />
              <a href="{{ url($spa->slug . '/servicepack/' . $item->slug) }}"><h3 style="font-size:16px; color:#CF0000; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;width: 100%;display: inline-block;" title="{{ $item->servicepack }}">{{ $item->servicepack }}</h3></a>
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
  @endif

  @if(count($packages) > 2)
    <div class="spa_products" style="padding:30px 0px 0px 0px;">
      <h2>Latest Packages</h2>
      <div class="section group">
        @foreach($packages as $item)
          <div class="products_1_of_3" style="position:relative;">
              @if($item->discount > 0)
                <div class="discount" style="position:absolute;font-size:24pt;font-weight:bold;right:30px;top:40px;color:#fff;text-shadow:0px 0px 9px #333;">
                  {{ $item->discount }}%
                </div>
              @endif
              <img src="{{ asset('/img/servicepack/' . $item->img_thumbnail) }}" alt="{{ $item->servicepack }}" />
              <a href="{{ url($spa->slug . '/servicepack/' . $item->slug) }}"><h3 style="font-size:16px; color:#CF0000; overflow: hidden;text-overflow: ellipsis;white-space: nowrap;width: 100%;display: inline-block;" title="{{ $item->servicepack }}">{{ $item->servicepack }}</h3></a>
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
  @endif

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
