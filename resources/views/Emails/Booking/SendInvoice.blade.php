@extends('Emails.template')

@section('title', 'Helo ' . $title . ' ' . $name_customer)

@section('content')
  <single>
    <p>
      Thank you for your spa reservation., we really appreciate it.
      Please find our invoice in the email attachment
      For the payment will be made in accordance with the invoice that we send
      Please input your payment details on the link below
    </p><br />
    <center>
      <table cellspacing="0" cellpadding="0" border="0" width="140" style="background-color:#1fcab8;">
        <tr>
          <td align="center" height="45" style="text-transform:uppercase;font-size:16px;font-family:'Lato',Arial,sans-serif;color:#ffffff;font-weight:700;padding:0 10px;"><a style="text-decoration:none;color:#ffffff;display: block; line-height:45px;" target="_blank" href="{{ url($spa_slug . '/payment/' . $code . '/' . csrf_token()) }}"><single>Pay Now</single></a></td>
        </tr>
      </table>
    </center>
    <br />
    <p>
      Once this data is received, we will immediately send a voucher for the
      reservation
      Should you need other assistance, please feel free to contact us
      Thank you for your kind attention and we are looking forward to have your
      confirmation

      Kindly regards
    </p>
  </single>
@endsection
