@extends('Emails.template')

@section('title', $subject)

@section('content')

<single>
  <p><strong>{!! trans('main.headContactus') !!}</strong></p>
  <br />

  <table width="100%">
    <tr>
      <td width="50%" valign="top" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
        <address>
          <strong>{!! trans('main.from') !!}</strong>
          <p>{!! trans('main.name') !!} : {{ $name }}</p>
          <p>Email : {{ $email }}</p>
          <p>Website : {!! $website !!}</p>
          <p>Subject : {!! $subject !!}</p>
          <p>Message : {!! $deskripsi !!}</p>
          <p>{{ date('M d, Y') }}</p>
        </address>
      </td>
      <td width="50%" valign="top" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
        <address>
          <strong>{!! trans('main.regards') !!}</strong>
          <p>Admin Pupesa</p>
        </address>
      </td>
    </tr>
  </table>
</single>

@endsection
