@extends('layouts.app')

@section('meta')
  <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/dropzone/dropzone-theme.css?1424887864') }}" />
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

<div class="card">
  <div class="card-body no-padding">
    <form action="{{ url('/spa/gallery') }}" class="dropzone" id="my-awesome-dropzone" enctype="multipart/form-data" style="height:500px;">
      <div class="dz-message">
        <h3>Drop files here or click to upload.</h3>
        <em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em>
      </div>
      {!! csrf_field() !!}
      <input type="hidden" name="id_spa" value="{{ $spa->id_spa }}">
    </form>
  </div><!--end .card-body -->
</div><!--end .card -->

<a href="{{ url('/spa/gallery?referal=' . base64_encode($spa->id_spa) . '&_t=' . csrf_token()) }}" title="Add new" class="animated bounceInDown btn ink-reaction btn-floating-action btn-primary btn-add"><i class="fa fa-chevron-left"></i></a>
@endsection

@section('footer')
  <script src="{{ asset('/js/libs/dropzone/dropzone.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/modules/spa/gallery/create.js') }}"></script>
@endsection
