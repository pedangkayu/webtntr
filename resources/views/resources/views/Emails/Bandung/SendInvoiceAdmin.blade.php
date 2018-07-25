@extends('Emails.template')

@section('title', 'Hi, ' . $by)

@section('content')
  <single>
    <p>
      Thanks for your payment, we will check it within 24 hours
    </p>
  </single>
@endsection
