@extends('Emails.template')

@section('title', 'Payment Success')

@section('content')
  <single>
    <address>
      <strong>Code Booking</strong>
      <p>#{{ $code }}</p>
      <strong>PayPal Payment Id</strong>
      <p>#{{ $paypal_payment_id }}</p>
    </address>
    <p>
      Please click the button below here, to order checks
    </p>
    <br />
    <center>
      <table cellspacing="0" cellpadding="0" border="0" width="140" style="background-color:#1fcab8;">
        <tr>
          <td align="center" height="45" style="text-transform:uppercase;font-size:16px;font-family:'Lato',Arial,sans-serif;color:#ffffff;font-weight:700;padding:0 10px;"><a style="text-decoration:none;color:#ffffff;display: block; line-height:45px;" target="_blank" href="{{ url('/booking/' . $id_booking) }}"><single>Check Now</single></a></td>
        </tr>
      </table>
    </center>
  </single>
@endsection
