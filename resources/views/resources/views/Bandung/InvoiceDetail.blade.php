@extends('layouts.app')

@section('meta')

@endsection

@section('content')

  <div class="row">
    <div class="col-sm-4">

      <div class="card">
        <div class="card-body">
          <h4 style="margin:0;">#{{ $item->code }}</h4>
          <strong>PROFIT FROM {{ $crc->iso_code }}</strong>
          <br /><br />
          <address>
            <strong>STATUS</strong>
            <p>{{ $status[$item->status] }}</p>
            <strong>INVOICE DATE</strong>
            <p>{{ date('M d, Y', strtotime($item->created_at)) }} / {{ date('h:i A', strtotime($item->created_at)) }}</p>
            <strong>GRAND TOTAL</strong>
            <p>{{ number_format($item->grandtotal,2,'.',',') }} {{ $crc->iso_code }}</p>
            <strong>CREATED BY</strong>
            <p>{{ $user->name }}</p>
            <strong>NOTE</strong>
            <p>{{ $item->note }}</p>
          </address>

        </div>

        <div class="card-actionbar">
            <div class="card-actionbar-row">
                <a target="_blank" href="{{ url('/print/bandung/invoice/' . $item->id) }}" class="btn btn-flat btn-accent ink-reaction">PRINT</a>
                @if($item->status == 1)
                <button type="submit" class="btn btn-danger btn-verif" onclick="verif({{ $item->id }});">Verification</button>
                @endif
            </div>
        </div>

      </div>

    </div>
    <div class="col-sm-8">

      <div class="card">
    		<div class="card-body">

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
              @foreach($items as $val)
                <tr>
                  <td>
                    <a target="_blank" href="{{ url('/booking/' . $val->id_booking) }}">#{{ $val->code }}</a>&nbsp;&nbsp;
                    <a target="_blank" href="{{ url('/print/invoice/' . $val->id_booking) }}"><i class="fa fa-print"></i></a>
                  </td>
                  <td class="text-right">{{ date('M d, Y', strtotime($val->created_at)) }}</td>
                  <td class="text-right">{{ number_format($val->total,2,'.',',') }} {{ $val->iso_code }}</td>
                  <td class="text-right">{{ number_format($val->share_profit,0,'.',',') }}%</td>
                  <td class="text-right">{{ number_format($val->subtotal,2,'.',',') }} {{ $val->iso_code }}</td>
                </tr>
                <?php $total += $val->subtotal; ?>
              @endforeach

                <tr>
                  <td colspan="4" class="text-right text-danger"><h4>GRAND TOTAL</h4></td>
                  <td class="text-right text-danger "><h4>{{ number_format($total,2,'.',',') }}</h4></td>
                  <td></td>
                </tr>

            </tbody>
          </table>

    		</div>

    	</div>

    </div>
  </div>

@endsection

@section('footer')
  <script type="text/javascript">
    $(function(){verif=function(a){var b=confirm("Are you sure ?");b&&(toastr.warning("Verifying..."),$.post(base_url("/bandung/invoice/verification"),{id:a},function(a){toastr.success(a.err),a.result&&$(".btn-verif").remove()},"json"))}});
  </script>
@endsection
