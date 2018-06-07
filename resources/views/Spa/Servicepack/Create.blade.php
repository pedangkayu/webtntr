@extends('layouts.app')

@section('meta')
  <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/summernote/summernote.css?1425218701') }}" />
  <style>
    .controls {
      margin-top: 10px;
      border: 1px solid transparent;
      border-radius: 2px 0 0 2px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
      height: 32px;
      outline: none;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }

    #pac-input {
      background-color: #fff;
      font-family: Roboto;
      font-size: 15px;
      font-weight: 300;
      margin-left: 12px;
      padding: 0 11px 0 13px;
      text-overflow: ellipsis;
      width: 300px;
    }

    #pac-input:focus {
      border-color: #4d90fe;
    }

    .pac-container {
      font-family: Roboto;
    }

    #type-selector {
      color: #fff;
      background-color: #4d90fe;
      padding: 5px 11px 0px 11px;
    }

    #type-selector label {
      font-family: Roboto;
      font-size: 13px;
      font-weight: 300;
    }
    #target {
        width: 345px;
      }
    </style>

@endsection
@section('content')
  <form class="form" action="{{ url('/spa/servicepack') }}" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-sm-6">

        <div class="card">
          <textarea class="summernote" name="description" rows="8" cols="40">{!! old('description') !!}</textarea>
      	</div>

      </div>

      <div class="col-sm-6">
        <div class="card">
          <div class="card-head">
      			<header>{{ $spa->spa }}</header>
      		</div>
      		<div class="card-body">

            <div class="form-group">
              <select id="type" name="type" class="form-control" required>
                <option value="">-Select Type-</option>
                <option value="1">Service</option>
                <option value="2">Package</option>
              </select>
              <label for="type">TYPE *</label>
            </div>

              <div class="form-group">
                <input type="text" name="servicepack" value="{{ old('servicepack') }}" class="form-control" id="regular1" required>
                <label for="regular1">SERVICE / PACKAGE *</label>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" value="{{ old('duration') }}" name="duration" id="duration" required>
                <label for="duration">DURATION *</label>
              </div>

              <div class="row">
                <div class="col-sm-4">

                  <div class="form-group">
                    <select id="currenci_id" name="currenci_id" class="form-control" required>
                      <option value="">-Currencies-</option>
                      @foreach($currencies as $current)
                        <option value="{{ $current->id }}" {{ old('currenci_id') == $current->id ? 'selected' : '' }}>{{ $current->iso_code }} ({{ $current->symbol }})</option>
                      @endforeach
                    </select>
                    <label for="currenci_id">CURRENCY *</label>
                  </div>

                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <input onkeyup="matematika_price();matematika_percen();" type="decimal" class="form-control text-right" name="price_contract" value="{{ old('price_contract') }}" id="price_contract" required>
                    <label for="price_contract">PRICE CONTRACT *</label>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <input onkeyup="matematika_price();" type="decimal" class="form-control text-right" name="price_publish" value="{{ old('price_publish') }}" id="price_publish" required>
                    <label for="price_publish">PRICE PUBLISH *</label>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="decimal" class="form-control text-right" name="discount" value="{{ old('discount') ? old('discount') : 0 }}" id="discount" required>
                    <label for="discount">DISCOUNT % *</label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <input onkeyup="matematika_percen();" type="decimal" class="form-control text-right" name="percen_contract" value="{{ old('percen_contract') ? old('percen_contract') : 0 }}" id="percen_contract" required>
                    <label for="percen_contract">PERCEN CONTRACK % *</label>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
					<input type="text" name="minimal_pax" value="{{ old('minimal_pax') ? old('minimal_pax') : 1 }}" class="form-control" id="website">
					<label for="minimal_pax">MINIMAL PAX</label>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
					<input type="text" name="free_pickup" value="{{ old('free_pickup') ? old('free_pickup') : 1 }}" class="form-control" id="website">
					<label for="minimal_pax">FREE PICKUP</label>
					<p class="help-block">enter the number of person</p>
                  </div>
                </div>
              </div>

      		</div>
      	</div>

        <div class="card">
      		<div class="card-body">
            <div class="form-group">
              <input type="file" class="form-control" id="img_thumbnail" name="img_thumb">
              <label for="img_thumbnail">IMAGE THUMBNAIL</label>
              <p class="help-block">Size: 500px x 500px</p>
            </div>

            <!-- <div class="form-group">
              <input type="file" class="form-control" id="images" name="images[]" multiple="multiple">
              <label for="images">MORE IMAGES</label>
            </div> -->
      		</div>

          <div class="card-actionbar">
              <div class="card-actionbar-row">
                  <a href="{{ url('/spa/servicepack?referal=' . base64_encode($id) . '&_k=' . sha1(time())) }}" class="btn btn-flat pull-left btn-accent ink-reaction">CANCEL</a>
                  <button type="submit" class="btn btn-flat btn-accent ink-reaction">SAVE NEW</button>
              </div>
          </div>

      	</div>
      </div>

    </div>
    {{ csrf_field() }}
    <input type="hidden" name="id_spa" value="{{ $id }}">
  </form>
@endsection

@section('footer')
  <script src="{{ asset('/js/libs/summernote/summernote.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/modules/spa/servicepack/create.js') }}"></script>
@endsection
