@extends('layouts.Frontend.content')
@section('title_page', $page->name)
@section('content')
<section class="signup">
 <div class="container">
   @if (count($errors) > 0)
     <div class="alert alert-warning">
         <ul>
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
  @endif
  <div class="row">
    <div class="col-md-12">
      <div class="col-lg-12 col-md-12">
        <h2 class="main-title">TITLE</h2>
      </div>
    </div>
    </div>
  </div>
</section>
<!-- /.contact End ./-->
@endsection
