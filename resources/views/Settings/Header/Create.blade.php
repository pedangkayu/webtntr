@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-sm-8">
			<form class="form" action="{{ url('/header') }}" method="post" enctype="multipart/form-data">
				{!! csrf_field() !!}
				<div class="card">
					<div class="card-body">

						<div class="form-group">
							<label for="title">Title Header</label>
							<input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description" class="form-control" rows="3" cols="10">{{ old('description') }}</textarea>
						</div>

						<div class="form-group">
							<label for="status">Status</label>
							<select class="form-control" name="status">
								<option value="1">Active</option>
								<option value="0">Non Active</option>
							</select>
						</div>

						<div class="form-group">
							<label for="link">Link URL</label>
							<input type="text" name="link" id="link" class="form-control" value="{{ old('link') }}" placeholder="eg: http://domain.com/target-link">
						</div>

						<div class="form-group">
							<label for="status">Target Link URL</label>
							<select class="form-control" name="target">
								<option value="_blank">Blank</option>
								<option value="_parent">Parent</option>
								<option value="_self">Self</option>
								<option value="_top">Top</option>
							</select>
						</div>

						<div class="form-group">
							<label for="images">Impages</label>
							<input type="file" name="img" accept='image/*' required class="form-control">
							<p class="help-block">Size image must 2200px X 900px</p>
						</div>

					</div>
					<div class="card-actionbar">
							<div class="card-actionbar-row">
									<button type="submit" class="btn btn-flat btn-accent ink-reaction">Save New</button>
							</div>
					</div>
				</div>
			</form>
		</div>
	</div>

@endsection
