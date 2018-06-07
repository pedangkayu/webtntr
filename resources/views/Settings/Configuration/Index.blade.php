@extends('layouts.app')

@section('meta')

@endsection

@section('content')

  <form class="form" action="{{ url('/app/configuration') }}" method="post">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-sm-8">

        <div class="card">
      		<div class="card-body">

            @foreach($items as $field => $val)
              <div class="form-group class_{{ $field }}">
                <label for="{{ $field }}">{{ ucwords(str_replace('_', ' ', $field)) }} <span style="color:red;">*</span></label>
                <input class="form-control" type="text" name="{{ $field }}" value="{{ old($field) ? old($field) : trim($val) }}" required>
              </div>
            @endforeach

      		</div>

      		<div class="card-actionbar">
      				<div class="card-actionbar-row">
      						<button type="submit" class="btn btn-flat btn-accent ink-reaction">Simpan Akun</button>
      				</div>
      		</div>

      	</div>

      </div>

      <div class="col-sm-4">

      </div>
    </div>
  </form>
@endsection

@section('footer')
  <script type="text/javascript">
    $(function(){
      $('.class_facebook, .class_instagram, .class_twitter, .class_gplus, .class_path').append('<p class="help-block">http://socialmedia.com/your.username</p>');
      $('.class_seo_title').append('<p class="help-block">Max 31 characters</p>');
      $('.class_seo_description').append('<p class="help-block">Max 150 characters</p>');
	  $('.class_linkage').append('<p class="help-block">Tautan yg berhubungan dgn Web Perusahaan</p>');
    });
  </script>
@endsection
