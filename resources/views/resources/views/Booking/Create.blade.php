@extends('layouts.app')

@section('meta')
  <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/select2/select2.css?1424887856') }}" />
@endsection

@section('content')

  <form class="form" action="{{ url('/booking') }}" method="post">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-sm-7">

          {!! csrf_field() !!}
          <div class="card">
        		<div class="card-body">

              <div class="form-group">
                <label for="qty_person">QTY PERSON <text style="color:red;">*</text></label>
                <select class="form-control" name="qty_person" id="qty_person" required>
                  @for($i = 1; $i <= 50; $i++)
                  <option value="{{ $i }}" {!! old('qty_person') == $i ? 'selected' : '' !!}>{{ $i }} person</option>
                  @endfor
                </select>
              </div>

              <div class="form-group">
                <label for="day_request">SPA DATE <text style="color:red;">*</text></label>
                <input type="date" class="form-control" name="day_request" value="{{ date('Y-m-d') }}" required>
                <p class="help-block">(MM/DD/YYYY)</p>
              </div>

              <div class="form-group">
                <label for="time_request">REQUEST TIME <text style="color:red;">*</text></label>
                <input type="time" class="form-control" name="time_request" value="{{ date('H:i') }}" required>
              </div>

              <div class="form-group">
                <label for="note">SPECIAL REQUEST</label>
                <textarea name="note" id="note" class="form-control" rows="4">{{ old('note') }}</textarea>
              </div>

              <div class="form-group">
                <label for="title">TITLE <text style="color:red;">*</text></label>
                <select class="form-control" name="title" id="title" required>
                  <option value="">Please Select</option>
                  <option value="Mr." {!! old('title') == 'Mr.' ? 'selected' : '' !!}>Mr.</option>
                  <option value="Mrs." {!! old('title') == 'Mrs.' ? 'selected' : '' !!}>Mrs.</option>
                  <option value="Miss." {!! old('title') == 'Miss.' ? 'selected' : '' !!}>Miss.</option>
                  <option value="Ms." {!! old('title') == 'Ms.' ? 'selected' : '' !!}>Ms.</option>
                </select>
              </div>

              <div class="form-group">
                <label for="name_customer">NAME <text style="color:red;">*</text></label>
                <input type="text" class="form-control" name="name_customer" id="name_customer" value="{{ old('name') }}" required>
              </div>

              <div class="form-group">
                <label for="email">EMAIL <text style="color:red;">*</text></label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" required>
              </div>

              <div class="form-group">
                <label for="phone">MOBILE PHONE <text style="color:red;">*</text></label>
                <input type="text" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" required>
                <p class="help-block"><i>(Whatsapp/Line Number With Country Code)</i></p>
              </div>

              <div class="form-group">
                <label for="email">COUNTRY OG ORIGIN <text style="color:red;">*</text></label>
                <select class="form-control" name="country_id" id="country_id" required>
                  <option value="">Please Select</option>
                  @foreach($negara as $item)
                    <option value="{{ $item->id_country }}" {!! old('country_id') == $item->id_country ? 'selected' : '' !!}>{{ $item->nm_country }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="city">CITY</label>
                <input type="text" class="form-control" name="city" id="city" value="{{ old('city') }}">
              </div>

              <div class="form-group">
                <label for="address">ADDRESS</label>
                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}">
              </div>

              <div class="form-group">
                <label for="hotel">HOTEL IN BALI</label>
                <input type="text" class="form-control" name="hotel" id="hotel" value="{{ old('hotel') }}">
              </div>

              <div class="form-group">
                <label for="checkin_hotel">CHECK IN HOTEL</label>
                <input type="date" class="form-control" name="checkin_hotel" value="{{ old('checkin_hotel') }}">
                <p class="help-block">(MM/DD/YYYY)</p>
              </div>

              <div class="form-group">
                <label for="contact_hotel">HOTEL TELEPHONE</label>
                <input type="text" class="form-control" name="contact_hotel" id="contact_hotel" value="{{ old('contact_hotel') }}">
              </div>

        		</div>
        		<div class="card-actionbar">
        				<div class="card-actionbar-row">
        						<button type="submit" class="btn btn-flat btn-accent ink-reaction">Booking</button>
        				</div>
        		</div>
        	</div>

      </div>

      <div class="col-sm-5">

        <div class="card">
      		<div class="card-body">

            <div class="form-group">
              <label for="id_spa">LIST SPA <text style="color:red;">*</text></label>
              <select class="form-control" id="id_spa" name="id_spa" required onchange="findservice();">
                <option value="">Please Select</option>
                @foreach($items as $item)
                <option value="{{ $item->id_spa }}">{{ $item->spa }}</option>
                @endforeach
              </select>
            </div>


            <div class="form-group">
              <label for="id_servicepack">LIST SERVICEPACK <text style="color:red;">*</text></label>
              <select class="form-control" name="id_servicepack" id="id_servicepack" required onchange="getdetail();">
                <option value="">Please Select</option>
              </select>
            </div>

            <div class="component"></div>

      		</div>
      	</div>

      </div>

    </div>
  </form>
@endsection


@section('footer')
  <script src="{{ asset('/js/libs/select2/select2.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/modules/booking/create.js') }}"></script>
@endsection
