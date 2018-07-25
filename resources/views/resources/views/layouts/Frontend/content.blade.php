<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        {!! SEO::generate() !!}
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ asset('/front/img/assets/favicon.png') }}" rel="icon" type="image/png"> 
        <link href="{{ asset('/front/css/init.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/front/css/ion-icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/front/css/etline-icons.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('/front/css/theme.css') }}" rel="stylesheet" type="text/css">  
        <link href="{{ asset('/front/css/custom.css') }}" rel="stylesheet" type="text/css"> 
        <link href="{{ asset('/front/css/colors/purple.css') }}" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700%7CRaleway:400,100,200,300%7CHind:400,300" rel="stylesheet" type="text/css">
    </head>

    <body data-fade-in="true">
        <div class="pre-loader"><div></div></div>
        
        <!-- Start Header -->
        <nav class="navbar nav-down" data-fullwidth="true" data-menu-style="light" data-animation="shrink"><!-- Styles: light, dark, transparent | Animation: hiding, shrink -->
            <div class="container">
                
                <div class="navbar-header">
                    <div class="container">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar top-bar"></span>
                                <span class="icon-bar middle-bar"></span>
                                <span class="icon-bar bottom-bar"></span>
                            </button>
                            <a class="navbar-brand to-top" href="{{ url('/') }}"><img src="{{ asset('/front/img/assets/logo-light.png') }}" class="logo-light" alt="#"><img src="{{ asset('/front/img/assets/logo-dark.png') }}" class="logo-dark" alt="#"></a> 
                    </div>
                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <div class="container">
                        <ul class="nav navbar-nav menu-right">                             
                            <!-- Each section must have corresponding ID ( #hero -> id="hero" ) -->
                            <?php
                              $no = 0;
                              $class_methods = get_class_methods(new App\Http\Controllers\Pages\PagesController());
                              $lang = App\Models\languages::where('code', App::getLocale())->first();
                              $pagesDms = App\Models\pages::where('lang_id', $lang->id)->where('page_categori', 2)->where('status', 1)->where('stsdms', 2)->get(); 
                              $pagesSts = App\Models\pages::where('lang_id', $lang->id)->where('page_categori', 2)->where('status', 1)->where('stsdms', 1)->whereIn('function',  $class_methods)->get(); 
                              $pages = App\Models\pages::where('lang_id', $lang->id)->where('page_categori', 1)->where('status', 1)->whereIn('function', $class_methods)->get();
                            ?>

                            @foreach($pagesDms as $page)
                              <li><a href="{{ url(App::getLocale().'/'.$page->slug) }}" !!}>{{ $page->name }}</a></li>
                            @endforeach
                            @foreach($pagesSts as $page)
                              <li><a href="{{ url(App::getLocale().'/'.$page->slug) }}" !!}>{{ $page->name }}</a></li>
                            @endforeach

                            <li class="nav-separator"></li>
                            <li  class="nav-icon"><a href="http://facebook.com" target="_blank"><i class="ion-social-facebook"></i></a></li>
                            <li  class="nav-icon"><a href="http://twitter.com" target="_blank"><i class="ion-social-twitter"></i></a></li>
                            <li  class="nav-icon"><a href="#" target="_blank"><i class="ion-help-buoy"></i></a></li>
                        </ul>
                    </div>
                </div> 
            </div>
        </nav>
        <!-- End Header -->
        
        @yield('content')






        <!-- Contact Info -->
        <section class="parallax pt110 pb70" data-overlay-dark="8">
            <div class="background-image">
                <img src={{ asset('/front/img/backgrounds/bg-8.jpg') }}"> 
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 details white text-center">
                        <div class="phone-number mb10">
                            <h1 class="bold">{{ Format::paladin()->mobile }}</h1>
                        </div>
                        <div class="col-lg-12">
                            <h3>{{ Format::paladin()->company }}</h3>
                            <h3>info@<span class="color">tinatar.com</span></h3>
                            <h4>{!! Format::paladin()->address !!} <span class="color">Jawa Barat</span></h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Info -->
        

        <!-- Start Footer -->
        <footer id="footer" class="footer style-1 dark">
            @foreach($pages as $page)
                <?php $no++;?>
                <a href="{{ url(App::getLocale().'/'.$page->slug) }}" !!}>{{ $page->name }}</a> 
                @if(count($pages) != $no)
                    &middot;
                @endif
            @endforeach
           
            <ul>
                <li><a href="https://www.twitter.com/" target="_blank" class="color"><i class="ion-social-twitter"></i></a></li>
                <li><a href="https://www.facebook.com/" target="_blank" class="color"><i class="ion-social-facebook"></i></a></li>
                <li><a href="https://www.linkedin.com/" target="_blank" class="color"><i class="ion-social-linkedin"></i></a></li>
                <li><a href="https://www.pinterest.com/" target="_blank" class="color"><i class="ion-social-pinterest"></i></a></li>
                <li><a href="https://plus.google.com/" target="_blank" class="color"><i class="ion-social-googleplus"></i></a></li> 
            </ul>

            <a href="http://tinatar.com" target="_blank"><strong>Tinatar Innovation 2018</strong></a>
            <p>Made with happiness, passion, coffee and potato chips</p>
            
            <!-- Back To Top Button -->
            <span><a class="scroll-top"><i class="ion-chevron-up"></i></a></span>
            
        </footer>
        <!-- End Footer -->
        
        <script src="{{ asset('front/js/jquery.js') }}"></script>
        <script src="{{ asset('front/js/init.js') }}"></script>
        <script src="{{ asset('front/js/scripts.js') }}"></script>     
   
    <script>
      $(window).load(function() {
        $(".loader").fadeOut("slow");
      });

      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-115160220-1', 'auto');
      ga('send', 'pageview');

      $('body').on('click', '.ind', function(){
      $(".loader").show();
      var result=window.location.pathname.split('/');
      $.ajax({
        url: "/transalate-pages-id/"+result[2]+"/"+result[3],
        success: function (resp) {
          page = '';
          childPage = '';
          if (resp.page != 'undefined') {
          page = resp.page.slug;
          }
          if (resp.childPage != 'undefined') {
          childPage = resp.childPage.slug;
          } 
          if (result.length == 4) {
          window.location.replace("/id/"+page+'/'+childPage);
          } else if (result.length == 3) {
          window.location.replace("/id/"+page);
          } else if (result.length == 2) {
          window.location.replace("/id");
          }
        }
      });
      });

      $('body').on('click', '.eng', function(){
      $(".loader").show();
      var result=window.location.pathname.split('/');
      $.ajax({
        url: "/transalate-pages-eng/"+result[2]+"/"+result[3],
        success: function (resp) {
          page = '';
          childPage = '';
          if (resp.page != 'undefined') {
          page = resp.page.slug;
          }
          if (resp.childPage != 'undefined') {
          childPage = resp.childPage.slug;
          } 
          if (result.length == 4) {
          window.location.replace("/en/"+page+'/'+childPage);
          } else if (result.length == 3) {
          window.location.replace("/en/"+page);
          } else if (result.length == 2) {
          window.location.replace("/en");
          }
        }
      });
      });

      $('body').on('click', '.slug', function(){
      var result=window.location.href;
      window.location.replace(result+'/'+$(this).data('slug'));
      });
      $('body').on('click', '.slugdetail', function(){
      var result=window.location.href;
      console.log(result);
      });
      $('body').on('click', '.homeSlug', function(){
      var result=window.location.href;
      var home = $(this).data('home');
      var slug = $(this).data('slug');
      //console.log(result);
      window.location.replace(result+'/'+home+'/'+slug);
      });
    </script>
    </body>
</html>