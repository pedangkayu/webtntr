@extends('layouts.app')

@section('meta')
	<link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/multi-select/multi-select.css?1424887857') }}" />
@endsection

@section('content')

<form class="form floating-label" role="form" method="POST" action="{{ url('/menu') }}">
	<div class="row">
		<div class="col-md-6">
			
			<div class="card">
				<div class="card-body">
					
					
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" autofocus required>
                            <label for="title">Title *</label>

                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                            <label for="slug">Slug *</label>
                            <input id="title" type="text" class="form-control" name="slug" value="{{ old('slug') }}" placeholder="home/user" required>

                            @if ($errors->has('slug'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('slug') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('class') ? ' has-error' : '' }}">
                            <input id="class" type="text" class="form-control" name="class" value="{{ old('class') }}">
                            <label for="class">.class</label>

                            @if ($errors->has('class'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group{{ $errors->has('class_id') ? ' has-error' : '' }}">
                            <input id="class_id" type="text" class="form-control" name="class_id" value="{{ old('class_id') }}">
                            <label for="class_id">#id</label>

                            @if ($errors->has('class_id'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('class_id') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group{{ $errors->has('icon') ? ' has-error' : '' }}">
                            <input id="icon" type="text" class="form-control" name="icon" value="{{ old('icon') }}">
                            <label for="icon">Icon</label>

                            @if ($errors->has('icon'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('icon') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
                            <textarea class="form-control" rows="2" id="keterangan" name="ket">{{ old('keterangan') }}</textarea>
                            <label for="keterangan">Tooltip</label>

                            @if ($errors->has('keterangan'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('keterangan') }}</strong>
                                </span>
                            @endif
                        </div>

                    

				</div>

			</div>

		</div>

		<div class="col-md-6">
			
			<div class="card">
				<div class="card-head">
					<header>Akses Level</header>
				</div>
				<div class="card-body">
					<select id="optgroup" multiple="multiple" name="permission[]">
						@foreach($levels as $level)
							<option value="{{ $level->id }}">{{ $level->nm_level }}</option>
						@endforeach
					</select>

				</div>
			</div>

			<div class="card">
				<div class="card-actionbar">
					<div class="card-actionbar-row">
						<a href="{{ url('/menu') }}" class="btn btn-flat btn-default ink-reaction">Batal</a>
						<button type="submit" class="btn btn-flat btn-accent ink-reaction">Simpan Menu</button>
					</div>
				</div><!--end .card-actionbar -->
			</div>


		</div>

	</div>
</form>

@endsection

@section('footer')
	<script src="{{ asset('/js/libs/multi-select/jquery.multi-select.js') }}"></script>
	<script type="text/javascript">
		$(function(){
			$('#optgroup').multiSelect({selectableOptgroup: true});
		});
	</script>
@endsection