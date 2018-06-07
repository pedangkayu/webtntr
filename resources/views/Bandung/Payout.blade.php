@extends('layouts.app')

@section('meta')

@endsection

@section('content')

<form class="form" action="{{ url('/share/payout') }}" method="post">
  {!! csrf_field() !!}
  <div class="row">
    <div class="col-sm-9">
      <div class="card">
        <div class="card-body">
            @forelse($items as $key => $item)
              @if(!$loop->first)
                <hr />
              @endif
              <span class="pull-right text-muted">INVOICE DATE {{ date('M d, Y') }}</span>
              <h3>TO Bandung Team</h3>
              <h4>PROFIT FROM {{ $key }}</h4>
                <table class="table">
                  <thead>
                    <tr>
                      <th>CODE</th>
                      <th class="text-right">BOOK DATE</th>
                      <th class="text-right">TOTAL</th>
                      <th class="text-right">SHARE</th>
                      <th class="text-right">SUBTOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                <?php $total = 0; ?>
                @forelse($item as $val)
                  <tr>
                    <td>
                      <input type="hidden" name="ids[{{ $ids[$key] }}][]" value="{{ $val->id }}">
                      #{{ $val->code }}
                    </td>
                    <td class="text-right">{{ date('M d, Y', strtotime($val->created_at)) }}</td>
                    <td class="text-right">{{ number_format($val->total,2,'.',',') }} {{ $val->iso_code }}</td>
                    <td class="text-right">{{ number_format($val->share_profit,0,'.',',') }}%</td>
                    <td class="text-right">{{ number_format($val->subtotal,2,'.',',') }} {{ $val->iso_code }}</td>
                  </tr>
                  <?php $total += $val->subtotal; ?>
                @empty
                  <tr>
                    <td colspan="5">Share profit not found</td>
                  </tr>
                @endforelse
                <tr>
                  <td colspan="4" class="text-right text-danger"><h4>GRAND TOTAL</h4></td>
                  <td class="text-right text-danger ">
                    <h4>{{ number_format($total,2,'.',',') }} {{ $key }}</h4>
                    <input type="hidden" name="grandtotal[]" value="{{ $total }}">
                    <input type="hidden" name="currenci_id[]" value="{{ $ids[$key] }}">
                  </td>
                </tr>
              </tbody>
            </table>

            @empty
              <div class="well">
                Share profit not found
              </div>
            @endforelse

        </div>
      </div>
    </div>

    <div class="col-sm-3">

      <div class="card">
    		<div class="card-body">

          <div class="form-group">
            <label for="note">NOTE</label>
            <textarea name="note" rows="5" class="form-control" cols="80" placeholder="say something..." autofocus>{{ old('note') }}</textarea>
          </div>

    		</div>

    		<div class="card-actionbar">
    				<div class="card-actionbar-row">
                <a href="{{ url('/share/detail') }}" class="btn btn-flat btn-accent ink-reaction pull-left">CANCEL</a>
    						<button type="button" onclick="send();" class="btn btn-danger">PAY OUT NOW</button>
    				</div>
    		</div>

    	</div>

    </div>
  </div>

</form>

@endsection

@section('footer')
  <script type="text/javascript">
    $(function(){
      send = function(){
        var c = confirm('Are tou sure ?');
        if(c){
          $('.form').submit();
        }
      }
    });
  </script>
@endsection
