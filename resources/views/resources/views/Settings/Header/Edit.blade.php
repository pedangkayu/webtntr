@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-sm-8">
			<img src="{{ asset('/img/headers/' . $header->file_name) }}" class="img img-thumbnail">
		</div>
		<div class="col-sm-4">
			<form class="form" action="{{ url('/header/' . $header->id) }}" method="post" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PUT">
				<input type="hidden" name="id" value="{{ $header->id }}">
				{!! csrf_field() !!}
				<div class="card">
					<div class="card-body">

						<div class="form-group">
							<label for="title">Title Header</label>
							<input type="text" name="title" id="title" class="form-control" value="{{ old('title') ? old('title') : $header->title }}">
						</div>

						<div class="form-group">
							<label for="description">Description</label>
							<textarea name="description" class="form-control" rows="5" cols="10">{{ old('description') ? old('description') : $header->description }}</textarea>
						</div>

						<div class="form-group">
							<label for="status">Status</label>
							<select class="form-control" name="status">
								<option value="1" {!! $header->status == 1 ? 'selected' : '' !!}>Active</option>
								<option value="0" {!! $header->status == 0 ? 'selected' : '' !!}>Non Active</option>
							</select>
						</div>

						<div class="form-group">
							<label for="link">Link URL</label>
							<input type="text" name="link" id="link" class="form-control" value="{{ old('link') ? old('link') : $header->link }}" placeholder="eg: http://domain.com/target-link">
						</div>

						<div class="form-group">
							<label for="status">Target Link URL</label>
							<select class="form-control" name="target">
								<option value="_blank" {!! $header->target == 1 ? '_blank' : '' !!}>Blank</option>
								<option value="_parent" {!! $header->target == 1 ? '_parent' : '' !!}>Parent</option>
								<option value="_self" {!! $header->target == 1 ? '_self' : '' !!}>Self</option>
								<option value="_top" {!! $header->target == 1 ? '_top' : '' !!}>Top</option>
							</select>
						</div>

						<div class="form-group">
							<label for="images">Impages</label>
							<input type="file" name="img" accept='image/*' class="form-control">
							<p class="help-block">Size image must 2200px X 900px</p>
						</div>

					</div>
					<div class="card-actionbar">
							<div class="card-actionbar-row">
									<a href="{{ url('/header') }}" class="btn pull-left btn-flat btn-accent ink-reaction">Cancel</a>
									<button type="submit" class="btn btn-flat btn-accent ink-reaction">Save Update</button>
							</div>
					</div>
				</div>
			</form>
		</div>

	</div>

@endsection
