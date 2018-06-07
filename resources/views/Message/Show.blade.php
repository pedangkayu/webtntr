@extends('layouts.app')
@section('meta')
@endsection
@section('content')

  <div class="row">
    <div class="col-sm-8">

      <div class="card">
    		<div class="card-head">
    			<header>{{ $msg->subject }}</header>
    		</div>
    		<div class="card-body">

          <div class="row">
            <div class="col-sm-6">
              <address>
                  <h3>FROM</h3>
                  <strong>Name</strong>
                  <p>{{ $msg->name }}</p>
                  <strong>Email</strong>
                  <p>{{ $msg->email }}</p>
                  <strong>Website</strong>
                  <p>{{ !empty($msg->website) ? $msg->website : '-' }}</p>
              </address>
            </div>
            @if($msg->spa_id > 0)
            <div class="col-sm-6">
              <address>
                  <h3>TO</h3>
                  <strong>Name</strong>
                  <p>{{ $spa->spa }}</p>
                  <strong>Email</strong>
                  <p>{{ $spa->email }}</p>
                  <strong>Status</strong>
                  <p>{{ $spa->premium ? 'Premium' : 'Free' }}</p>
              </address>
            </div>
            @endif
          </div>

          <strong>Message</strong>
          <p>{{ $msg->message }}</p>
    		</div>
    		<div class="card-actionbar">
    				<div class="card-actionbar-row">
              <a href="{{ url('/message') }}" class="btn pull-left btn-flat btn-accent ink-reaction">Back</a>
    				</div>
    		</div>
    	</div>
    </div>

    <div class="col-sm-8">
    </div>
  </div>

@endsection
@section('footer')
@endsection
