<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>{{ $config->company }}</title>
    <link rel="stylesheet" href="{{ public_path('/css/pdf/invoice.css') }}" media="all" />
    <style>
    table td,
    table th {
      padding: 8px;
    }
    table td.total,
    table th.total {
      font-size: 9pt;
      font-weight: bold;
      text-align: right;
    }
    .description{
      line-height: normal;
      text-align: justify;
    }
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo" style="float:left;">
        <img src="{{ public_path('/img/nayabali-logo.jpg') }}">
      </div>
      <div id="company">
        <h2 class="name"><strong>{{ $config->company }}</strong></h2>
        <span>{{ $config->address }}</span>
        <div>{{ $config->phone }} / {{ $config->mobile }}, Fax {{ $config->fax }}</div>
        <div><a href="mailto:{{ $config->email }}">Email :{{ $config->email }}</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details">
        <div id="invoice" style="text-align:center;">
          <h1>SPA VOUCHER</h1>
          <h2 style="margin:0;">CODE #{{ $code }}</h2>
        </div>
      </div>
      <center><img src="{{ public_path('/img/paladincentre-logo.jpg') }}"></center>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
            <th width="30%" class="total" style="background:#333;">FIELDS</th>
            <th width="70%" class="desc" style="background:#333;color:#fff;font-weight:bold;border-left:solid 1px #fff;">DETAILS</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="total">Booking Date</td>
            <td class="desc">{{ date('M d, Y \/ h:i A', strtotime($created_at)) }}</td>
          </tr>
          <tr>
            <td class="total">Guest Name</td>
            <td class="desc">{{ $name_customer }}</td>
          </tr>
          <tr>
            <td class="total">Total Person</td>
            <td class="desc">{{ $qty_person }}</td>
          </tr>
          <tr>
            <td class="total">Spa Date & Time</td>
            <td class="desc">{{ date('M d, Y', strtotime($day_request)) }} {{ date('h:i A', strtotime($time_request)) }}</td>
          </tr>
          <tr>
            <td class="total">Spa Duration</td>
            <td class="desc">{{ $duration }}</td>
          </tr>
          <tr>
            <td class="total">Spa Name</td>
            <td class="desc">{{ $spa }}</td>
          </tr>
          <tr>
            <td class="total">Spa Address</td>
            <td class="desc">{{ $address_spa }}</td>
          </tr>
          <tr>
            <td class="total">Spa Phone / Fax</td>
            <td class="desc">{{ $spa_phone }} / {{ $spa_fax }}</td>
          </tr>
          <tr>
            <td class="total">Spa {{ $type == 1 ? 'Service' : 'Package' }}</td>
            <td class="desc">{{ $servicepack }}</td>
          </tr>
        </tbody>
      </table>
      <div class="description"></div>

      <br /><br /><br /><br />
      @if(!empty($note_voucher))
        <div id="notices">
          <div><strong>NOTE:</strong></div>
          <div class="notice">{{ $note_voucher }}</div>
        </div>
      @endif
    </main>
    <footer>
      <strong>{{ $spa }}</strong>
      <div>{{ $address_spa }}</div>
      <div class="date">VOUCHER DATE {{ date('M d, Y \/ h:i A') }}</div>
    </footer>
  </body>
</html>
