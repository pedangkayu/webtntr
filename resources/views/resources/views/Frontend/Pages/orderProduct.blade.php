@extends('layouts.Frontend.content')
@section('title_page', trans('main.orderProduct'))
@section('content')
 

<section class="signup">
  <div class="container">
      @if(session('status'))
        <div class="alert alert-info">
          {!! session('status') !!}
        </div>
      @endif


		<div class="row" id="pages">
           <div class="col-lg-6 col-md-6 col-sm-6">
		     <div class="contact">
			  <form method="post" action="{{ url('/page/form/orderproduk') }}" class="formorder">
               {{ csrf_field() }}
               <input type="hidden" name="product" value="{!! $product->id_product !!}">
                  
				  <ul class="row">
                     <li class="col-lg-12">
                        <label>Jumlah yang akan di pesan *</label>
						<input name="name" type="text" class="required" placeholder="Jumlah Pesanan" value="{{ old('qty') }}" required>
                     </li>
                  </ul>			
				 
				  
				  <ul class="row">
                     <li class="col-lg-6">
                        <label class="first">Title *</label>
                        <input name="title" type="text" class="required" placeholder="Title" value="{{ old('title') }}" required>
                     </li>
                     <li class="col-lg-6">
                        <label class="first">Nama *</label>
                        <input name="name" type="text" class="required" placeholder="Name" value="{{ old('name') }}" required>
                     </li>
                  </ul>


                  <ul class="row">
                     <li class="col-lg-6">
                        <label>Email *</label>
                        <input name="email" type="email" class="required forminput" value="{{ old('email') }}" placeholder="Email" required>
                     </li>
                     <li class="col-lg-6">
                        <label>Nomer Hape *</label>
                        <input name="phone" type="tel" pattern="^\d{3}-\d{3}-\d{4}$" class="required forminput" value="{{ old('phone') }}" placeholder="phone" required>
                     </li>
                  </ul>


                  <ul class="row">
                     <li class="col-lg-6">
                      <label>Kota *</label>
                        <input name="city" type="text" class="required" value="{{ old('city') }}" placeholder="City" required>
                    </li>

                     <li class="col-lg-6">
                        <label>Negara asal *</label>
                          <select name="country" class="forminput">
                            <?php
                              $countries = App\Models\ref_country::where('status', 1)->get();
                              if (count($countries)) {
                                foreach ($countries as $country) {
                                  if ($country->id_country == 100) {
                                    $selected = 'selected';
                                  } else {
                                    $selected = '';
                                  }
                                  echo '<option value="'.$country->id_country.'" '.$selected.'>'.$country->nm_country.'</option>';
                                }
                              }
                            ?>
                          </select>
                     </li>
                  </ul>


                  <ul class="row">
                    <li class="col-lg-12">
                      <label>Alamat Pengiriman Pesanan</label>
                      <textarea rows="3" name="address">{{ old('address') }}</textarea>
                   </li>
                  </ul>


                  <ul class="row">
                    <li class="col-lg-12">
                      <label>Catatan Tambahan (optional)</label>
                      <textarea rows="3" name="customer_note">{{ old('customer_note') }}</textarea>
                    </li>
                  </ul>


                  <ul class="row">
                    <li>
					    <div class="mtop2"></div>
                        <div class="col-sm-6">
                          <?php $site_key = '6LevDUkUAAAAANkgKt_0ICIPSaQQbHDjtx43Lvtk';?>
                          <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                        </div>

                        <div class="col-sm-6 text-right">
                           <button type="submit" class="btn btn-default">PEMESANAN</button>
                        </div>
                    </li>
                  </ul>

               </form><!-- END FORM -->
		    
		      </div>
		   </div>
            



		   <div class="col-lg-6 col-md-6 col-sm-6">
		        <div class="mtop1"></div>
				<div class="contact-details">
					@if($product->img_thumbnail != 'null')
					<img src="/img/produk/thumb/{!! $product->img_thumbnail !!}" width="640px">
					@else
					<img src="/img/produk/default.png">
					@endif
					<h5>{!! $product->product !!}</h5> 
					<!-- h5>Rp. {!! number_format($product->price_publish) !!}</h5 --> 
					<p>{!! $product->description !!}</p>
				</div>
		   </div>

		</div>
  </div>
</section>




 





<script src='https://www.google.com/recaptcha/api.js'></script>
@endsection
@section('js')
<script src="/js/libs/jquery/jquery-1.11.2.min.js"></script>
<script src="/js/validate.js"></script>
<script type="text/javascript">
$(document).ready(function () {
  $('.formorder').validate({ // initialize the plugin
          rules: {
              title: {
                  required: true,
                  minlength: 3,
              },
              name: {
                  required: true,
                  minlength: 3,
              },
              email: {
                  required: true,
                  email: true
              },
              city: {
                  required: true,
                  minlength: 3,
                  maxlength: 50,
              },
              phone: {
                  required: true,
                  minlength: 8,
                  maxlength: 15,
                  digits: true,
              },
              description: {
                  required: true,
                  minlength: 6,
              },
              address: {
                  required: true,
                  minlength: 6,
              }
          },
          messages: {
            title: {
              required: "Please enter your title",
              minlength: "Your title must be at least 6 characters long",
            },
            name: {
              required: "Please enter your name",
              minlength: "Your name must be at least 6 characters long",
            },
            email: {
              required: "Please enter your email",
              email: "Please enter a valid email address",
            },
            city: {
              required: "Please enter your city",
              minlength: "Your city must be at least 3 characters long",
              maxlength: "Your city max 50 characters long",
            },
            phone: {
              required: "Please enter your number phone",
              minlength: "Your number phone must be at least 8 characters long",
              maxlength: "Your number phone max 15 characters long",
              digits: "Please enter only digits",
            },
            description: {
              required: "Please provide a password",
              minlength: "Your password must be at least 6 characters long",
            },
            address: {
              required: "Please provide a password",
              minlength: "Your password must be at least 6 characters long",
            },
          },
            submitHandler: function (form) { // for demo
                form.submit();
            }
        });
});
</script>
@endsection
