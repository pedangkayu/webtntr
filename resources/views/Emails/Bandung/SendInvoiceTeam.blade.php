@extends('Emails.template')

@section('title', 'Hi, Guys')

@section('content')
  <single>
    <p>
      {{ $by }} baru saja melakukan pembayaran profit dari paladin, segera konfirmasi invoicenya di bawah ini
    </p>
  </single>
  <br />
  <center>
      @foreach($items as $item)
      <table cellspacing="0" cellpadding="0" border="0" width="140" style="background-color:#1fcab8;margin:10px 0;">
        <tr>
          <td align="center" height="45" style="text-transform:uppercase;font-size:16px;font-family:'Lato',Arial,sans-serif;color:#ffffff;font-weight:700;padding:0 10px;"><a style="text-decoration:none;color:#ffffff;display: block; line-height:45px;" target="_blank" href="{{ url('/bandung/invoice/' . $item['id']) }}"><single>#{{ $item['code'] }}</single></a></td>
        </tr>
      </table>
      @endforeach
  </center>
  @if(!empty($note))
  <br />
  <single>
    <strong>NOTE :</strong>
    <p>
      {{ $note }}
    </p>
  </single>
  @endif

@endsection
