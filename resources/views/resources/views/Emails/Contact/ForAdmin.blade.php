@extends('Emails.template')
@section('title', $subject)
@section('content')

<single>
  <p><strong>You get a new message.</strong></p>
  <br />

  <table width="100%">
    <tr>
      <td width="50%" valign="top" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
        <address>
          <strong>From</strong>
          <p>Name : {{ $from_name }}</p>
          <p>Email : <a href="mailto:{{ $from_email }}" style="color:#888;">{{ $from_email }}</a></p>
          <p>{{ date('M d, Y') }}</p>
        </address>
      </td>
      @if(!empty($id_spa))
      <td width="50%" valign="top" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
        <address>
          <strong>To</strong>
          <p><a href="{{ url($slug) }}" target="_blank" style="color:#888;">{{ $spa }}</a></p>
          <p><a href="mailto:{{ $email }}" style="color:#888;">{{ $email }}</a></p>
          <p>Status SPA : <strong>{{ $premium ? 'Premium' : 'Free' }}</strong></p>
        </address>
      </td>
      @else
      <td width="50%" valign="top" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
        <address>
          <strong>To</strong>
          <p>Pupesa Manggala Asa</p>
        </address>
      </td>
      @endif
    </tr>
  </table>
  <br />
  <p>
    {{ $from_message }}
  </p>
</single>

@endsection
