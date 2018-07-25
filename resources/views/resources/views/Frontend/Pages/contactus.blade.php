@extends('layouts.Frontend.content')
@section('title_page', $page->name)
@section('content')

        <!-- Contact Form -->    
        <section id="contact" class="pt120 pb100">
            <div class="container">
				@if (count($errors) > 0)
					 <div class="alert alert-warning">
						 <ul>
							 @foreach ($errors->all() as $error)
								 <li>{{ $error }}</li>
							 @endforeach
						 </ul>
					 </div>
				@endif

				<div class="col-ls-4">
					  @if(session('status'))
							<div class="alert alert-info">
								{!! session('status') !!}
							</div>
					  @endif
				</div>

                <div class="row">     
                    <div class="col-md-12 text-center pb20">   
                        <h2>Get In Touch<br><strong>Contact Us</strong></h2>
                        <p class="lead">We would like to <span class="color">hear from you</span></p>
                    </div>
                    
                    <div class="col-md-8 col-md-offset-2 contact box-style"> 
                        <div id="message-info"></div>
                        <!-- Forms can be functional only on server. Upload to your server when testing. -->
                        <form id="contactform" action="{{ url('/page/form/contactus') }}" method="post"> 
                            
                            <div class="col-sm-12">
                                <input name="from_name" id="name" placeholder="Name *" value="{{ old('from_name') }}" required/>
                            </div>

                            <div class="col-sm-6">
                                <input name="from_email" id="email" placeholder="Email *" value="{{ old('from_email') }}" required/>
                            </div>

                            <div class="col-sm-6">
                                <input name="from_website" id="phone" placeholder="Website" value="{{ old('from_website') }}" />
                            </div>

                            <div class="col-sm-12">
                                <input name="subject" id="phone" placeholder="Subject *" value="{{ old('subject') }}" required/>
                            </div>

                            <div class="col-sm-12"> 
                                <textarea name="from_message" rows="9" id="message"  placeholder="You're Message" />{{ old('from_message') }}</textarea>
                            </div>

                            <div class="col-md-6">
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

		<script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- End Contact Form -->

@endsection
 