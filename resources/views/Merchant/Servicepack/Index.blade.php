@extends('layouts.app')

@section('meta')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
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

  <div class="row">

    <div class="col-sm-6">
      <div class="card">
    		<!-- <div class="card-head">
    			<header>Services</header>
    		</div> -->
    		<div class="card-body">
					<div class="table-responsive">
	          <table class="table" id="services">
	    				<thead>
	    					<tr>
	    						<th>#</th>
	    						<th>SERVICE</th>
	    						<th style="text-align:right;">PRICE PUBLIC</th>
									<th style="text-align:center;">TRUSH</th>
	    					</tr>
	    				</thead>
	    			</table>
					</div>
    		</div>
    	</div>
    </div>

    <div class="col-sm-6">
      <div class="card">
    		<!-- <div class="card-head">
    			<header>Packages</header>
    		</div> -->
    		<div class="card-body">
					<div class="table-responsive">
	          <table class="table" id="packages">
	    				<thead>
	    					<tr>
									<th>#</th>
									<th>PACKAGES</th>
									<th style="text-align:right;">PRICE PUBLIC</th>
									<th style="text-align:center;">TRUSH</th>
	    					</tr>
	    				</thead>
	    			</table>
					</div>

    		</div>
    	</div>
    </div>

  </div>
  <a href="{{ url('/spa/' . $spa->id_spa) }}" title="Back" class="animated bounceInRight btn ink-reaction btn-floating-action btn-primary btn-back"><i class="fa fa-chevron-left"></i></a>
	<a href="{{ url('/spa/servicepack/create?reference=' . base64_encode($spa->id_spa) . '&_t=' . csrf_token()) }}" title="Add new" class="animated bounceInDown btn ink-reaction btn-floating-action btn-primary btn-add"><i class="fa fa-plus"></i></a>
	<input type="hidden" name="id" id="id" value="{{ $spa->id_spa }}">
@endsection

@section('footer')
  <script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="{{ asset('/js/modules/spa/servicepact.js') }}"></script>
@endsection
