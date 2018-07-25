<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{ $config->company }}</title>
    <link rel="stylesheet" href="{{ public_path('/css/pdf/invoice.css') }}" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo" style="float:left;">
        <img src="{{ public_path('/img/nayabali-logo.jpg') }}">
      </div>
      <div id="company">
        <h2 class="name"><strong>{{ $config->company }}</strong></h2>
        <span>{!! $config->address !!}</span>
        <div>{{ $config->phone }} / {{ $config->mobile }}, Fax {{ $config->fax }}</div>
        <div><a href="mailto:{{ $config->email }}">Email :{{ $config->email }}</a></div>
      </div>
      </div>
    </header>
    <main style="clear:right;">
      <div id="details" class="clearfix">
        <div id="client" style="float:left;">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{ $title }} {{ $name_customer }}</h2>
          <div class="address">{{ $address }}, {{ $city }}, {{ $iso }}</div>
          <div class="email"><a href="mailto:{{ $email }}">Email :{{ $email }}</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE #{{ strtoupper($code) }}</h1>
          <div class="date">Date: {{ date('d/m/Y', strtotime($created_at)) }}</div>
        </div>
      </div>
      <center><img src="{{ public_path('/img/paladincentre-logo.jpg') }}"></center><br />
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th class="no">#</th>
            <th class="desc">PACKAGE</th>
            <th class="unit">PRICE</th>
            <th class="qty">TAX / PERSON</th>
            <th class="total">TOTAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">01</td>
            <td class="desc">{{ $servicepack }}</td>
            <td class="unit">{{ number_format($subtotal,2,'.',',') }} {{ $iso_code }}</td>
            <td class="qty">{{ $qty_person }}</td>
            <td class="total">{{ number_format(($subtotal * $qty_person),2,'.',',') }} {{ $iso_code }}</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">SUBTOTAL</td>
            <td>{{ number_format($total_qty_person,2,'.',',') }} {{ $iso_code }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">DISCOUNT {{ number_format($discount,0) }}%</td>
            <td>{{ number_format($total_discount,2,'.',',') }} {{ $iso_code }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TOTAL</td>
            <td>{{ number_format($total_total,2,'.',',') }} {{ $iso_code }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">OTHER</td>
            <td>{{ number_format($total_total_other,2,'.',',') }} {{ $iso_code }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">TAX & SERVICE {{ number_format($tax,0) }}%</td>
            <td>{{ number_format($total_tax,2,'.',',') }} {{ $iso_code }}</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td colspan="2">GRAND TOTAL</td>
            <td>{{ number_format($grandtotal,2,'.',',') }} {{ $iso_code }}</td>
          </tr>
        </tfoot>
      </table>
      <br /><br />
      @if(!empty($invoice_note))
        <div id="notices" style="border-color:green;">
          <div><strong>NOTE:</strong></div>
          <div class="notice">{{ $invoice_note }}</div>
        </div>
      @endif
      <br /><br />
      @if($tax > 0)
        <div id="notices">
          <div><strong>NOTICE:</strong></div>
          <div class="notice">* Included Government Tax & Service Charge from Publish Price </div>
        </div>
      @endif

    </main>
    <footer>
      <strong>{{ $spa }}</strong>
      <div>{{ $address_spa }}</div>
      <div class="date">INVOICE DATE {{ date('d/m/Y') }}</div>
    </footer>
  </body>
</html>
