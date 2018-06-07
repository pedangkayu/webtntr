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
                        <p>Tinatar Innovation terbentuk dari personel dengan berbagai pengalaman di bidang teknologi. Hal ini memperkaya pola pikir dan sudut pandang kami dalam membuat sebuah solusi inovasi. Kami menggunakan azas manfaat dalam penerapan teknologi, karena menurut kami faktor kecanggihan teknologi bukanlah yang utama, melainkan seberapa besar manfaat teknologi tersebut. Kami berpandangan bahwa kebutuhan tiap usaha berbeda tergantung dari berbagai macam faktor. </p>

						<p>Kami di Tinatar Innovation, berperan sebagai partner anda untuk bersama sama menemukan solusi inovasi yang paling sesuai dengan kebutuhan anda. Kami percaya bahwa keberhasilan kami hanya dapat dinilai dari kemajuan usaha partner kami. Kami menantikan kerja sama yang luar biasa dengan anda.</p>
                    </div>

                    <div class="col-md-6 pt40 pb30">                        
                        <div class="progress-bars standard transparent-bars" data-animate-on-scroll="on">
                            <h5 class="bold">Branding</h5>
                            <div class="progress" data-percent="75%">
                                <div class="progress-bar">
                                    <span class="progress-bar-tooltip">75%</span>
                                </div>
                            </div>
                            <h5 class="bold">User Experience</h5>
                            <div class="progress" data-percent="100%">
                                <div class="progress-bar progress-bar-primary">
                                    <span class="progress-bar-tooltip">100%</span>
                                </div>
                            </div>
                            <h5 class="bold">Web Design</h5>
                            <div class="progress" data-percent="95%">
                                <div class="progress-bar progress-bar-primary">
                                    <span class="progress-bar-tooltip">95%</span>
                                </div>
                            </div>

                            <h5 class="bold">Mobile Apps</h5>
                            <div class="progress" data-percent="80%">
                                <div class="progress-bar progress-bar-primary">
                                    <span class="progress-bar-tooltip">80%</span>
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
        <section id="elements-buttons" class="pt100 pb80">
            <div class="container"> 
                <div class="row">			

                    <div class="col-md-12 text-center pb20">
                        <h1><strong>How IT Consultant Works?</strong></h1>
                        <p class="lead">stages to start a working process with our team.</p>
                    </div>
                    
                    <div class="col-md-12 mr-auto text-center">
                        <div class="buttons-tabs-centered">
                        	<ul id="buttonTabs" class="nav-tabs nav-tabs-center">
                                <li class="active"><a href="#tab-c1" data-toggle="tab"> 1.Analisys</a></li>
                                <li class=""><a href="#tab-c2" data-toggle="tab"> 2.Design</a></li>
                                <li class=""><a href="#tab-c3" data-toggle="tab"> 3.Acceptance</a></li>
                                <li class=""><a href="#tab-c4" data-toggle="tab"> 4.Development</a></li>
                                <li class=""><a href="#tab-c5" data-toggle="tab"> 5.Implementation</a></li>
                                <li class=""><a href="#tab-c6" data-toggle="tab"> 6.Maintenance</a></li>
                            </ul>

                            <div id="myTabContent" class="tab-content">

                                <div class="tab-pane active in" id="tab-c1"> 
                                    <p>Ceritakan kepada kami masalah & ide Anda. dengan pengalaman yang kami miliki. kami dapat memberikan saran terbaik untuk aplikasi anda.</p>
                                </div>

                                <div class="tab-pane" id="tab-c2"> 
                                    <p>Selanjutnya tim kami akan melakukan sketsa design product secara UI dan UX untuk memberikan gambaran kepada anda akan seperti apa kebutuhan aplikasi sistem sebelum masuk ke tahap development.</p>
                                </div>

                                <div class="tab-pane" id="tab-c3"> 
                                     <p>Setelah sesi presentasikan dari analisa dan penjabaran design dan fitur, dan seluruh presentasi telah disepakati, maka kita akan melakukan persetujuan administrasi.</p> 
                                </div>

                                <div class="tab-pane" id="tab-c4"> 
                                    <p>ini adalah tahap yang kami lakukan dengan gembira. kami Develop Apps berdasarkan Ide Anda + Core Feature Apps Bisnis Kami Untuk menekan durasi waktu dan biaya kami mempunyai Core Feature Aplikasi Bisnis. tim kami akan berkonsentrasi penuh di bagian ini.</p>
                                </div>

                                <div class="tab-pane" id="tab-c5"> 
                                    <p>Implementasi dilakukan setelah Aplikasi direview bersamaan dengan anda. Apakah sudah sesuai dengan kebutuhan atau perlu penambahan. selanjutkan akan segera dilakukan Implementasi & Training ke tim ataupun Karyawan anda.</p>
                                </div>

                                <div class="tab-pane" id="tab-c6"> 
                                    <p>Bila dibutuhkan, kami siap untuk membantu anda melakukan maintenance dan update secara periodik, baik dari sisi Sistem aplikasi, database ataupun perawatan hardware pendukung sistem.</p>
                                </div>
                            </div>
   

                        </div>

                    </div>

                </div>
            </div>
        </section>
<!-- End Icon Tabs Centered -->

 
<!-- Features -->
        <section id="elements-features" class="pt100 pb100 bg-grey">
            <div class="container">   
                <div class="row">

                    <div class="col-md-12 text-center">
                        <h1><strong>Our Strategic Partnership</strong></h1>
                        <p class="lead">an important strategy we must do to serve your company</p>
                    </div>
         
 					<div class="col-md-12 pt40 pb40">
                        <div class="col-md-3 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-telescope size-4x color"></i>
                                <i class="icon-telescope back-icon"></i> 
                                <div>
                                    <h4><strong>Big Passion &amp; Focus</strong></h4>
                                    <p>Tim Kami memiliki passion yang besar di dalam dunia softwere developer, kami mengkhususkan pada Teknologi Digital. kami berusaha untuk selalu menjadi yang terbaik di bidang ini.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-circle-compass size-4x color"></i>
                                <i class="icon-circle-compass back-icon"></i> 
                                <div class="feature-left-content">
                                    <h4><strong>Intelligent Design UI UX </strong></h4>
                                    <p>Tim Analisis dan Desainer Kami memiliki intuisi yang tajam dalam memecahkan permasalahan teknis. dari sisi kegunaan, fungsionalitas dan detail yang ditunjukkan agar sesuai kebutuhan.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-genius size-4x color"></i>
                                <i class="icon-genius back-icon"></i> 
                                <div class="feature-left-content">
                                    <h4><strong>Flexibility &amp; Functionality</strong></h4>
                                    <p>Kami dapat merancang dan membuat aplikasi khusus, atau memperbaiki aplikasi yang Anda gunakan saat ini agar fiturnya semakin maksimal dan bisa mendukung kebutuhan bisnis anda.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6 feature-left-stack boxed">
                            <div class="feature-box">
                                <i class="icon-streetsign size-4x color"></i>
                                <i class="icon-streetsign back-icon"></i> 
                                <div class="feature-left-content">
                                    <h4><strong>Support &amp; Maintenance</strong></h4>
                                    <p>Setelah projek selesai, kami selalu menyediakan dukungan teknis yang solid melalui telepon, email, remote desktop dan tatap muka. kami pastikan kebutuhan anda selalu dilayani </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- End Features -->

@if(count($primarySchedule))
@foreach($news as $key => $value)
@endforeach
@endif

<!-- Portfolio -->
        <section id="works" class="pt100 pb110>
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