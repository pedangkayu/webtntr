<!doctype html>
<html lang="en">
<head>
{!! SEO::generate() !!}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="host" content="{{ url('') }}">
<!--[if lt IE 9]>
<script src="{{ asset('/front/js/html5.js') }}"></script>
<![endif]-->
<!-- Bootstrap core CSS -->
<link rel="alternate" href="{{ url('') }}" hreflang="id-en" />
<link rel="alternate" href="{{ url('') }}" hreflang="id-au" />
<link rel="alternate" href="{{ url('') }}" hreflang="id-as" />
<link rel="alternate" href="{{ url('') }}" hreflang="x-default" />
<link href="{{ asset('/front/css/bootstrap.css') }}" rel="stylesheet">
<!-- Add custom CSS here -->
<link href="{{ asset('/front/css/color.css') }}" rel="stylesheet">
<link href="{{ asset('/front/css/styles.css') }}" rel="stylesheet">
<link href="{{ asset('/front/css/update.css') }}" rel="stylesheet">
<link href="{{ asset('/front/css/jquery.bxslider.css') }}" rel="stylesheet">
<!-- Bx-Slider -->
<link href="{{ asset('/front/css/horizontal.css') }}" rel="stylesheet">
<link href="{{ asset('/front/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
<link href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" rel="stylesheet">

</head>
<body>

<!-- /. Main Container start ./-->
<div class="wrapper home">

  <!-- /. topbar start ./-->
  <div class="topbar">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 topnav">
          <?php
            $lang = App\Models\languages::where('code', App::getLocale())->first(); 
            $no = 0;
            $class_methods = get_class_methods(new App\Http\Controllers\Pages\PagesController());
            $pages = App\Models\pages::where('lang_id', $lang->id)->where('page_categori', 1)->where('status', 1)->whereIn('function', $class_methods)->get();
          ?>
          @foreach($pages as $page)
          <?php $no++; ?>
            <a href="{{ url(App::getLocale().'/'.$page->slug) }}" !!}>{{ $page->name }}</a> 
            @if(count($pages) != $no)
            &middot;
            @endif
          @endforeach
        </div>

        <div class="col-lg-offset-2 col-md-offset-8 col-lg-4 col-md-5 col-sm-12">
          <!-- div class="social pull-left">
            <a href="https://facebook.com/{{ Format::paladin()->facebook }}" target="_blank" title="Facebook"><i class="fa fa-facebook-square"></i></a>
            <a href="https://plus.google.com/{{ Format::paladin()->gplus }}" target="_blank" title="Gplus"><i class="fa fa-google-plus-square"></i></a>
            <a href="https://twitter.com/{{ Format::paladin()->twitter }}" target="_blank" title="Twitter"><i class="fa fa-twitter-square"></i></a>
            <a href="https://path.com/{{ Format::paladin()->path }}" target="_blank" title="Path"><i class="fa fa-pinterest-square"></i></a>
            <a href="https://instagram.com/{{ Format::paladin()->instagram }}" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
          </div -->  
          
          <div class="hlinks pull-right">
			       <a href="javascript:;" class="ind"><img src="{{ asset('/front/images/id-16x16.png') }}" alt="ID" title="ID"/></a>
			       <a href="javascript:;" class="eng"><img src="{{ asset('/front/images/en-16x16.png') }}" alt="EN" title="EN"/></a>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- /. topbar end ./-->

  <!-- /. Header Start ./-->
  <header id="header">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3">
          <div class="logo"><a href="{{ url('/') }}"><strong class="logo-home"> TINATAR INNOVATION </strong></a></div>
        </div>
        <div class="col-lg-9 col-md-9">
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="home-menu">
            <div class="navbar mm">
              <div>
                <nav class="navbar navbar-default" role="navigation">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                  </div>
                  <div id="navbar-collapse-1" class="collapse navbar-collapse pull-right">
                    <ul class="nav navbar-nav">
                      <?php
                        $class_methods = get_class_methods(new App\Http\Controllers\Pages\PagesController());
                        $lang = App\Models\languages::where('code', App::getLocale())->first();
                        $pagesDms = App\Models\pages::where('lang_id', $lang->id)->where('page_categori', 2)->where('status', 1)->where('stsdms', 2)->get(); 
                        $pagesSts = App\Models\pages::where('lang_id', $lang->id)->where('page_categori', 2)->where('status', 1)->where('stsdms', 1)->whereIn('function',  $class_methods)->get(); 
                      ?>
                      
                      @foreach($pagesDms as $page)
                        <li><a href="{{ url(App::getLocale().'/'.$page->slug) }}" !!}>{{ $page->name }}</a></li>
                      @endforeach
                      @foreach($pagesSts as $page)
                        <li><a href="{{ url(App::getLocale().'/'.$page->slug) }}" !!}>{{ $page->name }}</a></li>
                      @endforeach
                    </ul>
                  </div>
                </nav>
              </div>
            </div>
          </div>
          <!-- /.navbar-collapse -->
        </div>
      </div>
    </div>
  </header>
  <!-- /. Header End ./-->



  @yield('content')


  
 

 
 <!-- /. Footer Start ./-->
  <section id="footer">
    <!-- /. Footer Bottom Bar ./-->
    <section class="footer-mid">
      <div class="footer-midbg">
        <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-12 getintouch">
    				      <h3>{!! trans('main.office') !!}</h3>
                    <p><h4>{{ Format::paladin()->company }}</h4> 
    					             {!! Format::paladin()->address !!}
                    </p>
              </div>

              <div class="col-md-3 col-sm-12 getintouch">
                    <h3>{!! trans('main.contact') !!}</h3>
                    <p>
    				          <i class="fa fa-phone" aria-hidden="true"></i>		{{ Format::paladin()->phone }}<br />
                      <i class="fa fa-phone-square" aria-hidden="true"></i> {{ Format::paladin()->mobile }}<br />
                      <i class="fa fa-envelope-o" aria-hidden="true"></i>	<a href="mailto:{{ Format::paladin()->email }}">{{ Format::paladin()->email }}</a><br />
                      <a href="https://api.whatsapp.com/send?phone=6281353328558&text=type%20your%20question%20"><img class="img-responsive" src="{{ asset('/img/pumasa-whatsapp.png') }}" alt="">
		                </p>
              </div>

              <div class="col-md-3 col-sm-12 getintouch">
                <h3>{!! trans('main.linkage') !!}</h3>
                 <p>
				  {!! Format::paladin()->linkage !!}
                 </p>
              </div>
            </div>


            <div class="row">
              <div class="col-md-9 col-sm-12 getintouch">
                
                    @foreach($pages as $page)
                      <h3><a href="{{ url(App::getLocale().'/'.$page->slug) }}" !!}>{{ $page->name }}</a></h3>
                    @endforeach
              </div>

              <div class="col-md-3 col-sm-12 getintouch">
        				<div class="social pull-left">
        					<a href="https://facebook.com/{{ Format::paladin()->facebook }}" target="_blank" title="Facebook"><i class="fa fa-facebook-square"></i></a>
        					<a href="https://plus.google.com/{{ Format::paladin()->gplus }}" target="_blank" title="Gplus"><i class="fa fa-google-plus-square"></i></a>
        					<a href="https://twitter.com/{{ Format::paladin()->twitter }}" target="_blank" title="Twitter"><i class="fa fa-twitter-square"></i></a>
        					<a href="https://path.com/{{ Format::paladin()->path }}" target="_blank" title="Path"><i class="fa fa-pinterest-square"></i></a>
        					<a href="https://instagram.com/{{ Format::paladin()->instagram }}" target="_blank" title="Instagram"><i class="fa fa-instagram"></i></a>
        				</div>
                
              </div>
            </div>

        </div>
      </div>
    </section>

    <!-- /. Footer Copy rights ./-->

    <section class="footer-copy">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">&copy; 2018 &middot; <strong>{!! Format::paladin()->company !!}</strong> &middot; All Right Reserved</div>
        </div>
      </div>
    </section>


  </section>
  <!-- /. Footer End ./-->
   

 

</div>
<!-- main end -->
<!-- /. Main Container End ./-->
<!-- JavaScript -->
<script src="{{ asset('front/js/jquery-1.10.2.js') }}"></script><!-- Main Jquery File -->
<script src="{{ asset('front/js/modernizr.custom.39665.js') }}"></script><!-- Modernizer -->
<script src="{{ asset('front/js/bootstrap.js') }}"></script><!-- Bootstrap -->
<script src="{{ asset('front/js/jquery.easing.1.3.js') }}"></script><!-- Easing -->
<script src="{{ asset('front/js/jquery.prettyPhoto.js') }}" type="text/javascript" charset="utf-8"></script><!-- Pretty Box -->
<script src="{{ asset('front/js/jquery.bxslider.min.js') }}"></script><!-- Bx Slider -->
<script src="{{ asset('front/js/sly.min.js') }}"></script>
<script src="{{ asset('front/js/horizontal.js') }}"></script>
<script src="{{ asset('front/js/jquery.ui.core.js') }}"></script>
<script src="{{ asset('front/js/jquery.ui.datepicker.js') }}"></script>
<script src="{{ asset('front/js/underscore-min.js') }}"></script>
<script src="{{ asset('front/js/cp_loader.js') }}"></script>
<script src="{{ asset('front/js/jquery.timepicker.min.js') }}"></script>
<script>
	$(function() {
		$( "#datepicker" ).datepicker();
		$( "#datepicker2" ).datepicker();
	});
	</script>
<script src="{{ asset('front/js/jquery-scrolltofixed-min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('/vendor/typeahead/bootstrap-typeahead.min.js') }}"></script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-585812f026e24d60"></script>
<script src="{{ asset('front/js/custom.js') }}"></script><!-- Custom -->
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
