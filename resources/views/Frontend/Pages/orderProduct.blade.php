@extends('layouts.Frontend.content')
@section('title_page', trans('main.orderProduct'))
@section('content')
 
<!-- Contact Form -->    
        <section id="contact" class="pt120 pb100">
            <div class="container">
      @if(session('status'))
        <div class="alert alert-info">
          {!! session('status') !!}
        </div>
      @endif

                <div class="row">     
                    
                    <div class="col-md-12 text-center pb20">   
                        <h2>Order Product</h2>
                        <p class="lead">We would like to <span class="color">hear from you</span></p>
                    </div>
                    
                    <div class="col-md-8 col-md-offset-2 contact box-style"> 
                        <div id="message-info"></div>
                        <!-- Forms can be functional only on server. Upload to your server when testing. -->
                        <form id="contactform" action="{{ url('/page/form/orderproduk') }}" method="post"> 
                            {{ csrf_field() }}
                            <input type="hidden" name="product" value="{!! $product->id_product !!}">

                            <div class="col-sm-12">
                                <input name="name" id="name" class="required forminput" placeholder="Your Name *" value="{{ old('name') }}"/>
                            </div>

                            <div class="col-sm-6">
                                <input name="email" id="email" class="required forminput" placeholder="Your Email *" value="{{ old('email') }}"/>
                            </div>

                            <div class="col-sm-6">
                                <input name="phone" id="phone" pattern="^\d{3}-\d{3}-\d{4}$" class="required forminput" value="{{ old('phone') }}" placeholder="Your Phone"/>
                            </div>

                            <div class="col-sm-6">
                                <input name="city" id="city" value="{{ old('city') }}" placeholder="Kota"/>
                            </div>

                            <div class="col-sm-6">
                                <input name="address" id="address" value="{{ old('address') }}" placeholder="Alamat"/>
                            </div>


                            <div class="col-sm-12"> 
                                <textarea name="message" rows="9" id="message" placeholder="Your Message *">{{ old('customer_note') }}</textarea>
                            </div>

                            <div class="col-sm-6"> 
                                <?php $site_key = '6LevDUkUAAAAANkgKt_0ICIPSaQQbHDjtx43Lvtk';?>
                             <div class="g-recaptcha" data-sitekey="<?php echo $site_key; ?>"></div>
                            </div>

                            <div class="col-md-6">
                                <input type="submit" class="submit btn btn-lg btn-primary" id="submit" value="Send Message"/>
                            </div>

                        </form>
                    </div>  

                </div>
            </div>
        </section>
        <!-- End Contact Form -->

 


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
