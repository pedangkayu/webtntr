@extends('Emails.template')

@section('title', 'Helo ' . $title . ' ' . $name_customer)

@section('content')
  <table>
    <tr>
      <td height="20"></td>
    </tr>
    <tr>
      <td>
        <table>
          <tr>
            <td style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
              Warmest greeting from Bali Spa Centre !!
              Thank you very much for your interest of using our service
              Our staff will reply your reservation as soon as possible, usualy within 24
              hours
              <br /><br />
              We have received the following informations.
            </td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
                <table width="100%">
                  <tr>
                    <td valign="top" width="65%" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
                      <h3 style="margin:0;color:#117970;"><strong><em>CODE #{{ strtoupper($code) }}</em></strong></h3>
                      <br />
                      <address>
                        <strong>Spa Date & time</strong>
                        <p>+ {{ date('d M Y', strtotime($day_request)) }} / {{ date('h:i A', strtotime($time_request)) }}</p>
                        <strong>Amount Person</strong>
                        <p>+ {{ $qty_person }} person</p>
                        <strong>Special Request</strong>
                        <p>{{ $note }}</p>
                        <br />
                        <strong>Name</strong>
                        <p>+ {{ $title }} {{ $name_customer }}</p>
                        <strong>Email</strong>
                        <p>+ {{ $email }}</p>
                        <strong>Phone</strong>
                        <p>+ {{ $phone }}</p>
                        <strong>Address</strong>
                        <p>+ {{ $address }}</p>
                        <strong>City</strong>
                        <p>+ {{ $city }}</p>
                        <strong>Country</strong>
                        <p>+ {{ $nm_country }}</p>
                        @if(!empty($hotel))
                          <br />
                          <strong>Hotel In Bali</strong>
                          <p>+ {{ $hotel }}</p>
                          <strong>Date Check In Hotel</strong>
                          <p>+ {{ date('d M Y', strtotime($checkin_hotel)) }}</p>
                          <strong>Hotel Telephone</strong>
                          <p>+ {{ $contact_hotel }}</p>
                        @endif
                      </address>
                    </td>
                    <td valign="top" width="35%" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
                      <img src="{{ asset('/img/servicepack/' . $servicepack_img) }}" alt="{{ $servicepack }}" width="100%">
                      <br /><br />
                      <address>
                        <strong>{{ $type == 1 ? 'Service' : 'Package' }} name</strong>
                        <p>+ <a href="{{ url($spa_slug . '/servicepack/' . $servicepack_slug) }}" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">{{ $servicepack }}</a></p>
                        <strong>Duration</strong>
                        <p>+ {{ $duration }}</p>
                        <strong>Price</strong>
                        <p>+ {{ $subtotal }} {{ $iso_code }}</p>
                        @if($discount > 0)
                        <strong>Discount</strong>
                        <p>+ {{ number_format($discount,0) }}% Off</p>
                        @endif
                        <br />
                        <strong>Spa Name</strong>
                        <p>+ <a href="{{ url($spa_slug) }}" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">{{ $spa }}</a></p>
                      </address>
                    </td>
                  </tr>
                </table>
            </td>
          </tr>
          <tr>
            <td height="10"></td>
          </tr>
          <tr>
            <td style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
              Should you need other assistance, please feel free to contact usHave a nice day
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>

@endsection
