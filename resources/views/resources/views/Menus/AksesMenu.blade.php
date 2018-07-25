@extends('layouts.app')

@section('meta')
	<link rel="stylesheet" type="text/css" href="{{ asset('/js/libs/check-tree/css/jquery-checktree.css') }}">
@endsection

@section('content')
	
	<div class="row">
		<div class="col-sm-4">

			<div class="card">
				<div class="card-head">
					<header>Levels</header>
				</div>
				<div class="card-body  no-padding">
					
					<ul class="list divider-full-bleed">
						@foreach($levels as $level)
						<li class="tile">
							<a class="tile-content ink-reaction" href="javascript:loadMenu({{ $level->id }});">
								<div class="tile-icon">
									<i class="fa fa-lock"></i>
								</div>
								<div class="tile-text">
									{{ $level->nm_level }}
								</div>
							</a>
						</li>
						@endforeach
					</ul>

				</div>
			</div>

		</div>
		<div class="col-sm-8">
			<form method="post" action="">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="card">
					<div class="card-head">
						<header class="header-page">Halaman</header>
					</div>
					<div class="card-body menu-content">
						<p>Klik nama level di samping</p>
					</div>

					<div class="card-actionbar btn-simpan hide">
						<div class="card-actionbar-row">
							<button type="submit" class="btn btn-flat btn-accent ink-reaction">Simpan Hak Akses</button>
							<input type="hidden" name="level_id" value="0">
						</div>
					</div><!--end .card-actionbar -->

				</div>
			</form>

		</div>
	</div>

@endsection

@section('footer')
	<script type="text/javascript" src="{{ asset('/js/libs/check-tree/jquery-checktree.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/modules/menus/aksesmenu.js') }}"></script>
@endsection