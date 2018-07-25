<!DOCTYPE HTML><head>
		{!! SEO::generate() !!}
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="{{ asset('tems/template01/css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
		<script src="{{ asset('tems/template01/js/jquery.min.js') }}"></script>
		@yield('meta')
	</head>
	<body>
		<div class="header">
<div class="header_top">
<div class="wrap">
 <div class="logo">
      <a href="">@yield('logo')</a>
    </div>
    <div class="call">
      <p><img src="{{ asset('tems/reflection/images/icon-phone.png') }}" alt="" />Call Us : @yield('phone')<br />
	  <a href="https://api.whatsapp.com/send?phone=@yield('phone')&text=type%20your%20question%20"><img class="img-responsive" src="{{ asset('/img/WA-jackr.png') }}" alt=""></a></p>
    </div>

  <div class="clear"></div>
</div>
  </div>
    <div class="header_bottom">
      <div class="wrap">
          <div class="menu">
						@yield('menu')
          </div>
          <div class="social-icons">
						@yield('social')
          </div>
          <div class="clear"></div>
          </div>
      </div>
       <div class="strip"> </div>
    </div>
		@yield('header')
		<div class="main">
			<div class="content">
				<div class="wrap">
					@yield('content')
				</div>
			</div>
		</div>
	  <div class="footer-strip"></div>
	  <div class="footer">
			@yield('footer')
		</div>
		<div class="copy_right">
			 <p>Copyright © 2006 - 2016 &middot; <a href="http://company.web">company.web</a> &middot; All Rights Reserved </a></p>
		</div>
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-585812f026e24d60"></script> 
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-86097925-1', 'auto');
		  ga('send', 'pageview');

		</script>
	</body>
</html>
