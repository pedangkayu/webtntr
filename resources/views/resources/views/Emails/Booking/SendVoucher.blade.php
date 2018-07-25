@extends('Emails.template')

@section('title', 'Helo ' . $title . ' ' . $name_customer)

@section('content')
  <single>
    <p>
      Thank you for your payment., we really appreciate it.
      Please find attached is the spa voucher
      Should you need other assistance, please feel free to contact us
      Thank you for your kind attention and we are looking forward to have your
      confirmation

      Kindly regards
    </p>
  </single>
@endsection
