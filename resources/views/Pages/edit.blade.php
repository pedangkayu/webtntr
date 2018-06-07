@extends('layouts.app')

@section('content')
  <form method="post">
    <div class="row">
      <div class="col-sm-12">

		<div class="card">
			<div class="card-head">
				<ul class="nav nav-tabs" data-toggle="tabs">
					<?php 
						$no = 0;
						$val = App\Models\pages::where('code', $code)->first();
					?>
					@foreach($languages as $language)
					<?php $no++ ?>
						<li class="{!! $no == 1 ? 'active' : '' !!}"><a href="#{!! $language->id !!}">{!! $language->name !!}</a></li>
					@endforeach
					@if($val->stsdms != 1)
						<div class="pull-right" id="deskripsi">
							<a class="btn btn-primary btn-xs" id="description" data-slug="{!! $val->slug !!}" href="javascript:;">DESKRIPSI</a>
						</div>
					@endif

				</ul>
			</div><!--end .card-head -->
			<div class="card-body tab-content">
				<?php $no = 0; ?>
				@foreach($languages as $language)
				<?php 
					$no++;
					$val = App\Models\pages::where('lang_id', $language->id)->where('code', $code)->first();
				?>
					<div class="tab-pane {!! $no == 1 ? 'active' : '' !!}" id="{!! $language->id !!}">

						<div class="form-group">
							<label for="nama">Nama Halaman</label>
							<input type="text" name="nama[{!! $language->id !!}]" required="" value="{!! $val->name !!}" class="form-control">
						</div>	

						<div class="form-group">
							<label for="nama">Slug</label>
							<input type="text" name="slug[{!! $language->id !!}]" required="" value="{!! $val->slug !!}" class="form-control">
						</div>	

						<div class="form-group">
							<label>SEO Title</label>
							<textarea name="seo_title[{!! $language->id !!}]" class="form-control">{!! $val->seo_title !!}</textarea>
						</div>

						<div class="form-group">
							<label>SEO Keywords</label>
							<textarea name="seo_keywords[{!! $language->id !!}]" class="form-control">{!! $val->seo_keywords !!}</textarea>
						</div>

						<div class="form-group">
							<label>SEO Descriptions</label>
							<textarea name="seo_descriptions[{!! $language->id !!}]" class="form-control">{!! $val->seo_descriptions !!}</textarea>
						</div>					

					</div>

				@endforeach

				<div class="form-group">
					<label for="cathead">Kategori Menu</label>
					<br>
					<div class="col-sm-12">
						@foreach(catHeader() as $key => $value)
							<div class="radio radio-styled">
								<label>
									<input type="radio" required="" name="cathead" value="{!! $key !!}" {!! $val->page_categori == $key ? 'checked' : '' !!}>
									<span>{!! $value !!}</span>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="form-group">
					<label for="stsdms">Statis / Dinamis</label>
					<br>
					<div class="col-sm-12">
						@foreach(stsDms() as $key => $value)
							<div class="radio radio-styled">
								<label>
									<input type="radio" required="" name="stsdms" value="{!! $key !!}" {!! $key == $val->stsdms ? 'checked' : '' !!}>
									<span>{!! $value !!}</span>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="form-group">
					<label for="nama">Status</label>
					<br>
					<div class="col-sm-12">
						@foreach(arrStatus() as $key => $value)
							<div class="radio radio-styled">
								<label>
									<input type="radio" name="status" required="" value="{!! $key !!}" {!! $val->status == $key ? 'checked' : '' !!}>
									<span>{!! $value !!}</span>
								</label>
							</div>
						@endforeach
					</div>
				</div>

				<div class="form-group" id="function">
					<label for="function"><span style="color: red;"><u>Function In Controller</u></span></label>
					<input type="text" name="function" value="{!! $val->function !!}" class="form-control">
				</div>

			</div><!--end .card-body -->

		</div><!--end .card -->

		<a href="/pages" class="btn btn-success">CANCEL</a>
		<input type="submit" name="btn" class="btn btn-primary" value="SAVE">

    </div>
    {{ csrf_field() }}
  </form>
@endsection
@section('footer')
<script type="text/javascript">
	if ($('input:radio[name=stsdms]:checked').val() == 1) {
		//console.log(132);
		$('#function').show();
		$('#deskripsi').hide();
	} else {
		$('#function').hide();
		$('#deskripsi').show();
	}

	$('input[type=radio]').on('click', function() {
		var type = $('input:radio[name=stsdms]:checked').val();
		//console.log(type);
		if (type == 1) {
			$('#function').show();
			$('#deskripsi').hide();
		} else {
			$('#function').hide();
			$('#deskripsi').show();
		}
	});
	$('#description').on('click', function(){
		var slug = $(this).data('slug');
		window.location.href = '/pages/'+slug+'/description';
	});
</script>
@endsection