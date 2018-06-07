@extends('layouts.app')

@section('meta')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
	<style media="screen">
		.btn-add{
			position: fixed;
			bottom: 10%;
			right: 5%;
		}
    .btn-back{
      position: fixed;
			bottom: 10%;
			right: 9%;
    }
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-8">
			<div class="card" style="margin-bottom:100px;">
				<div class="card-body">
					<div class="table-responsive">
						<table class="table" id="spa-gallery">
							<thead>
								<tr>
									<th>#</th>
									<th>TITLE</th>
									<th>DATE</th>
									<th class="text-center">TRUSH</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="col-sm-4">

			<form class="form" action="{{ url('/headers') }}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="id_spa" value="{{ $spa->id_spa }}">
				{!! csrf_field() !!}
				<div class="card">
					<div class="card-head">
						<header>Banner Spa</header>
					</div>
					<div class="card-body">
						<div class="form-group">
							@if(!empty($spa->header1))
							<img src="{{ asset('/img/spa/headers/' . $spa->header1) }}" class="img img-thumbnail">
							@endif
							<input type="file" name="header1">
						</div>

						<div class="form-group">
							@if(!empty($spa->header2))
							<img src="{{ asset('/img/spa/headers/' . $spa->header2) }}" class="img img-thumbnail">
							@endif
							<input type="file" name="header2">
						</div>
					</div>
					<div class="card-actionbar">
							<div class="card-actionbar-row">
									<button type="submit" class="btn btn-flat btn-accent ink-reaction">Upload</button>
							</div>
					</div>

				</div>
			</form>

		</div>

	</div>


  <a href="{{ url('/spa/' . $spa->id_spa) }}" title="Back" class="animated bounceInRight btn ink-reaction btn-floating-action btn-primary btn-back"><i class="fa fa-chevron-left"></i></a>
	<a href="{{ url('/spa/gallery/create?referal=' . base64_encode($spa->id_spa) . '&_t=' . csrf_token()) }}" title="Add new" class="animated bounceInDown btn ink-reaction btn-floating-action btn-primary btn-add"><i class="fa fa-plus"></i></a>
	<input type="hidden" name="id" id="id" value="{{ $spa->id_spa }}">

@endsection

@section('footer')
  <script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="{{ asset('/vendor/fancyBox/source/jquery.fancybox.css') }}">
  <script type="text/javascript" src="{{ asset('/vendor/fancyBox/lib/jquery.mousewheel-3.0.6.pack.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/vendor/fancyBox/source/jquery.fancybox.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/vendor/fancyBox/source/jquery.fancybox.pack.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/modules/spa/gallery/index.js') }}"></script>
@endsection
