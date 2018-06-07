<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BANDUNG TEAM</title>
    <link rel="stylesheet" href="{{ public_path('/css/pdf/invoice2.css') }}" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ $status[$item->status] }}">
      </div>
      <div id="company">
        <h2 class="name"><strong>BANDUNG TEAM</strong></h2>
        <div>+62 878-2311-2939</div>
        <div><a href="mailto:{{ $config->email }}">Email :dwipayana@gmail.com</a></div>
      </div>

    </header>
    <main style="clear:right;">
      <div id="details" class="clearfix">
        <div id="client" style="float:left;">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{ $config->company }} - {{ $config->owner }}</h2>
          <div class="address">{{ strip_tags($config->address) }}</div>
          <div class="email"><a href="mailto:{{ $config->email }}">Email :{{ $config->email }}</a></div>
        </div>
        <div id="invoice" style="height:50px;">
          <h3 style="margin:0;">INVOICE #{{ strtoupper($item->code) }}</h3>
          <div class="date">DATE: {{ date('d/m/Y', strtotime($item->created_at)) }}</div>
          <div class="date">PROFIT FROM {{ $crc->iso_code }}</div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">BOOK</th>
            <th class="desc">BOOK DATE</th>
            <th class="unit">TOTAL</th>
            <th class="qty">SHARE</th>
            <th class="total">SUBTOTAL</th>
          </tr>
        </thead>
        <tbody>
          @foreach($items as $val)
            <tr>
              <td class="no">#{{ $val->code }}</td>
              <td class="desc">{{ date('M d, Y', strtotime($val->created_at)) }}</td>
              <td class="unit">{{ number_format($val->total,2,'.',',') }} {{ $val->iso_code }}</td>
              <td class="qty">{{ number_format($val->share_profit,0,'.',',') }}%</td>
              <td class="total">{{ number_format($val->subtotal,2,'.',',') }} {{ $val->iso_code }}</td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td align="right">{{ number_format($item->grandtotal,2,'.',',') }} {{ $crc->iso_code }}</td>
          </tr>
        </tfoot>
      </table>
      <br /><br />
      @if(!empty($item->note))
        <div id="notices" style="border-color:green;">
          <div><strong>NOTE:</strong></div>
          <div class="notice">{{ $item->note }}</div>
        </div>
      @endif

    </main>
    <footer>
      <div class="date">INVOICE DATE {{ date('d/m/Y') }}</div>
    </footer>
  </body>
</html>
