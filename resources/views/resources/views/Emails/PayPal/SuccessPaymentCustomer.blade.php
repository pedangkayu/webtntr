@extends('Emails.template')

@section('title', 'Helo ' . $title . ' ' . $name_customer)

@section('content')
  <single>
    <p><strong>Your payment was success.</strong></p>
    <p>
      Thank you very much for your interest of using our service Our staff will reply your reservation as soon as possible, usually within 24 hours.<br />
      And send Voucher for registeration to <strong>{{ $spa }}</strong>
    </p>
  </single>
@endsection
