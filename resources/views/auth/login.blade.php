<!DOCTYPE html>
<html lang="en">
    <head>
        <title>paladin</title>
        <link rel="shortcut icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
        <!-- BEGIN META -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="your,keywords">
        <meta name="description" content="Short explanation about this website">
        <!-- END META -->

        <!-- BEGIN STYLESHEETS -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/bootstrap.css?1422792965') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/materialadmin.css?1425466319') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/font-awesome.min.css?1422529194') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/material-design-iconic-font.min.css?1421434286') }}" />
        <!-- END STYLESHEETS -->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script type="text/javascript" src="{{ asset('/js/libs/utils/html5shiv.js?1403934957') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/libs/utils/respond.min.js?1403934956') }}"></script>
        <![endif]-->
    </head>
    <body class="menubar-hoverable header-fixed ">

        <!-- BEGIN LOGIN SECTION -->
        <section class="section-account">
            <div class="img-backdrop" style="background-image: url('{{ asset('/img/header-login.jpg') }}"></div>
            <div class="spacer"></div>
            <div class="card contain-sm style-transparent">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3">
                            <br/>
                            <span class="text-lg text-bold text-primary">LOGIN</span>
                            <br/><br/>

                            <form class="form floating-label" role="form" method="POST" action="{{ url('/login') }}">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                  <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>

                                     @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <p class="help-block"><a href="{{ url('/password/reset') }}">Forgotten?</a></p>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-xs-6 text-left">
                                        <div class="checkbox checkbox-inline checkbox-styled">
                                            <label>
                                                <input type="checkbox" name="remember"> <span>Remember me</span>
                                            </label>
                                        </div>
                                    </div><!--end .col -->
                                    <div class="col-xs-6 text-right">
                                        <button class="btn btn-primary btn-raised" type="submit">Login</button>
                                    </div><!--end .col -->
                                </div><!--end .row -->
                            </form>
                        </div><!--end .col -->

                    </div><!--end .card -->
                </section>
                <!-- END LOGIN SECTION -->

                <!-- BEGIN JAVASCRIPT -->
                <script src="{{ asset('/js/libs/jquery/jquery-1.11.2.min.js') }}"></script>
                <script src="{{ asset('/js/libs/jquery/jquery-migrate-1.2.1.min.js') }}"></script>
                <script src="{{ asset('/js/libs/bootstrap/bootstrap.min.js') }}"></script>
                <script src="{{ asset('/js/libs/spin.js/spin.min.js') }}"></script>
                <script src="{{ asset('/js/libs/autosize/jquery.autosize.min.js') }}"></script>
                <script src="{{ asset('/js/libs/nanoscroller/jquery.nanoscroller.min.js') }}"></script>
                <script src="{{ asset('/js/core/source/App.js') }}"></script>
                <script src="{{ asset('/js/core/source/AppNavigation.js') }}"></script>
                <script src="{{ asset('/js/core/source/AppOffcanvas.js') }}"></script>
                <script src="{{ asset('/js/core/source/AppCard.js') }}"></script>
                <script src="{{ asset('/js/core/source/AppForm.js') }}"></script>
                <script src="{{ asset('/js/core/source/AppNavSearch.js') }}"></script>
                <script src="{{ asset('/js/core/source/AppVendor.js') }}"></script>
                <script src="{{ asset('/js/core/demo/Demo.js') }}"></script>
                <!-- END JAVASCRIPT -->

            </body>
        </html>
