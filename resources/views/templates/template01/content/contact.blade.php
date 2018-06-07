
@extends('templates.bluereflection.layout')

@section('phone', $spa->premium ? $spa->phone : $bali->mobile)
@section('logo', '<img src="' . asset('/img/logo/' . $spa->logo) . '" alt="' . $spa->spa . '"/>')

@section('meta')

@endsection

@section('social')
<ul>
  <li><a href="{{ $spa->facebook }}" target="_blank"><img src="{{ asset('tems/bluereflection/images/facebook.png') }}" alt="" /></a></li>
  <li><a href="https://twitter.com/{{ $spa->twitter }}" target="_blank"><img src="{{ asset('tems/bluereflection/images/twitter.png') }}" alt="" /></a></li>
  <li><a href="https://instagram.com/{{ str_replace('@', '', $spa->twitter) }}" target="_blank"><img src="{{ asset('tems/bluereflection/images/instagram.png') }}" alt="" /></a></li>
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

<div class="contact-form">
 <h2>Contact Us</h2>
   @if (count($errors) > 0)
     <div style="background:orange;margin:10px;padding:15px;color:#333;">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
  @endif
   <form method="post" action="{{ url($spa->slug . '/sendcontact') }}" class="left_form">
     <div>
       <span><label>Subject <text style="color:red;">*</text></label></span>
       <span><input name="subject" type="text" class="textbox" required value="{{ old('subject') ? old('subject') : $spa->spa . ' information' }}"></span>
     </div>
     <div>
       <span><label>Name <text style="color:red;">*</text></label></span>
       <span><input name="from_name" type="text" required class="textbox" value="{{ old('name') }}"></span>
     </div>
     <div>
       <span><label>Email <text style="color:red;">*</text></label></span>
       <span><input name="from_email" value="{{ old('email') }}" type="text" required class="textbox"></span>
     </div>
     <div>
        <span><label>Message <text style="color:red;">*</text></label></span>
        <span><textarea  name="from_message" required>{{ old('message') }}</textarea></span>
      </div>
      <div>
        {!! Recaptcha::render() !!}
        <br />
        <span style="float:left;"><input type="submit" value="Send" class="myButton"></span>
      </div>
      <input type="hidden" name="id_spa" value="{{ $spa->id_spa }}">
   </form>

     @if(!empty($spa->latitude) && !empty($spa->longitude))
     <div class="right_form" style="margin-top:30px;">
       <div style="width:100%;height:350px;" id="map"></div>
       <p style="color:#888;line-height:20pt;">
         <strong>Address :</strong><br />
         {{ $spa->address }}
       </p>
     </div>
    @endif

   <div class="clear"></div>
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
    <h3>Follow Us</h3>
      <div class="social-footer">
          <ul>
            <li><a href="{{ $spa->facebook }}" target="_blank"><img src="{{ asset('tems/bluereflection/images/facebook.png') }}" alt="" /></a></li>
            <li><a href="https://twitter.com/{{ $spa->twitter }}" target="_blank"><img src="{{ asset('tems/bluereflection/images/twitter.png') }}" alt="" /></a></li>
            <li><a href="https://instagram.com/{{ str_replace('@', '', $spa->twitter) }}" target="_blank"><img src="{{ asset('tems/bluereflection/images/instagram.png') }}" alt="" /></a></li>
          </ul>
      </div>
   </div>
   <div class="clear"></div>
    </div>
   </div>
 </div>

 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3STOH44jKGz1o_ud_Y5dIHC7cwJlQIR4&callback=initMappaladin" async defer></script>
 <script type="text/javascript">
   function initMappaladin() {
       var myLatLng = {lat: {{ $spa->latitude }}, lng: {{ $spa->longitude }} };

       // Create a map object and specify the DOM element for display.
       var map = new google.maps.Map(document.getElementById('map'), {
         center: myLatLng,
         scrollwheel: true,
         zoom: 11
       });

       // Create a marker and set its position.
       var marker = new google.maps.Marker({
         map: map,
         position: myLatLng,
         title: `{{ $spa->spa }}, {{ $spa->address }}`
       });
     }
 </script>


@endsection
