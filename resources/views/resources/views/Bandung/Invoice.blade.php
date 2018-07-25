@extends('layouts.app')

@section('meta')
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
@endsection

@section('content')

  <div class="row">
    <div class="col-sm-8">

      <div class="card">
    		<div class="card-body">
    			<div class="table-responsive">
    				<table class="table" id="booking-all">
    					<thead>
    						<tr>
    							<th>CODE</th>
    							<th>DATE</th>
    							<th>GRANDTOTAL</th>
    							<th>CURRENCY</th>
    						</tr>
    					</thead>
    				</table>
    			</div>
    		</div>
    	</div>

    </div>
    <div class="col-sm-4">
      <div class="card">
        <div class="card-body">
          <h4>NEW INVOICE {{ count($items) }}</h4>
        </div>
        <div class="card-body no-padding">
          <ul class="list divider-full-bleed">
            @foreach($items as $item)
              <li class="tile">
                <a class="tile-content ink-reaction" href="{{ url('/bandung/invoice/' . $item->id) }}">
                  <div class="tile-icon">
                    <i class="fa fa-file-text-o"></i>
                  </div>
                  <div class="tile-text">
                    #{{ $item->code }}
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div><!--end .card-body -->
      </div><!--end .card -->
    </div>

  </div>



	<input type="hidden" name="status" value="{{ $status }}">
@endsection

@section('footer')
	<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="{{ asset('/js/modules/bandung/invoice.js') }}"></script>
@endsection
