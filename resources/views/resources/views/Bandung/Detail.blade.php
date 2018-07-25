@extends('layouts.app')

@section('meta')

@endsection

@section('content')

  <div class="row">
    <div class="col-sm-9">
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
                <th class="text-right">STATUS</th>
              </tr>
            </thead>
            <tbody>
              <?php $grandtotal = 0; ?>
              @forelse($items as $key => $item)
                <tr>
                  <td colspan="4"><strong>PROFIT FROM {{ $key }}</strong></td>
                </tr>
                <?php $total = 0; ?>
                @foreach($item as $val)
                  <tr>
                    <td>
                      <a target="_blank" href="{{ url('/booking/' . $val->id_booking) }}">#{{ $val->code }}</a>&nbsp;&nbsp;
                      <a target="_blank" href="{{ url('/print/invoice/' . $val->id_booking) }}"><i class="fa fa-print"></i></a>
                    </td>
                    <td class="text-right">{{ date('M d, Y', strtotime($val->created_at)) }}</td>
                    <td class="text-right">{{ number_format($val->total,2,'.',',') }} {{ $val->iso_code }}</td>
                    <td class="text-right">{{ number_format($val->share_profit,0,'.',',') }}%</td>
                    <td class="text-right">{{ number_format($val->subtotal,2,'.',',') }} {{ $val->iso_code }}</td>
                    <td class="text-right">{{ $status[$val->status] }}</td>
                  </tr>
                  <?php $total += $val->subtotal; ?>
                @endforeach
                <tr>
                  <td colspan="4" class="text-right text-danger"><h4>GRAND TOTAL</h4></td>
                  <td class="text-right text-danger "><h4>{{ number_format($total,2,'.',',') }} {{ $key }}</h4></td>
                  <td></td>
                </tr>
              @empty
                <tr>
                  <td colspan="6">Share profit not found</td>
                </tr>
              @endforelse
            </tbody>
          </table>

        </div>
      </div>
    </div>

    <div class="col-sm-3">
      <div class="card">
        <div class="card-body">
          <h4 class="text-muted">SUMMARY</h4>
          <table class="table">
              <thead>
                <tr>
                  <th>CURRENCY</th>
                  <th class="text-right">TOTAL</th>
                </tr>
              </thead>
              <tbody class="list-share-profit">
                <tr>
                  <td colspan="2">Loading...</td>
                </tr>
              </tbody>
          </table>
        </div>

        <div class="card-actionbar">
            <div class="card-actionbar-row">
                <a href="{{ url('/share/payout') }}" class="btn btn-danger btn-block">CHECKOUT</a>
            </div>
        </div>

      </div>
    </div>
  </div>



@endsection

@section('footer')
  <script type="text/javascript" src="{{ asset('/vendor/chartjs/Chart.bundle.js') }}"></script>
  <script type="text/javascript" src="{{ asset('/js/modules/dasboard/dasboard.js') }}"></script>
@endsection
