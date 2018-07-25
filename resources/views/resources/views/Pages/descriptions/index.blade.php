@extends('layouts.app')
@section('meta')
  <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/summernote/summernote.css?1425218701') }}" />
@endsection
@section('content')

<form method="post">
    <div class="row">
      <div class="col-sm-10">

		<div class="card">
			<div class="card-head">
				<ul class="nav nav-tabs" data-toggle="tabs">
					<?php $no = 0; ?>
					@foreach($languages as $language)
					<?php $no++ ?>
						<li class="{!! $no == 1 ? 'active' : '' !!}"><a href="#{!! $language->id !!}">{!! $no !!} {!! $language->name !!}</a></li>
					@endforeach
				</ul>
			</div><!--end .card-head -->
			<div class="card-body tab-content">
				<?php $no = 0; ?>
				@foreach($languages as $language)
				<?php $no++ ?>
					<div class="tab-pane {!! $no == 1 ? 'active' : '' !!}" id="{!! $language->id !!}">
						<div class="form-group">
							<label for="deskripsi">DESKRIPSI</label>
				          	<textarea name="deskripsi[{!! $language->id !!}]" id="summernote" class="form-control summernote"></textarea>
				      	</div>
					</div>
				@endforeach

			</div><!--end .card-body -->

		</div><!--end .card -->

		<a href="/pages" class="btn btn-success">CANCEL</a>
		<input type="submit" name="btn" class="btn btn-primary" value="SAVE">

    </div>
    {{ csrf_field() }}
  </form>

@endsection
@section('footer')
<script src="{{ asset('/js/libs/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('/js/libs/summernote/summernote.min.js') }}"></script>
<script type="text/javascript">

  	$('.summernote').summernote({
	    height: 300,
	    placeholder: 'Description',
	    onChange: function(contents, $editable) {
	      $(this).val(contents);
	    }
	  });

	// Full toolbar
	$('#summernote').summernote();

</script>
@endsection