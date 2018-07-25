@extends('layouts.app')

@section('meta')

@endsection

@section('content')

	<div class="row">
		<div class="col-sm-9">
			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<select name="tahun" class="pull-right" onchange="getChart(this.value);">
							@for($i = 2000; $i <= date('Y'); $i++)
								<option value="{{ $i }}" {!! date('Y') == $i ? 'selected' : '' !!}>{{ $i }}</option>
							@endfor
						</select>
						<h4 class="text-muted">Statistic Paid Booking &middot; {{ $spa->spa }}</h4>

					</div>
					<canvas id="booked" width="100%" height="40"></canvas>
				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<div class="form-group">
						<select name="tahun_income" class="pull-right" onchange="getIncome(this.value);">
							@for($i = 2000; $i <= date('Y'); $i++)
								<option value="{{ $i }}" {!! date('Y') == $i ? 'selected' : '' !!}>{{ $i }}</option>
							@endfor
						</select>
						<h4 class="text-muted">Statistic Income  &middot; {{ $spa->spa }}</h4>
					</div>
					<canvas id="income" width="100%" height="30"></canvas>
				</div>

				<div class="card-body">
					<table class="table table-income">
						<tr>
							<td>Loading...</td>
						</tr>
					</table>
				</div>
			</div>

		</div>
		<div class="col-sm-3">

			<div class="card">
				<div class="card-body no-padding">
				<img src="{{ asset('/img/spa/' . $spa->img_thumbnail) }}" class="img img-responsive">
				</div>
				<div class="card-body no-padding">
					<ul class="list divider-full-bleed">
						<li class="tile">
							<a class="tile-content ink-reaction" href="{{ url('/spa/' . $spa->id_spa . '/edit') }}">
								<div class="tile-icon">
									<i class="fa fa-pencil"></i>
								</div>
								<div class="tile-text">
									Update
								</div>
							</a>
						</li>
						<li class="tile">
							<a class="tile-content ink-reaction" href="{{ url($spa->slug) }}" target="_blank">
								<div class="tile-icon">
									<i class="fa fa-laptop"></i>
								</div>
								<div class="tile-text">
									Go Page
								</div>
							</a>
						</li>
						<li class="tile">
							<a class="tile-content ink-reaction" href="{{ url('/spa/servicepack?referal=' . base64_encode($spa->id_spa) . '&_k=' . csrf_token()) }}">
								<div class="tile-icon">
									<i class="fa fa-wheelchair"></i>
								</div>
								<div class="tile-text">
									Service & Package
								</div>
							</a>
						</li>
						<li class="tile">
							<a class="tile-content ink-reaction" href="{{ url('/spa/gallery?referal=' . base64_encode($spa->id_spa) . '&_k=' . csrf_token()) }}">
								<div class="tile-icon">
									<i class="fa fa-image"></i>
								</div>
								<div class="tile-text">
									Banner & Gallery
								</div>
							</a>
						</li>
						<li class="tile">
							<a class="tile-content ink-reaction" href="{{ url('/spa/schedule?referal=' . base64_encode($spa->id_spa) . '&_k=' . csrf_token()) }}">
								<div class="tile-icon">
									<i class="fa fa-calendar"></i>
								</div>
								<div class="tile-text">
									Schedule
								</div>
							</a>
						</li>

						<li class="tile">
							<a class="tile-content ink-reaction" href="{{ url('/spa/template/' . $spa->id_spa) }}">
								<div class="tile-icon">
									<i class="fa fa-desktop"></i>
								</div>
								<div class="tile-text">
									Templates
								</div>
							</a>
						</li>

					</ul>
				</div>

			</div>

		</div>
	</div>

	<input type="hidden" name="spa_id" value="{{ $spa->id_spa }}">
@endsection

@section('footer')
	<script type="text/javascript" src="{{ asset('/vendor/chartjs/Chart.bundle.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/modules/spa/view.js') }}"></script>
@endsection
