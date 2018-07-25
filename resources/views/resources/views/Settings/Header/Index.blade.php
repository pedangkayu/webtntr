@extends('layouts.app')

@section('meta')
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
	<link href="{{ asset('/vendor/switch-master/css/bootstrap3/bootstrap-switch.min.css') }}" rel="stylesheet">
@endsection

@section('content')

	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table" id="spa-all">
					<thead>
						<tr>
							<th>#</th>
							<th>UPLOADED DATE</th>
							<th>TITLE</th>
							<th>ACTIVE</th>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('footer')
	<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('/vendor/switch-master/js/bootstrap-switch.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/modules/setting/header/index.js') }}"></script>
@endsection
