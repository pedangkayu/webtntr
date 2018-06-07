@extends('templates.template01.layout')

@section('phone', $spa->premium ? $spa->phone : $bali->mobile)
@section('logo', '<img src="' . asset('/img/logo/' . $spa->logo) . '" alt="' . $spa->spa . '"/>')

@section('meta')
  <script type="text/javascript" src="{{ asset('/tems/reflection/js/script.js') }}"></script>
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

  <div class="contact-form">
   <h2>{{ $service->type == 1 ? 'SERVICE' : 'PACKAGE' }} BOOKING</h2>

     @if (count($errors) > 0)
       <div style="background:orange;margin:10px;padding:15px;color:#333;">
           <ul>
               @foreach ($errors->all() as $error)
                   <li>{{ $error }}</li>
               @endforeach
           </ul>
       </div>
    @endif

     <form method="post" action="{{ url($spa->slug . '/booking') }}">
       <div class="left_form">
         @if(!empty(Session::get('notif')) && !empty(Session::get('notif')['err']))
         <div class="err-message">
           <p>{{ Session::get('notif')['err'] }}</p>
         </div>
         @endif

         <div style="color:#888;text-align:right;">(<text style="color:red;">*</text>) required field</div>
         <div>
           <span><label for="qty_person">How Many Person(s) <text style="color:red;">*</text></label></span>
           <span>
              <select class="selectbox" name="qty_person" id="qty_person" required onchange="matematika();">
                @for($i = $minimal_pax; $i <= ($minimal_pax + 50); $i++)
                <option value="{{ $i }}" {!! old('qty_person') == $i ? 'selected' : '' !!}>{{ $i }} person</option>
                @endfor
              </select>
           </span>
         </div>

         <div>
           <span><label for="day_request">Spa Date <text style="color:red;">*</text></label> <small style="color:#aaa;">(MM/DD/YYY)</small></span>
           <span><input name="day_request" id="day_request" type="date" class="datebox" required style="width:95%;" value="{{ old('day_request') ? old('day_request') : date('Y-m-d') }}"></span>
         </div>

         <div>
           <span><label for="time_request">Request Time <text style="color:red;">*</text></label> <small style="color:#aaa;">(HH:MM)</small></span>
           <span><input name="time_request" id="time_request" type="time" class="datebox" required style="width:95%;" value="{{ old('time_request') ? old('time_request') : date('H:i') }}"></span>
         </div>

         <div>
           <span><label for="note">Special Request</label></span>
           <span>
            <textarea name="note" rows="6" style="height:100px;">{{ old('note') }}</textarea>
           </span>
         </div>

         <div>
           <span><label for="title">Title <text style="color:red;">*</text></label></span>
           <span>
              <select class="selectbox" name="title" id="title" required>
                <option value="">Please Select</option>
                <option value="Mr." {!! old('title') == 'Mr.' ? 'selected' : '' !!}>Mr.</option>
                <option value="Mrs." {!! old('title') == 'Mrs.' ? 'selected' : '' !!}>Mrs.</option>
                <option value="Miss." {!! old('title') == 'Miss.' ? 'selected' : '' !!}>Miss.</option>
                <option value="Ms." {!! old('title') == 'Ms.' ? 'selected' : '' !!}>Ms.</option>
              </select>
           </span>
         </div>

         <div>
           <span><label for="name_customer">Name <text style="color:red;">*</text></label></span>
           <span><input name="name_customer" value="{{ old('name_customer') }}" id="name_customer" type="text" class="textbox" required></span>
         </div>

         <div>
           <span><label for="email">Email <text style="color:red;">*</text></label></span>
           <span><input name="email" value="{{ old('email') }}" id="email" type="email" class="emailbox" required style="width:95%;"></span>
         </div>

         <div>
           <span><label for="phone">Mobile Phone <text style="color:red;">*</text> <i>(Whatsapp/Line Number With Country Code)</i></label></span>
           <span><input name="phone" value="{{ old('phone') }}" id="phone" type="text" class="textbox" required></span>
         </div>

         <div>
           <span><label for="country_id">Country of Origin <text style="color:red;">*</text></label></label></span>
           <span>
              <select class="selectbox" name="country_id" id="country_id" required>
                <option value="">Please Select</option>
                @foreach($negara as $item)
                  <option value="{{ $item->id_country }}" {!! old('country_id') == $item->id_country ? 'selected' : '' !!}>{{ $item->nm_country }}</option>
                @endforeach
              </select>
           </span>
         </div>

         <div>
           <span><label for="city">City</label></span>
           <span><input name="city" value="{{ old('city') }}" id="city" type="text" class="textbox" required></span>
         </div>

         <div>
           <span><label for="address">Address</label></span>
           <span><input name="address" value="{{ old('address') }}" id="address" type="text" class="textbox" required></span>
         </div>



         <hr />
         <div>
           <span><label for="hotel">Hotel In Bali</label></span>
           <span><input name="hotel" value="{{ old('hotel') }}" id="hotel" type="text" class="textbox"></span>
         </div>

         <div>
           <span><label for="checkin_hotel">Data Check In Hotel </label> <small style="color:#aaa;">(MM/DD/YYY)</small></span>
           <span><input name="checkin_hotel" value="{{ old('checkin_hotel') }}" id="checkin_hotel" type="date" class="datebox" style="width:95%;"></span>
         </div>


         <div>
           <span><label for="contact_hotel">Hotel Telephone </label></span>
           <span><input name="contact_hotel" value="{{ old('contact_hotel') }}" id="contact_hotel" type="text" class="textbox"></span>
         </div>

         {!! Recaptcha::render() !!}
         <br />

       </div>

       <div class="right_form">
	   <div class="booking-detail">
		 <div class="popular-post">
			<div class="post-grid">
				<img src="{{ asset('/img/servicepack/' . $service->img_thumbnail) }}" alt="{{ $spa->spa }} - {{ $service->type == 1 ? 'Service' : 'Package' }} {{ $service->servicepack }}" title="{{ $spa->spa }} - {{ $service->type == 1 ? 'Service' : 'Package' }} {{ $service->servicepack }}">

				<p>
				   <b>{{ $spa->spa }}</b><br />
				   <a href="{{ url($spa->slug . '/servicepack/' . $service->slug) }}">{{ $service->servicepack }}</a><br />

					 Price : {{ number_format(($service->price_publish - ( ($service->price_publish * $service->discount) / 100 )),2,'.',',') }} {{ $service->iso_code }}
					 @if($service->discount > 0)
					   | <strike style="color:#ff0000;">{{ number_format($service->price_publish,2,'.',',') }} {{ $service->iso_code }}</strike>
					 @endif
					 / Person
           @if($service->free_pickup > 0)
           <br />
           Free Pickup : <text class="free_pickup">NO</text>
           @endif
				</p>

				<div class="clear"> </div>
			</div>

			 <div class="billing">
				  <table>
					 <tr>
					   <td colspan="2"><b>Billing</b></td>
					 </tr>

					 <tr>
					   <td>Sub Total</td>
					   <td align="right">{{ number_format($service->price_publish,2,'.',',') }} {{ $service->iso_code }}</td>
					 </tr>

					 <tr>
					   <td>Person <text class="persons">{{ old('qty_person') ? old('qty_person') : $minimal_pax }}</text></td>
					   <td align="right"><text class="total-person">{{ old('qty_person') ?  number_format(($service->price_publish * old('qty_person')),2,'.',',') : number_format($service->price_publish,2,'.',',') }}</text> {{ $service->iso_code }}</td>
					 </tr>

					 <tr>
					   <td style="border-bottom:solid 1px #888;">Discount {{ number_format($service->discount,0,'.',',') }}%</td>
					   <td style="border-bottom:solid 1px #888;" align="right"><text class="aftdisc">{{ number_format((($service->price_publish * $service->discount) / 100 ),2,'.',',') }}</text> {{ $service->iso_code }}</td>
					 </tr>

					 <tr>
					   <td>Total</td>
					   <td align="right"><text class="total">{{ old('qty_person') ? number_format(( ($service->price_publish - ( ($service->price_publish * $service->discount) / 100 )) * old('qty_person') ),2,'.',',') : number_format(($service->price_publish - ( ($service->price_publish * $service->discount) / 100 )),2,'.',',') }}</text> {{ $service->iso_code }}</td>
					 </tr>
				   </table>
			 </div>

		  </div>

         </div>

       </div>



       <div style="margin-top:20px;clear:left;">
         <div class="btnbuy"><button style="width:250px;" type="submit">PROCCED</button></div>
       </div>
       <input type="hidden" name="id_servicepack" value="{{ $service->id_servicepack }}">
       <input type="hidden" name="type" value="{{ $service->type }}">
       <input type="hidden" name="id_spa" value="{{ $spa->id_spa }}">
       <input type="hidden" name="currenci_id" value="{{ $service->currenci_id }}">

       {!! csrf_field() !!}
     </form>
     <input type="hidden" name="subtotal" value="{{ $service->price_publish }}">
     <input type="hidden" name="discount" value="{{ $service->discount }}">
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
