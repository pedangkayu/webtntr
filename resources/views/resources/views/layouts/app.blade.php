<!DOCTYPE html>
<html lang="en">
    <head>
        <title> {{  config("app.name") }} </title>
        <link rel="shortcut icon" href="{{ url('/favicon.ico') }}" type="image/x-icon">
        <!-- BEGIN META -->
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="host" content="{{ url('') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="keywords" content="your,keywords">
        <meta name="description" content="Short explanation about this website">
        <!-- END META -->

        <!-- BEGIN STYLESHEETS -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:300italic,400italic,300,400,500,700,900' rel='stylesheet' type='text/css'/>
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/bootstrap.css?1422792965') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/materialadmin.css?1425466319') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/font-awesome.min.css?1422529194') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/material-design-iconic-font.min.css?1421434286') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('/css/theme-default/libs/toastr/toastr.css?1425466569') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('/css/update.css') }}">
        <!-- END STYLESHEETS -->
 
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script type="text/javascript" src="{{ asset('/js/libs/utils/html5shiv.js?1403934957') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/libs/utils/respond.min.js?1403934956') }}"></script>
        <![endif]-->

        @yield('meta')

    </head>
    <body class="menubar-hoverable header-fixed menubar-pin menubar-first">
  
        <!-- BEGIN HEADER-->
        <header id="header" >
            <div class="headerbar">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="headerbar-left">
                    <ul class="header-nav header-nav-options">
                        <li class="header-nav-brand" >
                            <div class="brand-holder">
                                <a href="{{ url('/home') }}">
                                    <span class="text-lg text-bold text-primary"> {{  config("app.name") }}</span>
                                </a>
                            </div>
                        </li>
                        <li>
                            <a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                                <i class="fa fa-bars"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="headerbar-right">
                    <ul class="header-nav header-nav-options">
                        <li>
                            <!-- Search form -->
                            <form class="navbar-search" role="search">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="headerSearch" placeholder="Enter your keyword">
                                </div>
                                <button type="button" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-search"></i></button>
                            </form>
                        </li>
						<li class="dropdown hidden-xs">
                            <div class="globeNotify">                                
                                <?php 
                                    $count = App\Models\data_pesanan::where('status', 1)->count();
                                    $allNotify = App\Models\data_pesanan::select('time_request', 'id_pesanan', 'data_pesanan.status', 'product', 'data_pesanan.code', 'name_customer')
                                        ->join('data_product', 'data_pesanan.id_product', '=', 'data_product.id_product')->orderBy('time_request', 'DESC')->get();
                                ?>
    							<!-- ditutup dulu, karena belom fix data pesanannya <a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">-->
    							    <a href="javascript:void(0);" class="btn btn-icon-toggle btn-default">
    								<i class="fa fa-globe fa-lg"></i><sup class="badge style-danger">{!! $count !!}</sup>
    							</a>
    							<ul class="dropdown-menu animation-expand badges-items">
                                <div style="margin-left: 10px; color: blue;"><a class="allreadpesan" href="javascript:void(0)"><small>Tandai semua telah dibaca</small></a></div>
                                    @foreach($allNotify as $item)
                                        <li>
                                            <a {!! $item->status == 1 ? 'style="background-color: #edf2fa"' : '' !!} class="alert alert-callout notify {!! $item->status == 1 ? 'alert-info' : 'alert-danger'  !!}" data-id="{!! $item->id_pesanan !!}" href="javascript:;">
                                                <small class="pull-right text-muted"><small>{!! date('F d, Y', strtotime($item->time_request)) !!}</small></small>
                                                <strong>Kode Pesanan <b>{!! strtoupper($item->code) !!}</b></strong><br>
                                                <small>Dari : {!! $item->name_customer !!}</small>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="loading"></div>
						</li>
                        <li class="dropdown hidden-xs">
                            <div class="messageNotify">                                
                                <?php 
                                    $messages = App\Models\data_message::orderBy('created_at', 'DESC')->get();
                                    $count = App\Models\data_message::orderBy('created_at', 'DESC')->where('status', 1)->count();
                                ?>
                                <a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">
                                    <i class="fa fa-envelope fa-lg"></i><sup class="badge style-danger">{!! $count !!}</sup>
                                </a>
                                <ul class="dropdown-menu animation-expand badges-items">
                                <div style="margin-left: 10px; color: blue;"><a class="allreadmessage" href="javascript:void(0)"><small>Tandai semua telah dibaca</small></a></div>
                                    @foreach($messages as $item)
                                        <li>
                                            <a class="alert alert-callout {!! $item->status == 1 ? 'alert-info' : 'alert-danger'  !!}" {!! $item->status == 1 ? 'style="background-color: #edf2fa"' : '' !!}  href="/message/{!! $item->id !!}">
                                                <small class="pull-right text-muted"><small>{!! date('M d, Y', strtotime($item->created_at)) !!}</small></small>
                                                Dari <b>{!! $item->name !!}</b><br>
                                                <small>Subject : {!! $item->subject !!}</small><br>
                                                <small>Email : {!! $item->email !!}</small>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="loadingmessage"></div>
                        </li>

                    </ul><!--end .header-nav-options -->
                    <ul class="header-nav header-nav-profile">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
                                <img src="{{ asset('/img/avatars/thumb/' . Auth::user()->avatar) }} " alt="" />
                                <span class="profile-info">
                                    {{ Auth::user()->name }}
                                </span>
                            </a>
                            <ul class="dropdown-menu animation-dock">
                                <!-- <li class="dropdown-header">Config</li> -->
                                <li><a href="{{ url('/users/profile') }}">My profile</a></li>
                                <li><a href="{{ url('/users/avatar') }}">Avatar</a></li>
                                <li class="divider"></li>
                                <!-- <li><a href="../../html/pages/locked.html"><i class="fa fa-fw fa-lock"></i> Lock</a></li> -->
                                <li><a href="javascript:logout(0);"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
                            </ul><!--end .dropdown-menu -->
                        </li><!--end .dropdown -->
                    </ul><!--end .header-nav-profile -->

                </div><!--end #header-navbar-collapse -->
            </div>
        </header>
        <!-- END HEADER-->

        <!-- BEGIN BASE-->
        <div id="base">

            <!-- BEGIN OFFCANVAS LEFT -->
            <div class="offcanvas">
            </div><!--end .offcanvas-->
            <!-- END OFFCANVAS LEFT -->

            <!-- BEGIN CONTENT-->
            <div id="content">

                @if(Session::get('notif'))
                    <div class="alert alert-{{ Session::get('notif')['label'] }}">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <p>{!! Session::get('notif')['err'] !!}</p>
                    </div>
                @endif

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- BEGIN BLANK SECTION -->
                <section>
                    <div class="section-header">
                        <ol class="breadcrumb">
                        @if(!empty($breadcrumb))
                            @foreach($breadcrumb as $brad)
                                <li {!! $loop->last ? 'class="active"' : '' !!}>
                                    <a href="{{  $brad['link'] }}">{{  $brad['name'] }}</a>
                                </li>
                            @endforeach
                        @endif
                        </ol>
                    </div><!--end .section-header -->
                    <div class="section-body">
                        @yield('content')

                    </div><!--end .section-body -->
                </section>

                <!-- BEGIN BLANK SECTION -->
            </div><!--end #content-->
            <!-- END CONTENT -->

            <!-- BEGIN MENUBAR-->
            <div id="menubar" class="menubar-inverse ">
                <div class="menubar-fixed-panel">
                    <div>
                        <a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    <div class="expanded">
                        <a href="{{ url('/home') }}">
                            <span class="text-lg text-bold text-primary ">{{ config("app.name") }}</span>
                        </a>
                    </div>
                </div>
                <div class="menubar-scroll-panel">

                    <!-- BEGIN MAIN MENU -->
                    <ul id="main-menu" class="gui-controls">

                        @foreach($menu_main->roots() as $item)
                            <li {!! ($item->hasChildren()) ? 'class="gui-folder"' : '' !!} {!! $item->attributes() !!}>


                                <a href="{{ $item->hasChildren() ? 'javascript:void(0);' : url($item->url()) }}" class="{{ $item->active ? 'active' : '' }}">
                                    <div class="gui-icon">{!! $item->icon !!}</div>
                                    <span class="title">{{ $item->title }}</span>
                                </a>
                                <!-- ANak menu -->
                                @if($item->hasChildren())
                                    <ul>
                                    @foreach($item->children() as $child)
                                        <li {!! $child->attributes() !!}>
                                            <a href="{{ $child->hasChildren() ? 'javascript:void(0);' : url($child->url()) }}" class="{{ $child->active ? 'active' : '' }}">
                                                <span class="title">{{ $child->title }}</span>
                                            </a>

                                            <!-- cucu menu -->
                                            @if($child->hasChildren())
                                                <ul>
                                                    @foreach($child->children() as $cucu)
                                                        <li {!! $cucu->attributes() !!}>
                                                            <a href="{{ url($cucu->url()) }}" class="{{ $cucu->active ? 'active' : '' }}">
                                                                <span class="title">{{ $cucu->title }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </li>
                                    @endforeach
                                    </ul>
                                @endif

                            </li>
                        @endforeach

                    </ul>
                    <!-- END MAIN MENU -->

                    <div class="menubar-foot-panel">
                        <small class="no-linebreak hidden-folded">
                            <span class="opacity-75">Copyright &copy; 2018</span> &middot; <strong><a href="#" target="_blank">Bandung Team</a></strong>
                        </small>
                    </div>
                </div><!--end .menubar-scroll-panel-->
            </div><!--end #menubar-->
            <!-- END MENUBAR -->

        </div><!--end #base-->
        <!-- END BASE -->

        <div class="modal fade" id="detailpesanan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rincian Pesanan</h5>
              </div>
              <div class="modal-body" id="modalpesanan">
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- BEGIN JAVASCRIPT -->
        <script src="{{ asset('/js/libs/jquery/jquery-1.11.2.min.js') }}"></script>
        <script src="{{ asset('/js/libs/jquery/jquery-migrate-1.2.1.min.js') }}"></script>
        <script src="{{ asset('/js/libs/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/js/libs/spin.js/spin.min.js') }}"></script>
        <script src="{{ asset('/js/libs/autosize/jquery.autosize.min.js') }}"></script>
        <script src="{{ asset('/js/libs/nanoscroller/jquery.nanoscroller.min.js') }}"></script>
        <script src="{{ asset('/vendor/slimScroll/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('/js/libs/toastr/toastr.js') }}"></script>
        <script src="{{ asset('/js/core/source/App.js') }}"></script>
        <script src="{{ asset('/js/core/source/AppNavigation.js') }}"></script>
        <script src="{{ asset('/js/core/source/AppOffcanvas.js') }}"></script>
        <script src="{{ asset('/js/core/source/AppCard.js') }}"></script>
        <script src="{{ asset('/js/core/source/AppForm.js') }}"></script>
        <script src="{{ asset('/js/core/source/AppNavSearch.js') }}"></script>
        <script src="{{ asset('/js/core/source/AppVendor.js') }}"></script>
        <script src="{{ asset('/js/jquery-ui/jquery-ui.min.js') }}"></script>
        <!-- END JAVASCRIPT -->
        <!-- <script src="{{ asset('/js/app.js') }}"></script> -->
        <script src="{{ asset('/js/update.js') }}"></script>
        <script type="text/javascript">
            $(window).load(function() {
                $(".loader").fadeOut("slow");
                $(".loader").html('loading');
            });

            $('body').on('click', '.allreadpesan', function(){
                $.ajax({
                    url: '/data/detail/allreadpesan/',
                    type: "GET",
                    beforeSend:function() { 
                        $('.globeNotify').hide();
                        $('.loading').show();
                        $('.loading').html('Loading...');
                    },
                    success : function(resp){
                        console.log(resp);
                        notify = '';
                        notify += '<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">'+
                                    '<i class="fa fa-globe fa-lg"></i><sup class="badge style-danger">'+resp.count+'</sup>'+
                                '</a>'+
                                '<ul class="dropdown-menu animation-dockmation-expand badges-items">'+
                                '<div style="margin-left: 10px; color: blue;"><a class="allreadpesan" href="javascript:void(0)"><small>Tandai semua telah dibaca</small></a></div>';

                        $.each(resp.notifications, function(k,v){
                            if (v.status  == 1) {
                                var style = 'style="background-color: #edf2fa"';
                            } else {
                                var style = '';
                            }
                            notify +='<li>'+
                                        '<a class="alert alert-callout notify alert-danger" '+style+' data-id="'+v.id_pesanan+'" href="javascript:;">'+
                                            '<small class="pull-right text-muted"><small>'+$.datepicker.formatDate( "MM dd, yy", new Date(v.time_request))+'</small></small>'+
                                            '<strong>Kode Pesanan <b>'+v.code+'</b></strong><br>'+
                                            '<small>Dari : '+v.name_customer+'</small>'+
                                        '</a>'+
                                    '</li>';
                        });

                        notify += '</ul>';

                        $('.globeNotify').empty().append(notify);
                        $('.loading').hide();
                        $('.globeNotify').show();
                    }
                });
            });

            $('body').on('click', '.allreadmessage', function(){
                $.ajax({
                    url: '/data/detail/allreadmessage/',
                    type: "GET",
                    beforeSend:function() { 
                        $('.messageNotify').hide();
                        $('.loadingmessage').show();
                        $('.loadingmessage').html('Loading...');
                    },
                    success : function(resp){
                        //console.log(resp);
                        notify = '';
                        notify += '<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">'+
                                    '<i class="fa fa-globe fa-lg"></i><sup class="badge style-danger">'+resp.count+'</sup>'+
                                '</a>'+
                                '<ul class="dropdown-menu animation-dockmation-expand badges-items">'+
                                '<div style="margin-left: 10px; color: blue;"><a class="allreadmessage" href="javascript:void(0)"><small>Tandai semua telah dibaca</small></a></div>';

                        $.each(resp.notifications, function(k,v){
                            if (v.status  == 1) {
                                var style = 'style="background-color: #edf2fa"';
                                var alert = 'alert-info';
                            } else {
                                var style = '';
                                var alert = 'alert-danger';
                            }
                            notify +='<li>'+
                                        '<a class="alert alert-callout '+alert+'" '+style+' href="/message/{!! $item->id !!}">'+
                                            '<small class="pull-right text-muted"><small>'+$.datepicker.formatDate( "MM dd, yy", new Date(v.created_at))+'</small></small>'+
                                            'Dari <b>'+v.name+'</b><br>'+
                                            '<small>Subject : '+v.subject+'</small><br>'+
                                            '<small>Email : '+v.email+'</small>'+
                                        '</a>'+
                                    '</li>';
                        });

                        notify += '</ul>';

                        $('.messageNotify').empty().append(notify);
                        $('.loadingmessage').hide();
                        $('.messageNotify').show();
                    }
                });
            });

            $('body').on('click', '.notify', function(){
                id = $(this).data('id');
                $.ajax({
                    url: '/data/detail/notify/'+id,
                    type: "GET",
                    beforeSend:function() { 
                        $('.globeNotify').hide();
                        $('.loading').show();
                        $('.loading').html('Loading...');
                    },
                    success : function(resp){
                      //console.log(resp);
                        notify = '';
                        notify += '<a href="javascript:void(0);" class="btn btn-icon-toggle btn-default" data-toggle="dropdown">'+
                                    '<i class="fa fa-globe fa-lg"></i><sup class="badge style-danger">'+resp.count+'</sup>'+
                                '</a>'+
                                '<ul class="dropdown-menu animation-dockmation-expand badges-items">'+
                                '<div style="margin-left: 10px; color: blue;"><a class="allreadpesan" href="javascript:void(0)"><small>Tandai semua telah dibaca</small></a></div>';


                        $.each(resp.notifications, function(k,v){
                            if (v.status  == 1) {
                                var style = 'style="background-color: #edf2fa"';
                                var alert = 'alert-info';
                            } else {
                                var style = '';
                                var alert = 'alert-danger';
                            }
                            notify +='<li>'+
                                        '<a class="alert alert-callout notify '+alert+'" '+style+' data-id="'+v.id_pesanan+'" href="javascript:;">'+
                                            '<small class="pull-right text-muted"><small>'+$.datepicker.formatDate( "MM dd, yy", new Date(v.time_request))+'</small></small>'+
                                            '<strong>Kode Pesanan <b>'+v.code+'</b></strong><br>'+
                                            '<small>Dari : '+v.name_customer+'</small>'+
                                        '</a>'+
                                    '</li>';
                        });

                        notify += '</ul>';

                      eHtml = '<table>'+
                                    '<tr><td width="150px">Kode</td><td> : <b>'+resp.order.code+' </b> (Kategori Order: '+resp.categori+')</td></tr>'+
                                    '<tr><td>Produk</td><td> : '+resp.product.product+' </td></tr>'+
                                    '<tr><td>Jumlah Pesanan</td><td> : '+resp.order.qty_pesanan+' </td></tr>'+

                                    '<tr><td>Nama</td><td> : '+resp.order.name_customer+' </td></tr>'+
                                    '<tr><td>Email</td><td> : '+resp.order.email+' </td></tr>'+
                                    '<tr><td>Telpon</td><td> : '+resp.order.phone+' </td></tr>'+

                                    '<tr><td>Alamat</td><td> : '+resp.order.address+' </td></tr>'+
                                    '<tr><td>Kota</td><td> : '+resp.order.city+' </td></tr>'+

                                    '<tr><td>Negara</td><td> : '+resp.country.nm_country+' </td></tr>'+

                                    '<tr><td colspan="2"><br /><b><i>Catatan Tambahan dari Customer</i></b> <br /><i>'+resp.order.customer_note+' </i></td></tr>'+

                                '</table>';

                        $('#modalpesanan').empty().append(eHtml);
                        $('.globeNotify').empty().append(notify);
                        $('.loading').hide();
                        $('.globeNotify').show();
                        $('#detailpesanan').modal('show');
                    }
                });
            });
        </script>
        @yield('footer')

        <!-- Logout -->
        <form method="post" action="{{ url('/logout') }}" id="logout">
            {{ csrf_field() }}
        </form>
    </body>
</html>
