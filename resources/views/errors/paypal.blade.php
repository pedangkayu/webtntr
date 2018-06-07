@extends('layouts.Frontend.content')

@section('title_page', 'PayPal Error')

@section('content')

<!-- /.404 Start ./-->

<section class="p404">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2>{!! Session::get('err')['message'] !!}</h2>
        <span class="buttons">Please Go To <strong><a href="{{ url('/') }}">Homepage</a></strong></span> </div>
    </div>
  </div>
</section>
<!-- /.404 End ./-->

@endsection
