@extends('Emails.template')

@section('title', 'Pesanan')

@section('content')

<single>
  <p><strong>{!! trans('main.headContactus') !!}</strong></p>
  <br />
  <?php 
    $language = App\Models\languages::where('status', '1')->where('code', \App::getLocale())->first();
    $country = App\Models\ref_country::where('id_country', $country_id)->first();
    $product = App\Models\data_product::where('id_product', $id_product)->where('lang_id', $language->id)->first();
  ?>
  <table width="100%">
    <tr>
      <td width="50%" valign="top" style="color:#888;font-size:11pt;line-height:15pt;font-family:'Lato',Arial, sans-serif;color:#888;">
        <address>
          <strong>{!! trans('main.from') !!}</strong>
          <p>{!! trans('main.name') !!} : {{ $name_customer }}</p>
          <p>Email : {{ $email }}</p>
          <p>Title : {!! $title !!}</p>
          <p>Phone : {!! $phone !!}</p>
          <p>Product : {!! $product->product !!}</p>
          <p>Country : {!! $country->nm_country !!}</p>
          <p>City : {!! $city !!}</p>
          <p>address : {!! $city !!}</p>
          <p>{{ date('M d, Y') }}</p>

		  <p>Pesan dari Konsumen : {!! $customer_note !!}</p>
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
