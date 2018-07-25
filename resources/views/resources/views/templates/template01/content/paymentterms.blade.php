
@extends('templates.template01.layout')

@section('phone', $spa->premium ? $spa->phone : $bali->mobile)
@section('logo', '<img src="' . asset('/img/logo/' . $spa->logo) . '" alt="' . $spa->spa . '"/>')

@section('social')
<ul>
  <li><a href="{{ $spa->facebook }}" target="_blank"><img src="{{ asset('tems/template01/images/facebook.png') }}" alt="" /></a></li>
  <li><a href="https://twitter.com/{{ $spa->twitter }}" target="_blank"><img src="{{ asset('tems/template01/images/twitter.png') }}" alt="" /></a></li>
  <li><a href="https://instagram.com/{{ str_replace('@', '', $spa->twitter) }}" target="_blank"><img src="{{ asset('tems/template01/images/instagram.png') }}" alt="" /></a></li>
</ul>
@endsection

@section('menu')
  <ul>
    @foreach($menus as $menu)
      <li class="{{ $menu['active'] }}"><a href="{{ url($menu['url']) }}">{{ $menu['title'] }}</a></li>
    @endforeach
    <div class="clear"></div>
  </ul>
@endsection

@section('content')
<div class="content-terms">
  <h3>Payment Terms</h3>
  <p><b>Bali Spa Center ( Cv. Naya Bali Cipta Kreasi )</b>&nbsp;is a well establish Online Spa Booking based in Bali able to accept all major credit cards, bank/wire transfer and cash payment in certain currencies. We also able to accept the payment online that we work together with PayPal to make easy, quick and safety for you to pay by all major credit card, travel check and bank transfers. It is very important for you to notify the following terms and conditions of payment.&nbsp;
    <br><br><b>Credit Card Payment</b><br>Payment can be made through PayPal <a target="_blank" href="https://www.paypal.com">(https://www.paypal.com)</a>. Payment through PayPal is very easy, quick and safe. You do not need to expose your credit card details to merchant like us.<br></p>
  <ul>
     <li>Please note that paying via PayPal&nbsp;<b>does not require you to possess or open a PayPal account</b>. PayPal accepts all major credit cards</li>
     <li>Once you submit the booking request correctly, our team will process your booking and get you back with further confirmation</li>
     <li>Your booking confirmation is based on availability bases and our teams will response your booking request within 24 hours and incase of circumstances, it might be extended</li>
     <li>The payment can be settled once you have received our confirmation</li>
     <li>To secure your booking, the payment must made by the latest of deadline date issued by our team on your booking confirmation otherwise it will be released automatically from our system and your booking will be subject to availability bases</li>
     <li>To settle the payment through online, you click the pay button below</li>
  </ul>
  <br />
  <b>Bank Transfer</b><br><span>Payment can be made through our bank account:&nbsp;</span>
  <address>
    <strong>Bank Central Asia ( BCA )</strong><br />
    <span>Bank Swift Code :&nbsp;</span><b>CENAIDJA</b><br />
    <span>Account Name :&nbsp;</span><b>CV. Naya Bali Cipta Kreasi</b><br />
    <span>Account Name :&nbsp;</span><b>CV. Naya Bali Cipta Kreasi</b><br />
    <span>Account Number:&nbsp;</span><b>4350 381 886</b><br />
    <span>Please email the copy of bank transfer to our email Info@paladin.net for our cross check with our bank.&nbsp;</span>
  </address>
  <br />
    <b>Payment Online</b><br><span>You can settle the payment online for all products that you have purchased at paladincentre.com and you can use the PayPal (www.paypal.com) facilities by the following guideline:</span>
    <ol>
      <li><span>1. When you purchase/book the products at paladincentre.com, our team will process your booking first and then give you the official confirmation through email later</span></li>
      <li><span>2. You do not need to settle the payment before you get the official confirmation</span></li>
      <li><span>3. You will receive our confirmation within 24 hours or incase some of circumstances, it might be extended</span></li>
      <li><span>4. You will be notified the deadline of payment and the total invoice that you have to settle on the confirmation</span></li>
      <li><span>5. Payment must be made after you get the official confirmation from our team which is notified through your email</span></li>
    </ol>
    <br><b>How to Pay Via PayPal?</b>
    <br><span>Payment through PayPal is very simple, easy, quick and safe and you do not need to expose your credit card to merchant like us.</span>
    <br><span>1. Click the bottom 'Pay Now' below and you will be connected direct to the official website of Paypal <a target="_blank" href="https://www.paypal.com">(https://www.paypal.com)</a> with CV. Naya Bali Cipta Kreasi, Account Address.</span>
    <br><span>2. You will find two columns where in the left side you will see the description/item name and item price, meanwhile the right side column, you have two options whether you want to use your own Paypal account or you may click Don't Have Paypal Account link if you do not have paypal account</span>
    <br><br><b>REMARKS</b><span></span>
  <ul>
     <li>Once we have received your payment through PayPal, our teams will response to you by sending the official receipt and necessary voucher for your further references</li>
     <li>Are you ready to process the payment now? Then click the bottom below</li>
     <li>Should you have any question, please feel free to&nbsp;<a target="_blank" href="{{ url($spa->slug . '/contact') }}">contact us</a>&nbsp;to get the response soon.</li>
  </ul>
</div>

<div style="text-align:center;margin-top:50px;">
  <a href="{{ $book->link_paypal }}"><img src="{{ asset('/img/paynow.png') }}" alt=""></a>
</div>

@endsection



@section('footer')
<div>
      <div class="wrap">
        <div class="footer_grides">
          <div class="footer_grid1">
            <h3>{{ $spa->spa }}</h3>
            <div class="address">
            <ul>
                <li>{{ $spa->address }}</li>
                @if($spa->premium)
                  <li>
                    <address>
                      <p>Phone: {{ $spa->phone }}</p>
                      <p>Mobile: {{ $spa->mobile }}</p>
                      <p>Fax: {{ $spa->fax }}</p>
                    </address>
                  </li>
                @else
                  <li>
                    <address>
                      <p>Phone: {{ $bali->phone }}</p>
                      <p>Mobile: {{ $bali->mobile }}</p>
                      <p>Fax: {{ $bali->fax }}</p>
                    </address>
                  </li>
                @endif
            </ul>
         </div>
            </div>
      <div class="footer_grid2">&nbsp;</div>
      <div class="footer_grid3">&nbsp;</div>
    <div class="footer_grid4">
    <h3>Follow US</h3>
      <div class="social-footer">
          <ul>
            <li><a href="{{ $spa->facebook }}" target="_blank"><img src="{{ asset('tems/template01/images/facebook.png') }}" alt="" /></a></li>
            <li><a href="https://twitter.com/{{ $spa->twitter }}" target="_blank"><img src="{{ asset('tems/template01/images/twitter.png') }}" alt="" /></a></li>
            <li><a href="https://instagram.com/{{ str_replace('@', '', $spa->twitter) }}" target="_blank"><img src="{{ asset('tems/template01/images/instagram.png') }}" alt="" /></a></li>
          </ul>
      </div>
   </div>
   <div class="clear"></div>
    </div>
   </div>
 </div>
@endsection
