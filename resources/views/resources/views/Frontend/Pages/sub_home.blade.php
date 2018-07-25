@extends('Frontend.home')
@section('sub_home')
<?php
use App\Models\languages;
use App\Models\pages;
use App\Models\posts;
$transnews = trans('main.news');
$lang = languages::where('code', \App::getLocale())->first();
$intros = posts::where('type', 0)->where('status', 1)->where('lang_id', $lang->id)->orderBy('date_add', 'ASC')->limit(1)->get();
$news = posts::where('type', 1)->where('status', 1)->
where('lang_id', $lang->id)->
// orderBy('date_add', 'ASC')->
orderBy(\DB::raw('RAND()'))->
limit(6)->get();

$schedulers = posts::where('type', 2)->where('status', 1)->where('lang_id', $lang->id)->orderBy('date_schedule_start', 'ASC')->limit(6)->get();

$primarySchedule = posts::where('type', 2)->where('status', 1)->where('lang_id', $lang->id)->orderBy('date_schedule_start', 'ASC')->first();
?>

<!--  INTRO -->
<!-- /. Services Start ./-->
	<section id="hservices">
	  <div class="container">
		  <div class="row">
			 <div class="col-lg-12 col-md-6 col-sm-6">
				<div class="hservice">
					@if(count($intros))
						@foreach($intros as $key => $value)
						  	<p>{!! $value->post !!}</p>
						@endforeach
					@endif
				</div>
			 </div>
		  </div>
	  </div>
	</section>
<!-- #END KOLOM INTRO -->


<!-- About Us -->
        <section id="about" class="pt100 pb90">
            <div class="container">                      
                <div class="row">    

                    <div class="col-md-12 text-center pb20">   
                        <h2>We Are Tinatar<br><strong>Innovation</strong></h2>
                        <p class="lead">We create experiences that <span class="color">transform brands</span>, grow businesses<br>and make people’s lives better. Building brands and driving sales with powerful ideas.</p>
                    </div>  
                    
                    <div class="col-sm-6 feature-left">
                        <i class="icon-telescope size-3x color"></i>
                        <i class="icon-telescope back-icon"></i> 
                        <div class="feature-left-content">
                            <h4><strong>Software </strong>& Multimedia</h4>
                            <p>Website Personal, Website Komunitas, Company Profile, ERP, Online Store, Sistem Informasi Geografis, Web Apps, Otomasi Laporan, Data Integrasi, Interactive Apps, dll</p>
                        </div> 
                    </div>

                    <div class="col-sm-6 feature-left">
                        <i class="icon-circle-compass size-3x color"></i>
                        <i class="icon-circle-compass back-icon"></i> 
                        <div class="feature-left-content">
                            <h4><strong>IT </strong> Consultant</h4>
                            <p>Kami memberikan solusi cepat dan tepat untuk setiap permasalah IT di perusahaan anda. kami akan memberikan solusi terbaik dalam presentasi singkat dan lugas.</p> 
                        </div> 
                    </div>

                    <div class="col-sm-6 feature-left">
                        <i class="icon-genius size-3x color"></i>
                        <i class="icon-genius back-icon"></i> 
                        <div class="feature-left-content">
                            <h4><strong>Hardware </strong> & Configuration </h4>
                            <p>Perusahaan anda memiliki kebutuhan terhadap perangkat keras dan konfigurasi nya untuk mendukung operasional perusahaan? diskusikan dengan kami, Tim kami akan segera menyediakan untuk anda.</p> 
                        </div> 
                    </div>
                    <div class="col-sm-6 feature-left">
                        <i class="icon-layers size-3x color"></i>
                        <i class="icon-layers back-icon"></i> 
                        <div class="feature-left-content">
                            <h4><strong>Resource </strong> & Networking</h4>
                            <p>Jika Perusahaan tidak bergerak di bidang IT, Kami siap untuk membantu anda mendukung operasional perusahaan dan menyiapkan tenaga IT untuk mendukung seluruh operasional harian.</p>
                        </div> 
                    </div> 

                </div>
            </div>
        </section>
        <!-- End About Us -->
    
        <!-- Who We Are -->
        <section id="who-we-are" class="parallax pt40 pb40" data-overlay-dark="8">
            <div class="background-image">
                <img src="img/backgrounds/bg-2.jpg" alt="#">
            </div>
            <div class="container">   
                <div class="row vertical-align">

                    <div class="col-md-6 pr30 mt40 mb40">   
                        <h2><strong>Our Skills</strong><br><span class="color">Crafting With Passion</span></h2>   
                        <p>Fusce faucibus tincidunt nulla, tincidunt sagittis magna venenatis quis. Proin commodo eu ipsum eu suscipit. In dapibus arcu sit amet imperdiet. Praesent condimentum nulla at mauris ornare. Praesent condimentum nulla at mauris ornare, eget consequat felis euismod. Praesent condimentum nulla at mauris ornare.</p>
                        <p>Praesent condimentum nulla at mauris ornare, eget consequat felis euismod. Praesent condimentum nulla at mauris ornare. Fusce faucibus tincidunt nulla, tincidunt sagittis magna venenatis quis. Proin commodo eu ipsum eu suscipit.</p> 
                    </div>

                    <div class="col-md-6 pt40 pb30">                        
                        <div class="progress-bars standard transparent-bars" data-animate-on-scroll="on">
                            <h5 class="bold">Branding</h5>
                            <div class="progress" data-percent="85%">
                                <div class="progress-bar">
                                    <span class="progress-bar-tooltip">85%</span>
                                </div>
                            </div>
                            <h5 class="bold">User Experience</h5>
                            <div class="progress" data-percent="100%">
                                <div class="progress-bar progress-bar-primary">
                                    <span class="progress-bar-tooltip">100%</span>
                                </div>
                            </div>
                            <h5 class="bold">Web Design</h5>
                            <div class="progress" data-percent="70%">
                                <div class="progress-bar progress-bar-primary">
                                    <span class="progress-bar-tooltip">70%</span>
                                </div>
                            </div>
                            <h5 class="bold">Fun</h5>
                            <div class="progress" data-percent="82%">
                                <div class="progress-bar progress-bar-primary">
                                    <span class="progress-bar-tooltip">82%</span>
                                </div>
                            </div> 
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- End Who We Are -->



<!-- Icon Tabs Centered -->
        <section id="elements-tabs" class="pt110 pb100 bg-grey">
            <div class="container"> 
                <div class="row">			

                    <div class="col-md-12 text-center pb20">
                        <h1><strong>How IT Consultant Works?</strong></h1>
                        <p class="lead">stages to start a working process with our team.</p>
                    </div>
                    
                    <div class="col-md-10 mr-auto text-center">

                        <div class="icon-tabs-centered">

                            <ul id="iconTabs" class="nav-tabs nav-tabs-center">
				                <li class="active"><a href="#tab-i1" data-toggle="tab"><span class="icon-tab ion-ios-flask-outline"></span><span>1. Analisys</span></a></li>
				                <li class=""><a href="#tab-i2" data-toggle="tab"><span class="icon-tab ion-ios-bolt-outline"></span><span>2. Design</span></a></li>
				                <li class=""><a href="#tab-i3" data-toggle="tab"><span class="icon-tab ion-ios-infinite-outline"></span><span>3. Acceptance</span></a></li>
				                <li class=""><a href="#tab-i4" data-toggle="tab"><span class="icon-tab ion-ios-pulse"></span><span>4. Development</span></a></li>
				                <li class=""><a href="#tab-i5" data-toggle="tab"><span class="icon-tab ion-ios-star-outline"></span><span>5. Implementation</span></a></li>
				                <li class=""><a href="#tab-i6" data-toggle="tab"><span class="icon-tab ion-ios-refresh"></span><span>6. Maintenance</span></a></li>
                            </ul>

  

 
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in" id="tab-i1"> 
                                    <p>Ceritakan kepada kami masalah & ide Anda. dengan pengalaman yang kami miliki. kami dapat memberikan saran terbaik untuk aplikasi anda.</p>
                                </div>

                                <div class="tab-pane fade" id="tab-i2"> 
                                    <p>Selanjutnya tim kami akan melakukan sketsa design product secara UI dan UX untuk memberikan gambaran kepada anda akan seperti apa kebutuhan aplikasi sistem sebelum masuk ke tahap development.</p>
                                </div>

                                <div class="tab-pane fade" id="tab-i3">
                                    <p>Setelah sesi presentasikan dari analisa dan penjabaran design dan fitur, dan seluruh presentasi telah disepakati, maka kita akan melakukan persetujuan administrasi.</p> 
                                </div>

                                <div class="tab-pane fade" id="tab-i4"> 
                                    <p>ini adalah tahap yang kami lakukan dengan gembira. kami Develop Apps berdasarkan Ide Anda + Core Feature Apps Bisnis Kami Untuk menekan durasi waktu dan biaya kami mempunyai Core Feature Aplikasi Bisnis. tim kami akan berkonsentrasi penuh di bagian ini.</p>
                                </div>

                                <div class="tab-pane fade" id="tab-i5"> 
                                    <p>Implementasi dilakukan setelah Aplikasi direview bersamaan dengan anda. Apakah sudah sesuai dengan kebutuhan atau perlu penambahan. selanjutkan akan segera dilakukan Implementasi & Training ke tim ataupun Karyawan anda.</p>
                                </div>

                                <div class="tab-pane fade" id="tab-i6"> 
                                    <p>Bila dibutuhkan, kami siap untuk membantu anda melakukan maintenance dan update secara periodik, baik dari sisi Sistem aplikasi, database ataupun perawatan hardware pendukung sistem.</p>
                                </div>



                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </section>
        <!-- End Icon Tabs Centered -->














@if(count($primarySchedule))
@foreach($news as $key => $value)
@endforeach
@endif

 
<!-- Portfolio -->
        <section id="works" class="pt100 pb110">
            <div class="container">
                <div class="row text-center">    

                    <div class="col-md-12 text-center pb20">   
                        <h2>Take a Look at<br><strong>Some of Our Work</strong></h2>
                        <p class="lead">Wide range of <span class="color">successful</span> digital and print projects.</p>
                    </div>
                    
                    <div class="portfolio" data-gap="20"><!-- Values: 10, 15, 20, 25, 30 and 35 -->
                        <!-- Portfolio Category Filters -->
                        <!-- ul class="vossen-portfolio-filters" data-initial-filter="*">
                            <li data-filter="*">Show All</li>
                            <li data-filter="Branding">Branding</li>
                            <li data-filter="Digital">Digital</li>
                            <li data-filter="Print">Print</li>
                        </ul -->
                        
                        <!-- Portfolio Items Container-->
                         @if(count($news))
                        <div class="vossen-portfolio">
                        	<?php
				  				$post = strlen($value->post); 
				  				$substrPost = substr($value->post, 0,100).' [...]';
				  				$pageHome = App\Models\pages::where('lang_id', $lang->id)->where('code', 11111)->first();
                			?>
                            <!-- Portfolio Item -->
                           	@foreach($news as $key => $value)
	                            <div class="col-md-4 col-sm-6" data-filter="Branding">
	                                <a href="project-slides.html">
	                                    <div class="portfolio-item">
	                                        <div class="item-caption">
	                   
                                            <h4><a href="{{ url(App::getLocale().'/'.$pageHome->slug.'/'.$value->slug) }}"> <i class="ion-android-checkmark-circle"></i> {!! $value->title !!}</a></h4>

	                                        </div>
	                                        <div class="item-image">
								              	@if($value->thumb != 'null')
								              	<img src="/img/posts/thumb/{!! $value->thumb !!}"> 							  
								              	@else
							                    <img src="/img/posts/thumb/default-lite.png" alt="NOPIC">
							                	@endif
	                                        </div>
	                                    </div>
	                                </a>
	                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
       
                    <a href="{!! App::getLocale().'/'.$pageHome->slug !!}" class="btn btn-md btn-light btn-appear mt30"><span>View All <i class="ion-arrow-right-c"></i></span></a>
                
                </div>
            </div>
        </section>            
        <!-- End Portfolio --> 

@endsection