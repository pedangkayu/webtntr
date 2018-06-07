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
  <form class="form" action="{{ url('/spa') }}" method="post" enctype="multipart/form-data">
    <div class="row">
      <div class="col-sm-7">

        <div class="card">
          <textarea name="description" class="form-control summernote" rows="3">{!! old('description') !!}</textarea>
      	</div>

        <div class="card">
          <div class="card-head">
            <ul class="nav nav-tabs pull-right" data-toggle="tabs">
              <li class="active"><a href="#policy"><i class="fa fa-shield"></i> POLICY</a></li>
              <li><a href="#first1">BENEFIT</a></li>
              <li><a href="#second1">FACILITIES</a></li>
              <li><a href="#third1">FEATURES</a></li>
            </ul>
            <header>DETAIL</header>
          </div><!--end .card-head -->
          <div class="tab-content">
            <div class="tab-pane active" id="policy">
              <textarea name="policy" id="features" class="form-control summernote-simple" rows="3" placeholder="">{{ old('policy') }}</textarea>
            </div>
            <div class="tab-pane" id="first1">
              <textarea name="benefit" id="benefit" class="form-control summernote-simple" rows="3" placeholder="">{{ old('benefit') }}</textarea>
            </div>
            <div class="tab-pane" id="second1">
              <textarea name="facilities" id="facilities" class="form-control summernote-simple" rows="3" placeholder="">{{ old('facilities') }}</textarea>
            </div>
            <div class="tab-pane" id="third1">
              <textarea name="features" id="features" class="form-control summernote-simple" rows="3" placeholder="">{{ old('features') }}</textarea>
            </div>
          </div><!--end .card-body -->
        </div><!--end .card -->


        <div class="card">
      		<div class="card-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="latitude" class="form-control" id="lat" value="{{ old('latitude') ? old('latitude') : '-8.4309778' }}" required>
                    <label for="lat">LATITUDE</label>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <input type="text" name="longitude" class="form-control" id="lng" value="{{ old('longitude') ? old('longitude') : '115.0964163' }}" required>
                    <label for="lng">LONGITUDE</label>
                  </div>
                </div>
              </div>
      		</div>
      	</div>

        <div class="card">
      		<div class="card-body no-padding" style="position:relative;">
            <input id="pac-input" class="controls" type="text" placeholder="Search...">
            <div id="map" style="height:500px;">Loading...</div>
      		</div>
      	</div>

      </div>

      <div class="col-sm-5">
        <div class="card">
      		<div class="card-body">

			<div class="form-group">
			  <input type="text" name="slug" class="form-control" id="slug" placeholder="/paladin-satu"  required value="{{ old('slug') }}">
			  <label for="slug">URL *</label>
			  <p class="help-block">{{ url('/paladin-satu') }}</p>
			</div>

              <div class="form-group">
                <input type="text" name="spa" value="{{ old('spa') }}" class="form-control" id="regular1" required>
                <label for="regular1">SPA NAME *</label>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" value="{{ old('email') }}" name="email" id="email" required>
                <label for="email">EMAIL *</label>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" id="placeholder1" required>
                <label for="placeholder1">PHONE *</label>
              </div>

              <div class="form-group">
                <input type="text" name="website" value="{{ old('website') }}" class="form-control" id="website">
                <label for="regular1">WEBSITE</label>
              </div>

              <div class="form-group">
                <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" id="placeholder1">
                <label for="placeholder1">MOBILE</label>
              </div>

              <div class="form-group">
                <input type="text" name="fax" value="{{ old('fax') }}" class="form-control" id="placeholder1">
                <label for="placeholder1">FAX</label>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="tooltip1" name="work_day" value="{{ old('work_day') }}" placeholder="eg: Monday, Tuesday, ..." required>
                <label for="help1">WORK DAYS *</label>
              </div>

              <div class="form-group">
                <input type="text" class="form-control time-mask" name="work_hour" value="{{ old('work_hour') }}" id="work_hour" required>
                <label for="work_hour">WORK HOUR *</label>
                <p class="help-block">Time: 24h</p>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" id="day_off" name="day_off" value="{{ old('day_off') }}" placeholder="eg: Monday, Tuesday, ..." required>
                <label for="day_off">DAYS OFF *</label>
              </div>

              <div class="form-group">
                <select id="select1" name="id_regional" class="form-control" required>
                  <option value=""> - Select Region - </option>
                  @foreach($regions as $region)
                    <option value="{{ $region->id_regional }}" {{ old('id_regional') == $region->id_regional ? 'selected' : '' }}>{{ $region->nm_regional }}</option>
                  @endforeach
                </select>
                <label for="select1">REGION *</label>
              </div>
              <div class="form-group">
                <textarea name="address" id="textarea1" class="form-control" rows="3" placeholder="" required>{{ old('address') }}</textarea>
                <label for="textarea1">ADDRESS *</label>
              </div>
      		</div>
      	</div>


        <div class="card">
      		<div class="card-body">
				  <div class="form-group">
					<input type="text" name="facebook" value="{{ old('facebook') }}" class="form-control" id="facebook">
					<label for="facebook">FACEBOOK</label>
					<p class="help-block">https://facebook.com/paladin</p>
				  </div>

				  <div class="form-group">
					<input type="text" name="instagram" value="{{ old('instagram') }}" class="form-control" id="instagram">
					<label for="instagram">INSTAGRAM</label>
					<p class="help-block">@paladin</p>
				  </div>

				  <div class="form-group">
					<input type="text" name="path" value="{{ old('path') }}" class="form-control" id="path">
					<label for="path">PATH</label>
					<p class="help-block">paladin</p>
				  </div>

				  <div class="form-group">
					<input type="text" name="twitter" value="{{ old('twitter') }}" class="form-control" id="twitter">
					<label for="twitter">TWITTER</label>
					<p class="help-block">@paladin</p>
				  </div>
      		</div>
      	</div>


        <!-- SEO TOOL -->
        <div class="card">
          <div class="card-head">
      			<header>SEO TOOL</header>
      		</div>
      		<div class="card-body">

				<div class="form-group">
					<input type="text" name="seo_title" value="{{ old('seo_title') }}" class="form-control" id="seo_title">
					<label for="seo_title">TITLE</label>
					<p class="help-block info_lenght_title">length <span class="lenght_seo_title">50</span> character</p>
				</div>

				<div class="form-group">
					<textarea name="seo_keywords" id="seo_keywords" class="form-control" rows="10" placeholder="">{{ old('seo_keywords') }}</textarea>
					<label for="seo_keywords">KEYWORDS</label>
					<p class="help-block">separated by comma</p>
				</div>

				  <div class="form-group">
					<textarea name="seo_description" id="seo_description" class="form-control" rows="3" placeholder="">{{ old('seo_description') }}</textarea>
					<label for="seo_description">DESCRIPTION</label>
					<p class="help-block info_lenght_desc">length <span class="length_seo_desc">160</span> character</p>
				  </div>

      		</div>
      	</div>

        <div class="card">
      		<div class="card-body">
            <div class="form-group">
              <input type="file" class="form-control" id="logo" name="logo_img">
              <label for="logo">LOGO</label>
              <p class="help-block">Default: 227px x 67px</p>
            </div>

            <div class="form-group">
              <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
              <label for="img_thumbnail">IMAGE THUMBNAIL</label>
              <p class="help-block">Size: 370px x 220px</p>
            </div>
      		</div>

          <div class="card-actionbar">
              <div class="card-actionbar-row">
                  <a href="{{ url('/spa') }}" class="btn btn-flat pull-left btn-accent ink-reaction">CANCEL</a>
                  <button type="submit" class="btn btn-flat btn-accent ink-reaction">SAVE NEW</button>
              </div>
          </div>

      	</div>
      </div>

    </div>
    {{ csrf_field() }}
  </form>
@endsection

@section('footer')
  <script src="{{ asset('/js/libs/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
  <script src="{{ asset('/js/libs/summernote/summernote.min.js') }}"></script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3STOH44jKGz1o_ud_Y5dIHC7cwJlQIR4&libraries=places&callback=initMap"></script>
  <script type="text/javascript" src="{{ asset('/js/modules/spa/create.js') }}"></script>
@endsection
