@extends('layouts.app')

@section('meta')
  <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/summernote/summernote.css?1425218701') }}" />
  <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/bootstrap-datepicker/datepicker3.css?1424887858') }}" />
  <style media="screen">
      .datepicker-inline{
        margin: 0 auto;
        border: none;
      }
  </style>
@endsection

@section('content')

  <form class="form" action="{{ url('/spa/schedule/' . $jadwal->id) }}" method="post">
    <input type="hidden" name="_method" value="PUT">

    <div class="row">
      <div class="col-sm-8">

        <div class="card">
      		<div class="card-body no-padding">
            <textarea name="description" class="form-control summernote" rows="3">{!! old('description') ? old('description') : $jadwal->description !!}</textarea>
      		</div>
      	</div>

      </div>

      <div class="col-sm-4">
        <div class="card">
      		<div class="card-body">

            <div class="form-group">
              <label for="nm_schedule">Name Schedule *</label>
              <input type="text" name="nm_schedule" id="nm_schedule" value="{{ old('nm_schedule') ? old('nm_schedule') : $jadwal->nm_schedule }}" autofocus required class="form-control">
            </div>

            <div class="form-group">
              <label for="location">Location *</label>
              <input type="text" name="location" id="location" value="{{ old('location') ? old('location') : $jadwal->location }}" required class="form-control">
            </div>

            <div class="form-group">
              <label for="hashtag">Hashtag</label>
              <input type="text" name="hashtag" id="hashtag" value="{{ old('hashtag') ? old('hashtag') : $jadwal->hashtag }}" class="form-control">
            </div>

            <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" name="status" id="status">
                <option value="1" {!! $jadwal->status == 1 ? 'selected' : '' !!}>Active</option>
                <option value="0" {!! $jadwal->status == 0 ? 'selected' : '' !!}>No active</option>
              </select>
            </div>

            <h4>START</h4>
      	     <div id="demo-date-inline-start" data-date="{{ date('Y-m-d', strtotime($jadwal->time_start)) }}"></div>

            <div class="form-group col-sm-12">
              <input type="time" name="waktu_start" value="{{ date('H:s', strtotime($jadwal->time_start)) }}" class="form-control text-center">
              <input type="hidden" name="date_start" value="{{ date('Y-m-d', strtotime($jadwal->time_start)) }}">
            </div>

            <h4>END DATE</h4>
            <div id="demo-date-inline-end" data-date="{{ date('Y-m-d', strtotime($jadwal->time_end)) }}"></div>
           <div class="form-group col-sm-12">
             <input type="time" name="waktu_end" value="{{ date('H:s', strtotime($jadwal->time_end)) }}" class="form-control text-center">
             <input type="hidden" name="date_end" value="{{ date('Y-m-d', strtotime($jadwal->time_end)) }}">
           </div>

      		</div>

          <div class="card-actionbar">
              <div class="card-actionbar-row">
                  <a href="{{ url('/spa/schedule?referal=' . base64_encode($jadwal->id_spa) . '&_k=' . csrf_token()) }}" class="btn btn-flat pull-left btn-accent ink-reaction">Cancel</a>
                  <button type="submit" class="btn btn-flat btn-accent ink-reaction">Update</button>
              </div>
          </div>

      	</div>
      </div>

    </div>
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{ $jadwal->id }}">
</form>

@endsection

@section('footer')
  <script src="{{ asset('/js/libs/summernote/summernote.min.js') }}"></script>
  <script src="{{ asset('/js/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/modules/spa/schedule/create.js') }}"></script>
@endsection
