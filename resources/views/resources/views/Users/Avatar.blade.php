@extends('layouts.app')

@section('meta')
	<link  href="{{ asset('/lib/cropper/dist/cropper.min.css') }}" rel="stylesheet">
	<style type="text/css">
		.img-container{
			background-color: #f7f7f7;
			overflow: hidden;
			width: 100%;
			text-align: center;
		}

		.img-container{
			min-height: 200px;
			max-height: 400px;
		}

		@media (min-width: 768px) {
		  .img-container {
		    min-height: 400px;
		  }
		}
		.img-container img{
			max-width: 100%;
		}
	</style>
@endsection


@section('content')

	<div class="row">
		<div class="col-sm-9">

			<div class="card">
				<div class="card-body no-padding">

					<form method="post" id="saveavatar" action="{{ url('/users/avatar') }}" enctype="multipart/form-data">
						{{ csrf_field() }}
			      		<div class="img-container"><img></div>
			      		<input type="file" name="avatar" id="inputImage" style="display:none;" accept="image/*" required="required">
								<input type="hidden" value="0" name="x" id="x">
								<input type="hidden" value="0" name="y" id="y">
								<input type="hidden" value="0" name="w" id="width">
								<input type="hidden" value="0" name="h" id="height">
			    </form>

				</div>
			</div>

			<div class="card">
				<div class="card-body">
					<label for="inputImage" class="btn btn-primary" type="button">Upload Image</label>

					<button class="btn btn-saveavatar btn-primary">Simpan</button>
				</div>
			</div>

		</div>


		<div class="col-sm-3">

			<div class="card">
				<div class="card-body no-padding">

					<ul class="list divider-full-bleed">

						@foreach($avatars as $avatar)

						<li class="tile">
							<a class="tile-content ink-reaction" href="javascript:void(0);">
								<div class="tile-icon">
									<img src="{{ asset('/img/avatars/thumb/' . $avatar) }}" alt="" />
								</div>
								<div class="tile-text">{{ ucwords(str_replace('.png', '', $avatar)) }}</div>
							</a>
							<div class="btn btn-flat ink-reaction text-right">

								<label class="radio-inline radio-styled">
									<input type="radio" name="listavatar" value="{{ $avatar }}" {!! $user->avatar == $avatar ? 'checked' : '' !!}>
								</label>

							</div>
						</li>

						@endforeach
					</ul>

				</div>
			</div>

		</div>
	</div>



@endsection

@section('footer')
	<script src="{{ asset('/lib/cropper/dist/cropper.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('/js/modules/users/profile.js') }}"></script>
@endsection
