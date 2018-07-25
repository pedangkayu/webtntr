@extends('Emails.template')
@section('title', $subject)
@section('content')

<single>
  <p><strong>You get a new message.</strong></p>
  <br />
  <address>
    <strong>From</strong>
    <p>Name : {{ $from_name }}</p>
    <p>Email : <a href="mailto:{{ $from_email }}" style="color:#888;">{{ $from_email }}</a></p>
  </address>
  <br />
  <p>
    {{ $from_message }}
  </p>
</single>

@endsection
